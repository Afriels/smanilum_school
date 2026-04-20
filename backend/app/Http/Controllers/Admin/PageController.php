<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Support\ActivityLogger;
use App\Support\UploadsMedia;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    use UploadsMedia;

    public function index(): View
    {
        return view('admin.pages.index', [
            'pages' => Page::query()->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.pages.form', ['page' => new Page(['status' => 'published'])]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePage($request);
        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);
        $validated['featured_image_path'] = $this->storeImage($request->file('featured_image'), 'pages');
        $page = Page::query()->create($validated);
        ActivityLogger::log('page.created', 'Halaman profil dibuat.', $page);

        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil dibuat.');
    }

    public function edit(Page $page): View
    {
        return view('admin.pages.form', compact('page'));
    }

    public function update(Request $request, Page $page): RedirectResponse
    {
        $validated = $this->validatePage($request, $page);
        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);

        if ($request->hasFile('featured_image')) {
            $this->deletePublicFile($page->featured_image_path);
            $validated['featured_image_path'] = $this->storeImage($request->file('featured_image'), 'pages');
        }

        $page->update($validated);
        ActivityLogger::log('page.updated', 'Halaman profil diperbarui.', $page);

        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil diperbarui.');
    }

    public function destroy(Page $page): RedirectResponse
    {
        $this->deletePublicFile($page->featured_image_path);
        $page->delete();
        ActivityLogger::log('page.deleted', 'Halaman profil dihapus.');

        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil dihapus.');
    }

    private function validatePage(Request $request, ?Page $page = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['nullable', 'string', 'max:190', 'unique:pages,slug,'.($page?->id ?? 'NULL')],
            'excerpt' => ['nullable', 'string'],
            'content' => ['required', 'string'],
            'status' => ['required', 'in:draft,published,archived'],
            'seo_title' => ['nullable', 'string', 'max:180'],
            'seo_description' => ['nullable', 'string'],
            'featured_image' => $this->imageValidationRules(false),
        ]);
    }
}

