<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Contracts\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $galleries = Gallery::query()
            ->where('status', 'published')
            ->latest()
            ->paginate(9);

        return view('public.galleries.index', compact('galleries') + $this->buildSeo(
            'Galeri Sekolah',
            'Dokumentasi foto dan kegiatan sekolah.',
            null,
            'website'
        ));
    }

    public function show(string $slug): View
    {
        $gallery = Gallery::query()
            ->with(['items' => fn ($query) => $query->orderBy('sort_order')])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('public.galleries.show', compact('gallery') + $this->buildSeo(
            $gallery->title,
            $gallery->description,
            $gallery->cover_image_path,
            'article'
        ));
    }
}
