<?php

namespace App\Http\Controllers\Api;

use App\Models\ContactMessage;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\SiteSetting;
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
            ],
        ]);
    }

    public function home(): JsonResponse
    {
        $latestPosts = Post::query()
            ->where('status', 'published')
            ->latest('published_at')
            ->limit(6)
            ->get(['type', 'category', 'title', 'slug', 'excerpt', 'published_at']);

        return response()->json([
            'hero' => [
                'title' => $this->setting('site_name', 'SMAN Ilum Modern'),
                'tagline' => $this->setting('site_tagline', 'Sekolah Unggul, Berkarakter, dan Siap Menyongsong Masa Depan'),
                'description' => $this->setting('site_description', 'Website resmi sekolah modern yang cepat, aman, dan mudah dikelola.'),
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

        return response()->json([
            'data' => $query->latest('published_at')->paginate(12),
        ]);
    }

    public function showPost(string $slug): JsonResponse
    {
        $post = Post::query()
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return response()->json([
            'data' => $post,
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
}
