@extends('public.layouts.app')

@section('title', $post->title.' | '.($siteSettings['site_name'] ?? 'SMAN Ilum Modern'))
@section('meta_description', $post->seo_description ?? $post->excerpt)

@section('head')
    <style>
        .article-body {
            color: #334155;
            font-size: 1.0625rem;
            line-height: 1.95;
        }

        .article-body > * + * {
            margin-top: 1.25rem;
        }

        .article-body h2,
        .article-body h3,
        .article-body h4 {
            color: #11233f;
            font-weight: 700;
            line-height: 1.3;
            margin-top: 2rem;
        }

        .article-body h2 {
            font-size: 1.8rem;
        }

        .article-body h3 {
            font-size: 1.45rem;
        }

        .article-body p,
        .article-body ul,
        .article-body ol,
        .article-body blockquote {
            margin-top: 1rem;
        }

        .article-body ul,
        .article-body ol {
            padding-left: 1.25rem;
        }

        .article-body li + li {
            margin-top: 0.45rem;
        }

        .article-body a {
            color: #0f4fbf;
            font-weight: 600;
            text-decoration: none;
        }

        .article-body blockquote {
            border-left: 4px solid #93c5fd;
            background: #eff6ff;
            border-radius: 1rem;
            padding: 1rem 1.25rem;
            color: #1e3a8a;
        }

        .article-body img {
            border-radius: 1.5rem;
            margin-top: 1.5rem;
        }
    </style>
@endsection

