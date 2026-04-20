<?php

namespace App\Http\Controllers\Api;

use App\Models\ContactMessage;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\SiteSetting;
use App\Support\MediaUrl;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicContentController extends Controller
{
    public function bootstrap(): JsonResponse
    {
        return response()->json([
            'site' => [
                'name' => $this->setting('site_name', 'SMAN Ilum Modern'),
                'tagline' => $this->setting('site_tagline', 'Sekolah Unggul, Berkarakter, dan Siap Menyongsong Masa Depan'),
                'address' => $this->setting('address', 'Jl. Pendidikan Nusantara No. 10'),
                'phone' => $this->setting('phone', '(0334) 765432'),
                'email' => $this->setting('email', 'info@smanilum.test'),
                'logo_url' => MediaUrl::url($this->settingOrNull('logo'), 'images/logo-default.svg'),
                'favicon_url' => MediaUrl::url($this->settingOrNull('favicon'), 'images/favicon.ico'),
            ],
        ]);
    }

    public function home(): JsonResponse
    {
        $latestPosts = Post::query()
            ->where('status', 'published')
            ->latest('published_at')
            ->limit(6)
            ->get(['type', 'category', 'title', 'slug', 'excerpt', 'published_at', 'featured_image_path'])
            ->map(function (Post $post) {
                return [
                    'type' => $post->type,
                    'category' => $post->category,
                    'title' => $post->title,
                    'slug' => $post->slug,
                    'excerpt' => $post->excerpt,
                    'published_at' => $post->published_at,
                    'featured_image_url' => MediaUrl::url($post->featured_image_path, 'images/default.jpg'),
                ];
            });

        return response()->json([
            'hero' => [
                'title' => $this->setting('site_name', 'SMAN Ilum Modern'),
                'tagline' => $this->setting('site_tagline', 'Sekolah Unggul, Berkarakter, dan Siap Menyongsong Masa Depan'),
                'description' => $this->setting('site_description', 'Website resmi sekolah modern yang cepat, aman, dan mudah dikelola.'),
                'default_og_image_url' => MediaUrl::url($this->settingOrNull('default_og_image'), 'images/default.jpg'),
            ],
            'posts' => $latestPosts,
        ]);
    }

    public function posts(Request $request): JsonResponse
    {
        $type = $request->string('type')->toString();
        $search = $request->string('search')->toString();

        $query = Post::query()->where('status', 'published');

        if ($type !== '') {
            $query->where('type', $type);
        }

        if ($search !== '') {
            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('title', 'like', '%'.$search.'%')
                    ->orWhere('excerpt', 'like', '%'.$search.'%')
                    ->orWhere('content', 'like', '%'.$search.'%');
            });
        }

        $paginated = $query->latest('published_at')->paginate(12);
        $paginated->getCollection()->transform(function (Post $post) {
            $post->featured_image_url = MediaUrl::url($post->featured_image_path, 'images/default.jpg');

            return $post;
        });

        return response()->json([
            'data' => $paginated,
        ]);
    }

    public function showPost(string $slug): JsonResponse
    {
        $post = Post::query()
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return response()->json([
            'data' => array_merge($post->toArray(), [
                'featured_image_url' => MediaUrl::url($post->featured_image_path, 'images/default.jpg'),
            ]),
            'reading_time' => max(1, (int) ceil(str_word_count(strip_tags((string) $post->content)) / 180)),
        ]);
    }

    public function contact(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:120'],
            'subject' => ['required', 'string', 'max:180'],
            'message' => ['required', 'string', 'max:3000'],
            'company' => ['nullable', 'max:0'],
        ]);

        if (! empty($validated['company'] ?? null)) {
            abort(422, 'Validasi form gagal.');
        }

        ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status' => 'new',
            'ip_address' => $request->ip(),
        ]);

        return response()->json([
            'message' => 'Pesan berhasil diterima. Integrasikan penyimpanan atau email pada tahap berikutnya.',
            'tracking_code' => Str::upper(Str::random(10)),
        ], 201);
    }

    private function setting(string $key, string $fallback): string
    {
        return (string) SiteSetting::query()
            ->where('key', $key)
            ->value('value') ?: $fallback;
    }

    private function settingOrNull(string $key): ?string
    {
        return SiteSetting::query()
            ->where('key', $key)
            ->value('value');
    }
}
