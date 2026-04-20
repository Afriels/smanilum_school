<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    public function show(string $slug): View
    {
        $page = Page::query()
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('public.pages.show', compact('page') + $this->buildSeo(
            $page->seo_title ?: $page->title,
            $page->seo_description ?: $page->excerpt,
            $page->featured_image_path,
            'article'
        ));
    }
}
