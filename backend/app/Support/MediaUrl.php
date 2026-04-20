<?php

namespace App\Support;

use Illuminate\Support\Str;

class MediaUrl
{
    public static function url(?string $path, ?string $fallback = 'images/default.jpg'): string
    {
        $fallbackPath = $fallback ?: 'images/default.jpg';

        if (! $path) {
            return static::localAsset($fallbackPath);
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        if (Str::startsWith($path, ['images/', 'img/', 'storage/'])) {
            return static::localAsset($path);
        }

        return static::localAsset('storage/'.$path);
    }

    private static function localAsset(string $relativePath): string
    {
        $normalizedPath = ltrim($relativePath, '/');
        $absolutePath = public_path(str_replace('/', DIRECTORY_SEPARATOR, $normalizedPath));
        $version = file_exists($absolutePath) ? (int) filemtime($absolutePath) : time();

        return url($normalizedPath).'?v='.$version;
    }
}
