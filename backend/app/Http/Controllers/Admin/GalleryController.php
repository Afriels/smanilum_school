<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryItem;
use App\Support\ActivityLogger;
use App\Support\UploadsMedia;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    use UploadsMedia;

    public function index(): View
    {
        return view('admin.galleries.index', [
            'galleries' => Gallery::query()->withCount('items')->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.galleries.form', ['gallery' => new Gallery(['status' => 'published'])]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateGallery($request);
        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);
        $validated['cover_image_path'] = $this->storeImage($request->file('cover_image'), 'galleries');
        $gallery = Gallery::query()->create($validated);

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $image) {
                GalleryItem::query()->create([
                    'album_id' => $gallery->id,
                    'title' => $gallery->title.' '.($index + 1),
                    'file_path' => $this->storeImage($image, 'galleries/items'),
                    'thumbnail_path' => null,
                    'mime_type' => $image->getMimeType(),
                    'sort_order' => $index,
                ]);
            }
        }

        ActivityLogger::log('gallery.created', 'Galeri dibuat.', $gallery);

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil dibuat.');
    }

    public function edit(Gallery $gallery): View
    {
        $gallery->load('items');

        return view('admin.galleries.form', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery): RedirectResponse
    {
        $validated = $this->validateGallery($request, $gallery);
        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);

        if ($request->hasFile('cover_image')) {
            $this->deletePublicFile($gallery->cover_image_path);
            $validated['cover_image_path'] = $this->storeImage($request->file('cover_image'), 'galleries');
        }

        $gallery->update($validated);

        if ($request->hasFile('gallery_images')) {
            $nextSort = (int) $gallery->items()->max('sort_order') + 1;
            foreach ($request->file('gallery_images') as $index => $image) {
                GalleryItem::query()->create([
                    'album_id' => $gallery->id,
                    'title' => $gallery->title.' '.($nextSort + $index),
                    'file_path' => $this->storeImage($image, 'galleries/items'),
                    'thumbnail_path' => null,
                    'mime_type' => $image->getMimeType(),
                    'sort_order' => $nextSort + $index,
                ]);
            }
        }

        ActivityLogger::log('gallery.updated', 'Galeri diperbarui.', $gallery);

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        $this->deletePublicFile($gallery->cover_image_path);
        foreach ($gallery->items as $item) {
            $this->deletePublicFile($item->file_path);
        }
        $gallery->delete();
        ActivityLogger::log('gallery.deleted', 'Galeri dihapus.');

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil dihapus.');
    }

    private function validateGallery(Request $request, ?Gallery $gallery = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['nullable', 'string', 'max:190', 'unique:gallery_albums,slug,'.($gallery?->id ?? 'NULL')],
            'description' => ['nullable', 'string'],
            'type' => ['required', 'in:photo,video'],
            'status' => ['required', 'in:draft,published,archived'],
            'cover_image' => $this->imageValidationRules(false),
            'gallery_images.*' => $this->imageValidationRules(false),
        ]) + [
            'is_featured' => $request->boolean('is_featured'),
        ];
    }
}

