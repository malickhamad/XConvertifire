<?php

namespace App\Observers;

use App\Jobs\SubmitIndexNow;
use App\Models\Blog;
use App\Services\IndexNow;
use Illuminate\Support\Carbon;
use Throwable;

class BlogObserver
{
    public function saved(Blog $blog): void
    {
        if (! config('indexnow.enabled') || (! $blog->wasRecentlyCreated && ! $blog->wasChanged())) {
            return;
        }

        $urls = [];
        $indexNow = app(IndexNow::class);
        $original = $blog->getRawOriginal();
        if (! $blog->wasRecentlyCreated && $this->isPublic($original)) {
            $urls[] = $indexNow->url('blog/'.$original['slug']);
        }
        if ($this->isPublic($blog->getAttributes())) {
            $urls[] = $indexNow->url('blog/'.$blog->slug);
        }

        try {
            if ($urls !== []) {
                $urls[] = $indexNow->url('blog');
                SubmitIndexNow::dispatch(array_values(array_unique($urls)));
            }
            if ($blog->status === 'published' && $blog->published_at?->isFuture()
                && ($blog->wasRecentlyCreated || $blog->wasChanged(['status', 'published_at']))) {
                SubmitIndexNow::dispatch([], $blog->id, $blog->published_at->toDateTimeString())
                    ->delay($blog->published_at);
            }
        } catch (Throwable $exception) {
            // Notification infrastructure must not prevent saving content.
            report($exception);
        }
    }

    public function deleted(Blog $blog): void
    {
        if (config('indexnow.enabled') && $this->isPublic($blog->getAttributes())) {
            try {
                $indexNow = app(IndexNow::class);
                SubmitIndexNow::dispatch([$indexNow->url('blog/'.$blog->slug), $indexNow->url('blog')]);
            } catch (Throwable $exception) {
                report($exception);
            }
        }
    }

    private function isPublic(array $attributes): bool
    {
        return ($attributes['status'] ?? null) === 'published'
            && (empty($attributes['published_at']) || Carbon::parse($attributes['published_at'])->lessThanOrEqualTo(now()));
    }
}
