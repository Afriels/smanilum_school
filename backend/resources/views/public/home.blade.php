@extends('public.layouts.app')

@section('title', ($siteSettings['site_name'] ?? 'SMAN Ilum Modern').' | Beranda')

@section('content')
    <section class="pt-10">
        <div class="mx-auto w-full max-w-7xl px-4">
            <div class="overflow-hidden rounded-[2rem] bg-gradient-to-br from-[#0a387f] via-[#0f4fbf] to-[#72a8ff] text-white shadow-soft" x-data="{ active: 0, total: {{ max($featuredPosts->count(), max($fallbackBanners->count(), 1)) }} }" x-init="setInterval(() => active = (active + 1) % total, 5000)">
                <template x-if="{{ $featuredPosts->count() > 0 ? 'true' : 'false' }}">
                    <div class="relative min-h-[440px]">
                        @foreach ($featuredPosts as $index => $post)
                            <div x-show="active === {{ $index }}" class="grid gap-8 px-8 py-10 md:px-12 md:py-14 lg:grid-cols-[minmax(0,1fr)_320px] lg:items-end" x-transition.opacity.duration.600ms>
                                <div>
                                    <div class="inline-flex rounded-full bg-white/15 px-4 py-2 text-xs font-bold uppercase tracking-[0.28em]">Berita Unggulan</div>
                                    <div class="mt-5 text-sm font-semibold uppercase tracking-[0.24em] text-white/75">{{ optional($post->published_at)->format('d M Y') }} • {{ $post->categoryRecord?->name ?? 'Berita Sekolah' }}</div>
                                    <h1 class="mt-3 max-w-3xl text-4xl font-bold leading-tight md:text-6xl">{{ $post->title }}</h1>
                                    <p class="mt-5 max-w-2xl text-lg leading-8 text-white/84">{{ $post->excerpt }}</p>
                                    <div class="mt-8 flex flex-wrap gap-4">
                                        <a href="{{ route('public.posts.show', $post->slug) }}" class="rounded-full bg-white px-6 py-3 text-sm font-semibold text-primary">Baca Selengkapnya</a>
                                        <a href="{{ route('public.contact') }}" class="rounded-full border border-white/30 px-6 py-3 text-sm font-semibold text-white">Hubungi Sekolah</a>
                                    </div>
                                </div>
                                <div class="rounded-[1.75rem] bg-white/10 p-5">
                                    @if ($post->featured_image_path)
                                        <img src="{{ \App\Support\MediaUrl::url($post->featured_image_path, 'images/default.jpg') }}" alt="{{ $post->title }}" class="h-72 w-full rounded-[1.5rem] object-cover">
                                    @else
                                        <div class="flex h-72 w-full items-center justify-center rounded-[1.5rem] bg-white/10 text-center text-lg font-semibold text-white/80">
                                            Featured News
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </template>

                @if ($featuredPosts->isEmpty())
                    @php($fallbackBanner = $fallbackBanners->first())
                    <div class="grid gap-8 px-8 py-10 md:px-12 md:py-14 lg:grid-cols-[minmax(0,1fr)_320px] lg:items-end">
                        <div>
                            <div class="inline-flex rounded-full bg-white/15 px-4 py-2 text-xs font-bold uppercase tracking-[0.28em]">Website Sekolah</div>
                            <h1 class="mt-5 max-w-3xl text-4xl font-bold leading-tight md:text-6xl">{{ $fallbackBanner->title ?? ($siteSettings['site_name'] ?? 'SMAN Ilum Modern') }}</h1>
                            <p class="mt-5 max-w-2xl text-lg leading-8 text-white/84">{{ $fallbackBanner->description ?? ($siteSettings['site_tagline'] ?? 'Sekolah unggul, berkarakter, dan siap menyongsong masa depan.') }}</p>
                            <div class="mt-8 flex flex-wrap gap-4">
                                <a href="{{ $fallbackBanner->primary_cta_url ?? route('public.profile') }}" class="rounded-full bg-white px-6 py-3 text-sm font-semibold text-primary">{{ $fallbackBanner->primary_cta_label ?? 'Lihat Profil' }}</a>
                                <a href="{{ $fallbackBanner->secondary_cta_url ?? route('public.contact') }}" class="rounded-full border border-white/30 px-6 py-3 text-sm font-semibold text-white">{{ $fallbackBanner->secondary_cta_label ?? 'Kontak' }}</a>
                            </div>
                        </div>
                        <div class="rounded-[1.75rem] bg-white/10 p-5">
                            @if($fallbackBanner?->image_path)
                                <img src="{{ \App\Support\MediaUrl::url($fallbackBanner->image_path, 'images/default.jpg') }}" alt="{{ $fallbackBanner->title }}" class="h-72 w-full rounded-[1.5rem] object-cover">
                            @else
                                <div class="flex h-72 items-center justify-center rounded-[1.5rem] bg-white/10 text-center text-xl font-semibold text-white/80">Banner Default Sekolah</div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="pt-8">
        <div class="mx-auto grid w-full max-w-7xl gap-6 px-4 lg:grid-cols-[minmax(0,1fr)_360px]">
            <div class="rounded-[2rem] border border-blue-100 bg-white/90 p-8 shadow-soft">
                <div class="inline-flex rounded-full bg-blue-50 px-4 py-2 text-xs font-bold uppercase tracking-[0.25em] text-primary">Sambutan</div>
                <h2 class="mt-5 text-4xl font-bold leading-tight">Membangun ekosistem belajar yang tertib, modern, dan berorientasi prestasi.</h2>
                <p class="mt-5 text-lg leading-8 text-slate-600">{{ $welcomePage->excerpt ?? 'Website sekolah ini dirancang untuk menjadi pusat informasi resmi yang cepat, rapi, dan mudah dikelola.' }}</p>
                <div class="mt-6 text-sm leading-8 text-slate-600">{!! nl2br(e(\Illuminate\Support\Str::limit(strip_tags($welcomePage->content ?? ''), 260))) !!}</div>
            </div>
            <div class="grid gap-4">
                <div class="rounded-[1.75rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
                    <div class="text-xs font-bold uppercase tracking-[0.25em] text-primary">Statistik</div>
                    <div class="mt-5 grid grid-cols-2 gap-4">
                        <div class="rounded-2xl bg-surface-soft p-4">
                            <div class="text-3xl font-bold text-primary">{{ $siteSettings['student_count'] ?? '1.240+' }}</div>
                            <div class="mt-1 text-sm text-slate-500">Peserta Didik</div>
                        </div>
                        <div class="rounded-2xl bg-surface-soft p-4">
                            <div class="text-3xl font-bold text-primary">{{ $siteSettings['teacher_count'] ?? '68' }}</div>
                            <div class="mt-1 text-sm text-slate-500">Guru & Staf</div>
                        </div>
                        <div class="rounded-2xl bg-surface-soft p-4">
                            <div class="text-3xl font-bold text-primary">{{ $siteSettings['extracurricular_count'] ?? '24' }}</div>
                            <div class="mt-1 text-sm text-slate-500">Ekstrakurikuler</div>
                        </div>
                        <div class="rounded-2xl bg-surface-soft p-4">
                            <div class="text-3xl font-bold text-primary">{{ $siteSettings['graduation_rate'] ?? '92%' }}</div>
                            <div class="mt-1 text-sm text-slate-500">Kelulusan</div>
                        </div>
                    </div>
                </div>
                <div class="rounded-[1.75rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
                    <div class="text-xs font-bold uppercase tracking-[0.25em] text-primary">Agenda & Pengumuman</div>
                    <div class="mt-5 space-y-3">
                        @forelse ($announcements as $announcement)
                            <div class="rounded-2xl bg-surface-soft p-4">
                                <div class="font-semibold">{{ $announcement->title }}</div>
                                <div class="mt-2 text-sm text-slate-500">{{ optional($announcement->event_date)->format('d M Y') }}</div>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500">Belum ada pengumuman terbaru.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto mt-16 w-full max-w-7xl px-4">
        <div class="flex items-end justify-between gap-4">
            <div>
                <div class="text-xs font-bold uppercase tracking-[0.25em] text-primary">Berita Terbaru</div>
                <h2 class="mt-3 text-3xl font-bold">Publikasi sekolah yang rapi dan mudah ditemukan.</h2>
            </div>
            <a href="{{ route('public.posts.index') }}" class="text-sm font-semibold text-primary">Lihat Semua</a>
        </div>
        <div class="mt-8 grid gap-5 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($latestPosts as $post)
                <article class="overflow-hidden rounded-[1.75rem] border border-blue-100 bg-white/90 shadow-soft">
                    @if ($post->featured_image_path)
                        <img src="{{ \App\Support\MediaUrl::url($post->featured_image_path, 'images/default.jpg') }}" alt="{{ $post->title }}" class="h-56 w-full object-cover">
                    @else
                        <div class="h-56 bg-gradient-to-br from-blue-100 via-blue-200 to-blue-500"></div>
                    @endif
                    <div class="p-6">
                        <div class="text-xs font-bold uppercase tracking-[0.24em] text-primary">{{ $post->categoryRecord?->name ?? 'Berita' }}</div>
                        <h3 class="mt-3 text-xl font-bold">{{ $post->title }}</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-600">{{ $post->excerpt }}</p>
                        <div class="mt-5 flex items-center justify-between">
                            <span class="text-xs uppercase tracking-[0.2em] text-slate-500">{{ optional($post->published_at)->format('d M Y') }}</span>
                            <a href="{{ route('public.posts.show', $post->slug) }}" class="text-sm font-semibold text-primary">Baca</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section class="mx-auto mt-16 w-full max-w-7xl px-4">
        <div class="grid gap-6 lg:grid-cols-2">
            <div>
                <div class="text-xs font-bold uppercase tracking-[0.25em] text-primary">Galeri Kegiatan</div>
                <h2 class="mt-3 text-3xl font-bold">Dokumentasi visual sekolah tetap elegan dan ringan.</h2>
                <div class="mt-8 grid gap-4 sm:grid-cols-2">
                    @foreach ($galleries as $gallery)
                        <a href="{{ route('public.galleries.show', $gallery->slug) }}" class="rounded-[1.5rem] border border-blue-100 bg-white/90 p-5 shadow-soft">
                            <div class="mb-4 h-40 rounded-[1.25rem] bg-gradient-to-br from-blue-100 via-blue-200 to-blue-500 @if($gallery->cover_image_path) bg-none @endif" @if($gallery->cover_image_path) style="background-image:url('{{ \App\Support\MediaUrl::url($gallery->cover_image_path, 'images/default.jpg') }}');background-size:cover;background-position:center;" @endif></div>
                            <div class="font-bold">{{ $gallery->title }}</div>
                            <div class="mt-2 text-sm leading-7 text-slate-600">{{ $gallery->description }}</div>
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="rounded-[2rem] border border-blue-100 bg-white/90 p-8 shadow-soft">
                <div class="text-xs font-bold uppercase tracking-[0.25em] text-primary">Ekstrakurikuler</div>
                <h2 class="mt-3 text-3xl font-bold">Ruang tumbuh untuk bakat, disiplin, dan kepemimpinan.</h2>
                <div class="mt-8 space-y-4">
                    @foreach ($extracurriculars as $extracurricular)
                        <div class="rounded-2xl border border-blue-100 p-4">
                            <div class="font-semibold">{{ $extracurricular->name }}</div>
                            <div class="mt-2 text-sm leading-7 text-slate-600">{{ $extracurricular->summary }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="mx-auto mt-16 w-full max-w-7xl px-4 pb-8">
        <div class="rounded-[2rem] bg-gradient-to-br from-primary-dark to-primary px-8 py-10 text-white shadow-soft">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                <div class="max-w-3xl">
                    <div class="text-xs font-bold uppercase tracking-[0.25em] text-white/70">Call To Action</div>
                    <h2 class="mt-3 text-3xl font-bold md:text-4xl">Siap dikembangkan lebih lanjut dengan workflow editorial yang rapi dan aman.</h2>
                </div>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('public.contact') }}" class="rounded-full bg-white px-6 py-3 text-sm font-semibold text-primary">Hubungi Sekolah</a>
                    <a href="{{ route('admin.login') }}" class="rounded-full border border-white/30 px-6 py-3 text-sm font-semibold text-white">Masuk Admin</a>
                </div>
            </div>
        </div>
    </section>
@endsection
