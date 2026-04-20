<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Support\MediaUrl;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

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
                'description' => \Illuminate\Support\Str::limit(strip_tags((string) ($description ?: $defaultDescription)), 180),
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
        return MediaUrl::url($path, 'images/default.jpg');
    }

    protected function assetVersion(string $absolutePath): int
    {
        return file_exists($absolutePath) ? (int) filemtime($absolutePath) : time();
    }
}
