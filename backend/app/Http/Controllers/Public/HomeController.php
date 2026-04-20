<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Banner;
use App\Models\Extracurricular;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Post;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $settings = SiteSetting::query()->where('is_public', true)->get()->pluck('value', 'key');
        $featuredPosts = Post::query()
            ->with('categoryRecord')
            ->where('status', 'published')
            ->where('show_in_slider', true)
            ->latest('published_at')
            ->take(5)
            ->get();

        $fallbackBanners = Banner::query()
            ->where('status', 'published')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        return view('public.home', [
            'featuredPosts' => $featuredPosts,
            'fallbackBanners' => $fallbackBanners,
            'welcomePage' => Page::query()->where('slug', 'sambutan-kepala-sekolah')->first(),
            'profilePage' => Page::query()->where('slug', 'profil-sekolah')->first(),
            'latestPosts' => Post::query()->with('categoryRecord')->where('status', 'published')->latest('published_at')->take(6)->get(),
            'announcements' => Announcement::query()->where('status', 'published')->orderByDesc('event_date')->take(4)->get(),
            'galleries' => Gallery::query()->where('status', 'published')->latest()->take(6)->get(),
            'extracurriculars' => Extracurricular::query()->where('status', 'published')->take(4)->get(),
            'settings' => $settings,
        ] + $this->buildSeo(
            $settings['site_name'] ?? 'SMAN Ilum Modern',
            $settings['site_description'] ?? 'Website sekolah modern dan profesional.',
            $settings['default_og_image'] ?? null,
            'website'
        ));
    }
}