@section('content')
    @php
        $shareUrl = route('public.posts.show', $post->slug);
        $shareText = $post->title;
        $readingTime = max(1, (int) ceil(str_word_count(strip_tags($post->content ?? '')) / 220));
    @endphp

    <section class="pt-8">
        <div class="mx-auto w-full max-w-7xl px-4">
            <div class="rounded-[2rem] border border-blue-100 bg-white/90 p-6 shadow-soft md:p-10">
                <div class="flex flex-wrap items-center gap-3 text-sm text-slate-500">
                    <a href="{{ route('public.home') }}" class="font-medium text-slate-500 hover:text-primary">Beranda</a>
                    <span>/</span>
                    <a href="{{ route('public.posts.index') }}" class="font-medium text-slate-500 hover:text-primary">Berita</a>
                    <span>/</span>
                    <span class="text-primary">{{ \Illuminate\Support\Str::limit($post->title, 72) }}</span>
                </div>

                <div class="mt-6 flex flex-wrap items-center gap-3">
                    <span class="inline-flex rounded-full bg-blue-50 px-4 py-2 text-xs font-bold uppercase tracking-[0.24em] text-primary">
                        {{ $post->categoryRecord?->name ?? 'Berita Sekolah' }}
                    </span>
                    @if ($post->is_featured)
                        <span class="inline-flex rounded-full bg-primary px-4 py-2 text-xs font-bold uppercase tracking-[0.24em] text-white">
                            Berita Unggulan
                        </span>
                    @endif
                </div>

                <div class="mt-6 grid gap-8 lg:grid-cols-[minmax(0,1fr)_280px] lg:items-end">
                    <div>
                        <h1 class="max-w-4xl text-3xl font-bold leading-tight text-ink md:text-5xl">
                            {{ $post->title }}
                        </h1>
                        <p class="mt-5 max-w-3xl text-base leading-8 text-slate-600 md:text-lg">
                            {{ $post->excerpt }}
                        </p>
                    </div>

                    <div class="rounded-[1.5rem] bg-surface-soft p-5">
                        <div class="text-xs font-bold uppercase tracking-[0.24em] text-primary">Ringkasan Publikasi</div>
                        <dl class="mt-4 space-y-4 text-sm text-slate-600">
                            <div>
                                <dt class="font-semibold text-ink">Tanggal Terbit</dt>
                                <dd class="mt-1">{{ optional($post->published_at)->translatedFormat('d F Y') ?? '-' }}</dd>
                            </div>
                            <div>
                                <dt class="font-semibold text-ink">Penulis</dt>
                                <dd class="mt-1">{{ $post->author?->name ?? 'Admin Sekolah' }}</dd>
                            </div>
                            <div>
                                <dt class="font-semibold text-ink">Estimasi Baca</dt>
                                <dd class="mt-1">{{ $readingTime }} menit</dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-8">
        <div class="mx-auto grid w-full max-w-7xl gap-8 px-4 lg:grid-cols-[minmax(0,1fr)_340px]">
            <article class="overflow-hidden rounded-[2rem] border border-blue-100 bg-white/90 shadow-soft">
                @if ($post->featured_image_path)
                    <img src="{{ \App\Support\MediaUrl::url($post->featured_image_path, 'images/default.jpg') }}" alt="{{ $post->title }}" class="h-[280px] w-full object-cover md:h-[420px]">
                @else
                    <div class="h-[280px] w-full bg-gradient-to-br from-blue-100 via-blue-200 to-blue-500 md:h-[420px]"></div>
                @endif

                <div class="border-b border-blue-100 px-6 py-5 md:px-10">
                    <div class="flex flex-wrap items-center gap-3 text-sm text-slate-500">
                        <span class="rounded-full bg-blue-50 px-4 py-2 font-semibold text-primary">
                            {{ $post->categoryRecord?->name ?? 'Berita' }}
                        </span>
                        <span>{{ optional($post->published_at)->translatedFormat('d F Y') }}</span>
                        <span>&bull;</span>
                        <span>{{ $post->author?->name ?? 'Admin Sekolah' }}</span>
                    </div>
                </div>

                <div class="px-6 py-8 md:px-10 md:py-10">
                    <div class="article-body max-w-none">
                        {!! $post->content !!}
                    </div>
                </div>

                <div class="border-t border-blue-100 px-6 py-6 md:px-10">
                    <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">
                        <div>
                            <div class="text-xs font-bold uppercase tracking-[0.24em] text-primary">Bagikan Berita</div>
                            <p class="mt-2 text-sm leading-7 text-slate-600">Gunakan tautan ini untuk membagikan artikel ke WhatsApp, Facebook, atau Telegram.</p>
                        </div>
                        <div class="flex flex-wrap gap-3">
                            <a href="https://wa.me/?text={{ rawurlencode($shareText.' '.$shareUrl) }}" target="_blank" rel="noopener noreferrer" class="rounded-full border border-blue-100 px-4 py-2 text-sm font-semibold text-ink hover:bg-blue-50">WhatsApp</a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ rawurlencode($shareUrl) }}" target="_blank" rel="noopener noreferrer" class="rounded-full border border-blue-100 px-4 py-2 text-sm font-semibold text-ink hover:bg-blue-50">Facebook</a>
                            <a href="https://t.me/share/url?url={{ rawurlencode($shareUrl) }}&text={{ rawurlencode($shareText) }}" target="_blank" rel="noopener noreferrer" class="rounded-full border border-blue-100 px-4 py-2 text-sm font-semibold text-ink hover:bg-blue-50">Telegram</a>
                            <a href="{{ route('public.posts.index') }}" class="rounded-full bg-primary px-5 py-2 text-sm font-semibold text-white">Kembali ke Berita</a>
                        </div>
                    </div>
                </div>
            </article>

            <aside class="space-y-6 lg:sticky lg:top-28 lg:self-start">
                <div class="rounded-[2rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
                    <div class="text-xs font-bold uppercase tracking-[0.24em] text-primary">Informasi Artikel</div>
                    <div class="mt-5 space-y-4 text-sm text-slate-600">
                        <div class="rounded-2xl bg-surface-soft p-4">
                            <div class="font-semibold text-ink">Kategori</div>
                            <div class="mt-1">{{ $post->categoryRecord?->name ?? 'Berita Sekolah' }}</div>
                        </div>
                        <div class="rounded-2xl bg-surface-soft p-4">
                            <div class="font-semibold text-ink">Publikasi</div>
                            <div class="mt-1">{{ optional($post->published_at)->translatedFormat('l, d F Y') ?? '-' }}</div>
                        </div>
                        <div class="rounded-2xl bg-surface-soft p-4">
                            <div class="font-semibold text-ink">Slug URL</div>
                            <div class="mt-1 break-all">{{ $post->slug }}</div>
                        </div>
                    </div>
                </div>

                @if ($recentPosts->isNotEmpty())
                    <div class="rounded-[2rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
                        <h2 class="text-xl font-bold">Berita Terbaru</h2>
                        <div class="mt-4 space-y-4">
                            @foreach ($recentPosts as $recent)
                                <a href="{{ route('public.posts.show', $recent->slug) }}" class="block rounded-2xl border border-blue-100 p-4 transition hover:bg-blue-50/60">
                                    <div class="text-xs font-bold uppercase tracking-[0.22em] text-primary">{{ $recent->categoryRecord?->name ?? 'Berita' }}</div>
                                    <div class="mt-2 font-semibold leading-7 text-ink">{{ $recent->title }}</div>
                                    <div class="mt-2 text-xs uppercase tracking-[0.2em] text-slate-500">{{ optional($recent->published_at)->format('d M Y') }}</div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($relatedPosts->isNotEmpty())
                    <div class="rounded-[2rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
                        <h2 class="text-xl font-bold">Artikel Terkait</h2>
                        <div class="mt-4 space-y-4">
                            @foreach ($relatedPosts as $related)
                                <a href="{{ route('public.posts.show', $related->slug) }}" class="block rounded-2xl bg-surface-soft p-4">
                                    <div class="text-xs font-bold uppercase tracking-[0.22em] text-primary">{{ $related->categoryRecord?->name ?? 'Berita' }}</div>
                                    <div class="mt-2 font-semibold leading-7 text-ink">{{ $related->title }}</div>
                                    <div class="mt-2 text-xs uppercase tracking-[0.2em] text-slate-500">{{ optional($related->published_at)->format('d M Y') }}</div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($previousPost || $nextPost)
                    <div class="rounded-[2rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
                        <h2 class="text-xl font-bold">Navigasi Artikel</h2>
                        <div class="mt-4 space-y-4">
                            @if ($previousPost)
                                <a href="{{ route('public.posts.show', $previousPost->slug) }}" class="block rounded-2xl border border-blue-100 p-4 transition hover:bg-blue-50/60">
                                    <div class="text-xs font-bold uppercase tracking-[0.22em] text-slate-500">Artikel Sebelumnya</div>
                                    <div class="mt-2 font-semibold leading-7 text-ink">{{ $previousPost->title }}</div>
                                </a>
                            @endif

                            @if ($nextPost)
                                <a href="{{ route('public.posts.show', $nextPost->slug) }}" class="block rounded-2xl border border-blue-100 p-4 transition hover:bg-blue-50/60">
                                    <div class="text-xs font-bold uppercase tracking-[0.22em] text-slate-500">Artikel Berikutnya</div>
                                    <div class="mt-2 font-semibold leading-7 text-ink">{{ $nextPost->title }}</div>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </aside>
        </div>
    </section>

    <section class="mx-auto mt-14 w-full max-w-7xl px-4 pb-8">
        <div class="rounded-[2rem] bg-gradient-to-br from-primary-dark to-primary px-8 py-10 text-white shadow-soft">
            <div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_auto] lg:items-center">
                <div>
                    <div class="text-xs font-bold uppercase tracking-[0.25em] text-white/70">Informasi Resmi Sekolah</div>
                    <h2 class="mt-3 text-3xl font-bold">Butuh informasi lebih lanjut mengenai program, kegiatan, atau layanan sekolah?</h2>
                    <p class="mt-4 max-w-3xl text-sm leading-7 text-white/80">
                        Tim sekolah siap membantu kebutuhan informasi orang tua, siswa, calon peserta didik, dan mitra institusi melalui kanal resmi yang tersedia.
                    </p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('public.contact') }}" class="rounded-full bg-white px-6 py-3 text-sm font-semibold text-primary">Hubungi Sekolah</a>
                    <a href="{{ route('public.profile') }}" class="rounded-full border border-white/30 px-6 py-3 text-sm font-semibold text-white">Lihat Profil</a>
                </div>
            </div>
        </div>
    </section>
@endsection
