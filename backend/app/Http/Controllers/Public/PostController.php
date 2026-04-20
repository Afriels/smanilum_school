<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        $category = $request->string('category')->toString();
        $search = $request->string('search')->toString();

        $posts = Post::query()
            ->with('categoryRecord')
            ->where('status', 'published')
            ->when($category !== '', function ($query) use ($category) {
                $query->whereHas('categoryRecord', function ($subQuery) use ($category) {
                    $subQuery->where('slug', $category);
                });
            })
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($builder) use ($search) {
                    $builder
                        ->where('title', 'like', '%'.$search.'%')
                        ->orWhere('excerpt', 'like', '%'.$search.'%');
                });
            })
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('public.posts.index', [
            'posts' => $posts,
            'categories' => PostCategory::query()->orderBy('name')->get(),
        ] + $this->buildSeo(
            'Berita & Pengumuman',
            'Daftar berita, pengumuman, dan informasi terbaru sekolah.',
            null,
            'website'
        ));
    }

    public function show(string $slug): View
    {
        $post = Post::query()
            ->with('categoryRecord', 'author')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $relatedPosts = Post::query()
            ->with('categoryRecord')
            ->where('id', '!=', $post->id)
            ->where('status', 'published')
            ->when($post->post_category_id, function ($query) use ($post) {
                $query->where('post_category_id', $post->post_category_id);
            })
            ->latest('published_at')
            ->take(4)
            ->get();

        if ($relatedPosts->count() < 4) {
            $excludeIds = $relatedPosts->pluck('id')->push($post->id)->all();

            $relatedPosts = $relatedPosts->concat(
                Post::query()
                    ->with('categoryRecord')
                    ->where('status', 'published')
                    ->whereNotIn('id', $excludeIds)
                    ->latest('published_at')
                    ->take(4 - $relatedPosts->count())
                    ->get()
            );
        }

        $recentPosts = Post::query()
            ->with('categoryRecord')
            ->where('id', '!=', $post->id)
            ->where('status', 'published')
            ->latest('published_at')
            ->take(5)
            ->get();

        $previousPost = Post::query()
            ->where('status', 'published')
            ->where('published_at', '<', $post->published_at ?? $post->created_at)
            ->latest('published_at')
            ->first();

        $nextPost = Post::query()
            ->where('status', 'published')
            ->where('published_at', '>', $post->published_at ?? $post->created_at)
            ->oldest('published_at')
            ->first();

        return view('public.posts.show', compact('post', 'relatedPosts', 'recentPosts', 'previousPost', 'nextPost') + $this->buildSeo(
            $post->seo_title ?: $post->title,
            $post->seo_description ?: $post->excerpt,
            $post->featured_image_path,
            'article',
            route('public.posts.show', $post->slug),
            [
                'published_time' => optional($post->published_at)?->toIso8601String(),
            ]
        ));
    }
}
