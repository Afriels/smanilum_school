<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function buildSeo(
        ?string $title = null,
        ?string $description = null,
        ?string $imagePath = null,
        string $type = 'website',
        ?string $url = null,
        array $extra = []
    ): array {
        $settings = SiteSetting::query()->where('is_public', true)->pluck('value', 'key');
        $siteName = $settings['site_name'] ?? 'SMAN Ilum Modern';
        $defaultDescription = $settings['site_description'] ?? 'Website sekolah modern dan profesional.';
        $defaultImage = $settings['default_og_image'] ?? 'images/default.jpg';

        return [
            'seo' => array_merge([
                'title' => $title ?: $siteName,
                'description' => Str::limit(strip_tags((string) ($description ?: $defaultDescription)), 180),
                'image' => $this->absoluteMediaUrl($imagePath ?: $defaultImage),
                'url' => $url ?: url()->current(),
                'type' => $type,
                'site_name' => $siteName,
                'twitter_card' => 'summary_large_image',
                'image_width' => 1200,
                'image_height' => 630,
            ], $extra),
        ];
    }

    protected function absoluteMediaUrl(?string $path): string
    {
        $fallback = url('images/default.jpg').'?v='.$this->assetVersion(public_path('images/default.jpg'));

        if (! $path) {
            return $fallback;
        }

        if (Str::startsWith($path, ['http://', 'https://'])) {
            return $path;
        }

        if (Str::startsWith($path, 'storage/')) {
            return url($path).'?v='.$this->assetVersion(public_path($path));
        }

        if (Str::startsWith($path, ['images/', 'img/'])) {
            return url($path).'?v='.$this->assetVersion(public_path($path));
        }

        return url('storage/'.$path).'?v='.$this->assetVersion(public_path('storage/'.$path));
    }

    protected function assetVersion(string $absolutePath): int
    {
        return file_exists($absolutePath) ? (int) filemtime($absolutePath) : time();
    }
}
