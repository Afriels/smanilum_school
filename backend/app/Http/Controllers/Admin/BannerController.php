<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Support\ActivityLogger;
use App\Support\UploadsMedia;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    use UploadsMedia;

    public function index(): View
    {
        return view('admin.banners.index', [
            'banners' => Banner::query()->orderBy('sort_order')->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.banners.form', ['banner' => new Banner(['status' => 'draft'])]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateBanner($request);
        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);
        $validated['image_path'] = $this->storeImage($request->file('image'), 'banners');
        $banner = Banner::query()->create($validated);
        ActivityLogger::log('banner.created', 'Banner dibuat.', $banner);

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil dibuat.');
    }

    public function edit(Banner $banner): View
    {
        return view('admin.banners.form', compact('banner'));
    }

    public function update(Request $request, Banner $banner): RedirectResponse
    {
        $validated = $this->validateBanner($request, $banner);
        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $this->deletePublicFile($banner->image_path);
            $validated['image_path'] = $this->storeImage($request->file('image'), 'banners');
        }

        $banner->update($validated);
        ActivityLogger::log('banner.updated', 'Banner diperbarui.', $banner);

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroy(Banner $banner): RedirectResponse
    {
        $this->deletePublicFile($banner->image_path);
        $banner->delete();
        ActivityLogger::log('banner.deleted', 'Banner dihapus.');

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil dihapus.');
    }

    private function validateBanner(Request $request, ?Banner $banner = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:160'],
            'slug' => ['nullable', 'string', 'max:180', 'unique:banners,slug,'.($banner?->id ?? 'NULL')],
            'subtitle' => ['nullable', 'string', 'max:190'],
            'description' => ['nullable', 'string'],
            'primary_cta_label' => ['nullable', 'string', 'max:90'],
            'primary_cta_url' => ['nullable', 'string', 'max:190'],
            'secondary_cta_label' => ['nullable', 'string', 'max:90'],
            'secondary_cta_url' => ['nullable', 'string', 'max:190'],
            'status' => ['required', 'in:draft,published,archived'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => $this->imageValidationRules(false),
        ]) + [
            'is_active' => $request->boolean('is_active'),
        ];
    }
}

