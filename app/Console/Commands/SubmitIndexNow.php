<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Services\IndexNow;
use Illuminate\Console\Command;
use Throwable;

class SubmitIndexNow extends Command
{
    protected $signature = 'indexnow:submit {urls?* : Absolute URLs belonging to APP_URL} {--all : Submit all public sitemap URLs} {--dry-run : Show URLs without submitting}';

    protected $description = 'Notify IndexNow about changed public URLs';

    public function handle(IndexNow $indexNow): int
    {
        $urls = $this->argument('urls');
        if ($this->option('all')) {
            // Reuse the sitemap so admin, downloads and drafts stay excluded.
            $blogs = Blog::published()->get(['slug', 'updated_at']);
            $xml = simplexml_load_string(view('pages.sitemap', compact('blogs'))->render());
            foreach ($xml->url as $url) {
                $path = parse_url((string) $url->loc, PHP_URL_PATH) ?: '/';
                $urls[] = $indexNow->url($path);
            }
        }
        $urls = array_values(array_unique($urls));
        if ($urls === []) {
            $this->error('Provide URLs or use --all.');

            return self::FAILURE;
        }
        if ($this->option('dry-run')) {
            foreach ($urls as $url) {
                $this->line($url);
            }

            return self::SUCCESS;
        }
        if (! config('indexnow.enabled')) {
            $this->error('Set INDEXNOW_ENABLED=true after deploying the key file and configuring APP_URL.');

            return self::FAILURE;
        }

        try {
            $indexNow->submit($urls);
        } catch (Throwable $exception) {
            $this->error($exception->getMessage());

            return self::FAILURE;
        }
        $this->info(count($urls).' URL(s) received by IndexNow. This does not guarantee indexing.');

        return self::SUCCESS;
    }
}
