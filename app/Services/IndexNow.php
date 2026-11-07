<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use InvalidArgumentException;
use RuntimeException;

class IndexNow
{
    public function url(string $path): string
    {
        return rtrim(config('app.url'), '/').'/'.ltrim($path, '/');
    }

    public function submit(array $urls): void
    {
        if (! config('indexnow.enabled')) {
            return;
        }

        $base = rtrim(config('app.url'), '/');
        $host = parse_url($base, PHP_URL_HOST);
        if (! filter_var($base, FILTER_VALIDATE_URL) || ! in_array(parse_url($base, PHP_URL_SCHEME), ['http', 'https']) || ! $host) {
            throw new InvalidArgumentException('APP_URL must be the public website URL.');
        }

        $urls = array_values(array_unique($urls));
        foreach ($urls as $url) {
            if (! filter_var($url, FILTER_VALIDATE_URL)
                || parse_url($url, PHP_URL_HOST) !== $host
                || ! in_array(parse_url($url, PHP_URL_SCHEME), ['http', 'https'])
                || parse_url($url, PHP_URL_USER) !== null
                || parse_url($url, PHP_URL_FRAGMENT) !== null) {
                throw new InvalidArgumentException('IndexNow URLs must belong to APP_URL and have no credentials or fragment.');
            }
        }

        foreach (array_chunk($urls, 10000) as $batch) {
            $response = Http::acceptJson()->connectTimeout(5)->timeout(20)
                ->post('https://api.indexnow.org/indexnow', [
                    'host' => $host,
                    'key' => config('indexnow.key'),
                    'keyLocation' => $this->url(config('indexnow.key').'.txt'),
                    'urlList' => $batch,
                ])->throw();
            if (! in_array($response->status(), [200, 202], true)) {
                throw new RuntimeException('Unexpected IndexNow status: '.$response->status());
            }
        }
    }
}
