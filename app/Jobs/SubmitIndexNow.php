<?php

namespace App\Jobs;

use App\Models\Blog;
use App\Services\IndexNow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SubmitIndexNow implements ShouldQueue
{
    use Queueable;

    public int $tries = 5;

    public int $timeout = 30;

    public function __construct(public array $urls, public ?int $scheduledBlogId = null, public ?string $publicationTime = null)
    {
        $this->onConnection(config('indexnow.connection'));
        $this->afterCommit();
    }

    public function backoff(): array
    {
        return [60, 300, 1800, 3600];
    }

    public function handle(IndexNow $indexNow): void
    {
        if ($this->scheduledBlogId !== null) {
            $blog = Blog::published()->find($this->scheduledBlogId);
            if (! $blog || $blog->published_at?->toDateTimeString() !== $this->publicationTime) {
                return;
            }
            // Use the current slug in case it changed before publication.
            $this->urls = [$indexNow->url('blog/'.$blog->slug), $indexNow->url('blog')];
        }

        $indexNow->submit($this->urls);
    }
}
