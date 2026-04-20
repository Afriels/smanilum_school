<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PostCategory;
use App\Support\ActivityLogger;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostCategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.categories.index', [
            'categories' => PostCategory::query()->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.categories.form', ['category' => new PostCategory()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'slug' => ['nullable', 'string', 'max:140', 'unique:post_categories,slug'],
            'description' => ['nullable', 'string'],
        ]);

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $category = PostCategory::query()->create($validated);
        ActivityLogger::log('category.created', 'Kategori berita dibuat.', $category);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dibuat.');
    }

    public function edit(PostCategory $category): View
    {
        return view('admin.categories.form', compact('category'));
    }

    public function update(Request $request, PostCategory $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'slug' => ['nullable', 'string', 'max:140', 'unique:post_categories,slug,'.$category->id],
            'description' => ['nullable', 'string'],
        ]);

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $category->update($validated);
        ActivityLogger::log('category.updated', 'Kategori berita diperbarui.', $category);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(PostCategory $category): RedirectResponse
    {
        $category->delete();
        ActivityLogger::log('category.deleted', 'Kategori berita dihapus.');

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}

