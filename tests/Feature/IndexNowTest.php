<?php

namespace Tests\Feature;

use App\Jobs\SubmitIndexNow;
use App\Models\Blog;
use App\Services\IndexNow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
use InvalidArgumentException;
use Tests\TestCase;

class IndexNowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        config(['app.url' => 'https://example.com', 'indexnow.enabled' => true]);
        Queue::fake();
        Http::preventStrayRequests();
    }

    private function blog(array $attributes = []): Blog
    {
        return Blog::create(array_merge([
            'title' => 'Example', 'slug' => 'example', 'content' => 'Content',
            'status' => 'draft',
        ], $attributes));
    }

    public function test_key_file_matches_config(): void
    {
        $key = config('indexnow.key');
        $this->assertMatchesRegularExpression('/^[a-zA-Z0-9-]{8,128}$/', $key);
        $this->assertSame($key, trim(file_get_contents(public_path($key.'.txt'))));
    }

    public function test_drafts_are_not_submitted_and_publication_is_queued(): void
    {
        $blog = $this->blog();
        Queue::assertNothingPushed();
        $blog->update(['status' => 'published']);
        Queue::assertPushed(SubmitIndexNow::class, fn ($job) => $job->urls === [
            'https://example.com/blog/example', 'https://example.com/blog',
        ] && $job->afterCommit && $job->connection === 'database');
    }

    public function test_slug_changes_notify_both_urls_and_unpublishing_notifies_old_url(): void
    {
        $blog = $this->blog(['status' => 'published']);
        Queue::fake();
        $blog->update(['slug' => 'changed']);
        Queue::assertPushed(SubmitIndexNow::class, fn ($job) => $job->urls === [
            'https://example.com/blog/example', 'https://example.com/blog/changed', 'https://example.com/blog',
        ]);
        Queue::fake();
        $blog->update(['status' => 'draft']);
        Queue::assertPushed(SubmitIndexNow::class, fn ($job) => in_array('https://example.com/blog/changed', $job->urls));
    }

    public function test_updates_and_deletions_notify_public_urls(): void
    {
        $blog = $this->blog(['status' => 'published']);
        Queue::fake();
        $blog->update(['content' => 'Updated content']);
        $blog->delete();
        Queue::assertPushed(SubmitIndexNow::class, 2);
    }

    public function test_scheduled_publication_waits_and_uses_current_slug(): void
    {
        $this->freezeTime();
        $blog = $this->blog(['status' => 'published', 'published_at' => now()->addHour()]);
        Queue::assertPushed(SubmitIndexNow::class, fn ($job) => $job->scheduledBlogId === $blog->id
            && $job->urls === [] && $job->delay->equalTo($blog->published_at));
        $job = new SubmitIndexNow([], $blog->id, $blog->published_at->toDateTimeString());
        $blog->update(['slug' => 'new-slug']);
        $this->travel(61)->minutes();
        Http::fake(['api.indexnow.org/*' => Http::response('', 202)]);
        $job->handle(app(IndexNow::class));
        Http::assertSent(fn ($request) => in_array('https://example.com/blog/new-slug', $request['urlList']));
    }

    public function test_cancelled_scheduled_publication_is_not_sent(): void
    {
        $blog = $this->blog(['status' => 'published', 'published_at' => now()->addHour()]);
        $job = new SubmitIndexNow([], $blog->id, $blog->published_at->toDateTimeString());
        $blog->update(['status' => 'draft']);
        $this->travel(61)->minutes();
        $job->handle(app(IndexNow::class));
        Http::assertNothingSent();
    }

    public function test_submission_payload_and_pending_key_validation_response(): void
    {
        Http::fake(['api.indexnow.org/*' => Http::response('', 202)]);
        app(IndexNow::class)->submit(['https://example.com/', 'https://example.com/']);
        Http::assertSent(fn ($request) => $request->url() === 'https://api.indexnow.org/indexnow'
            && $request['host'] === 'example.com'
            && $request['key'] === config('indexnow.key')
            && $request['keyLocation'] === 'https://example.com/'.config('indexnow.key').'.txt'
            && $request['urlList'] === ['https://example.com/']);
    }

    public function test_foreign_urls_are_rejected_before_sending(): void
    {
        try {
            app(IndexNow::class)->submit(['https://other.example/page']);
            $this->fail('Expected invalid host to be rejected.');
        } catch (InvalidArgumentException) {
            Http::assertNothingSent();
        }
    }

    public function test_failure_can_be_retried_by_queue(): void
    {
        Http::fake(['api.indexnow.org/*' => Http::response('', 429)]);
        $this->expectException(RequestException::class);
        (new SubmitIndexNow(['https://example.com/']))->handle(app(IndexNow::class));
    }

    public function test_disabled_integration_sends_and_queues_nothing(): void
    {
        config(['indexnow.enabled' => false]);
        $this->blog(['status' => 'published']);
        app(IndexNow::class)->submit(['https://example.com/']);
        Queue::assertNothingPushed();
        Http::assertNothingSent();
        $this->artisan('indexnow:submit', ['urls' => ['https://example.com/']])->assertFailed();
    }

    public function test_bulk_command_uses_public_sitemap_and_dry_run_does_not_submit(): void
    {
        $this->blog();
        $this->blog(['slug' => 'public-post', 'status' => 'published']);
        $this->blog(['slug' => 'future-post', 'status' => 'published', 'published_at' => now()->addDay()]);
        $this->artisan('indexnow:submit --all --dry-run')
            ->expectsOutput('https://example.com/blog/public-post')->assertSuccessful();
        Http::assertNothingSent();
        Http::fake(['api.indexnow.org/*' => Http::response('', 200)]);
        $this->artisan('indexnow:submit --all')->assertSuccessful();
        Http::assertSent(function ($request) {
            $urls = $request['urlList'];

            return in_array('https://example.com/image-resizer', $urls)
                && in_array('https://example.com/blog/public-post', $urls)
                && ! in_array('https://example.com/blog/example', $urls)
                && ! in_array('https://example.com/blog/future-post', $urls)
                && ! in_array('https://example.com/admin/login', $urls);
        });
    }
}
