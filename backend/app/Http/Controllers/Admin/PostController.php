<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use App\Support\ActivityLogger;
use App\Support\UploadsMedia;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    use UploadsMedia;

    public function index(): View
    {
        return view('admin.posts.index', [
            'posts' => Post::query()->with('categoryRecord', 'author')->latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.posts.form', [
            'post' => new Post(['status' => 'draft']),
            'categories' => PostCategory::query()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validatePost($request);
        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);
        $validated['author_id'] = $request->user()->id;
        $validated['featured_image_path'] = $this->storeSupabaseMedia($request->file('featured_image'), 'posts', 'thumbnails');

        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $post = Post::query()->create($validated);
        ActivityLogger::log('post.created', 'Berita berhasil dibuat.', $post);

        return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil dibuat.');
    }

    public function edit(Post $post): View
    {
        return view('admin.posts.form', [
            'post' => $post,
            'categories' => PostCategory::query()->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        $validated = $this->validatePost($request, $post);
        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['title']);

        if ($request->hasFile('featured_image')) {
            $this->deletePublicFile($post->featured_image_path);
            $validated['featured_image_path'] = $this->storeSupabaseMedia($request->file('featured_image'), 'posts', 'thumbnails');
        }

        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = $post->published_at ?: now();
        }

        $post->update($validated);
        ActivityLogger::log('post.updated', 'Berita berhasil diperbarui.', $post);

        return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $this->deletePublicFile($post->featured_image_path);
        $post->delete();
        ActivityLogger::log('post.deleted', 'Berita berhasil dihapus.');

        return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil dihapus.');
    }

    private function validatePost(Request $request, ?Post $post = null): array
    {
        return $request->validate([
            'post_category_id' => ['nullable', 'exists:post_categories,id'],
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['nullable', 'string', 'max:190', 'unique:posts,slug,'.($post?->id ?? 'NULL')],
            'excerpt' => ['nullable', 'string'],
            'content' => ['required', 'string'],
            'status' => ['required', 'in:draft,published,archived'],
            'published_at' => ['nullable', 'date'],
            'seo_title' => ['nullable', 'string', 'max:190'],
            'seo_description' => ['nullable', 'string'],
            'is_featured' => ['nullable', 'boolean'],
            'show_in_slider' => ['nullable', 'boolean'],
            'featured_image' => $this->imageValidationRules(false, ['jpg', 'jpeg', 'png', 'webp'], 5120),
        ]) + [
            'type' => 'news',
            'category' => null,
            'is_featured' => $request->boolean('is_featured'),
            'show_in_slider' => $request->boolean('show_in_slider'),
        ];
    }
}
