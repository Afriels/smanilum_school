<?php

namespace App\Services;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use RuntimeException;

class SupabaseStorageService
{
    public function __construct(
        private HttpFactory $http
    ) {
    }

    public function isConfigured(): bool
    {
        return filled(config('supabase.url')) && filled($this->apiKey());
    }

    public function upload(UploadedFile $file, string $bucketKey, string $directory = ''): string
    {
        if (! $this->isConfigured()) {
            throw new RuntimeException('Supabase Storage belum dikonfigurasi.');
        }

        $bucket = $this->bucket($bucketKey);
        $path = $this->buildObjectPath($file, $directory);
        $response = $this->client()
            ->withHeaders([
                'x-upsert' => 'false',
                'cache-control' => (string) config('supabase.storage.cache_control', '3600'),
            ])
            ->withBody(
                file_get_contents($file->getRealPath()) ?: '',
                $file->getMimeType() ?: 'application/octet-stream'
            )
            ->send('POST', $this->objectUrl($bucket, $path));

        if ($response->failed()) {
            throw new RuntimeException('Upload ke Supabase gagal: '.$response->body());
        }

        return $this->publicUrl($bucket, $path);
    }

    public function deleteByStoredValue(?string $value): void
    {
        if (! $value || ! $this->isConfigured()) {
            return;
        }

        $parsed = $this->parseStoredValue($value);

        if (! $parsed) {
            return;
        }

        $response = $this->client()
            ->send('DELETE', $this->storageApiBase().'/object/'.$parsed['bucket'], [
                'json' => [
                    'prefixes' => [$parsed['path']],
                ],
            ]);

        if ($response->failed() && $response->status() !== 404) {
            throw new RuntimeException('Gagal menghapus file lama di Supabase: '.$response->body());
        }
    }

    public function publicUrl(string $bucket, string $path): string
    {
        return rtrim((string) config('supabase.storage.public_url'), '/').'/'.$bucket.'/'.ltrim($path, '/');
    }

    public function parseStoredValue(?string $value): ?array
    {
        if (! $value || ! Str::startsWith($value, ['http://', 'https://'])) {
            return null;
        }

        $publicPrefix = rtrim((string) config('supabase.storage.public_url'), '/').'/';

        if (! Str::startsWith($value, $publicPrefix)) {
            return null;
        }

        $relative = Str::after($value, $publicPrefix);
        [$bucket, $path] = array_pad(explode('/', $relative, 2), 2, null);

        if (! $bucket || ! $path) {
            return null;
        }

        return [
            'bucket' => $bucket,
            'path' => urldecode($path),
        ];
    }

    public function bucket(string $bucketKey): string
    {
        return (string) (config('supabase.buckets.'.$bucketKey) ?: $bucketKey);
    }

    private function buildObjectPath(UploadedFile $file, string $directory = ''): string
    {
        $extension = strtolower($file->getClientOriginalExtension() ?: $file->extension() ?: 'bin');
        $basename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $basename = $basename !== '' ? $basename : 'file';
        $prefix = trim($directory, '/');
        $dateSegment = now()->format('Y/m');
        $filename = $basename.'-'.Str::lower(Str::random(12)).'.'.$extension;

        return collect([$prefix, $dateSegment, $filename])
            ->filter()
            ->implode('/');
    }

    private function objectUrl(string $bucket, string $path): string
    {
        $segments = array_map('rawurlencode', explode('/', ltrim($path, '/')));

        return $this->storageApiBase().'/object/'.$bucket.'/'.implode('/', $segments);
    }

    private function storageApiBase(): string
    {
        return rtrim((string) config('supabase.storage.api_url'), '/');
    }

    private function client()
    {
        $key = $this->apiKey();

        return $this->http
            ->timeout((int) config('supabase.storage.timeout', 30))
            ->acceptJson()
            ->withHeaders([
                'apikey' => $key,
                'Authorization' => 'Bearer '.$key,
            ]);
    }

    private function apiKey(): string
    {
        return (string) (config('supabase.secret_key') ?: config('supabase.anon_key') ?: '');
    }
}
