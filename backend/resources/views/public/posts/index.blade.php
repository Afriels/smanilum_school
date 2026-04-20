@extends('public.layouts.app')

@section('title', 'Berita & Pengumuman | '.($siteSettings['site_name'] ?? 'SMAN Ilum Modern'))

@section('content')
    <section class="pt-10">
        <div class="mx-auto w-full max-w-7xl px-4">
            <div class="rounded-[2rem] border border-blue-100 bg-white/90 p-8 shadow-soft md:p-12">
                <div class="text-xs font-bold uppercase tracking-[0.25em] text-primary">Berita & Pengumuman</div>
                <h1 class="mt-4 text-4xl font-bold md:text-5xl">Informasi sekolah terbaru</h1>
                <p class="mt-5 max-w-3xl text-lg leading-8 text-slate-600">Cari berita, prestasi, dan pengumuman resmi sekolah secara cepat.</p>
                <form method="GET" class="mt-8 grid gap-4 md:grid-cols-[minmax(0,1fr)_220px_auto]">
                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Cari berita..." class="w-full rounded-full border border-blue-100 px-5 py-3">
                    <select name="category" class="w-full rounded-full border border-blue-100 px-5 py-3">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <button class="rounded-full bg-primary px-6 py-3 text-sm font-semibold text-white">Filter</button>
                </form>
            </div>
        </div>
    </section>

    <section class="pt-8">
        <div class="mx-auto grid w-full max-w-7xl gap-6 px-4 md:grid-cols-2 xl:grid-cols-3">
            @forelse ($posts as $post)
                <article class="overflow-hidden rounded-[1.75rem] border border-blue-100 bg-white/90 shadow-soft">
                    @if ($post->featured_image_path)
                        <img src="{{ \App\Support\MediaUrl::url($post->featured_image_path, 'images/default.jpg') }}" alt="{{ $post->title }}" class="h-56 w-full object-cover">
                    @else
                        <div class="h-56 bg-gradient-to-br from-blue-100 via-blue-200 to-blue-500"></div>
                    @endif
                    <div class="p-6">
                        <div class="text-xs font-bold uppercase tracking-[0.25em] text-primary">{{ $post->categoryRecord?->name ?? 'Berita' }}</div>
                        <h2 class="mt-3 text-xl font-bold">{{ $post->title }}</h2>
                        <p class="mt-3 text-sm leading-7 text-slate-600">{{ $post->excerpt }}</p>
                        <div class="mt-5 flex items-center justify-between">
                            <span class="text-xs uppercase tracking-[0.2em] text-slate-500">{{ optional($post->published_at)->format('d M Y') }}</span>
                            <a href="{{ route('public.posts.show', $post->slug) }}" class="text-sm font-semibold text-primary">Baca</a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full rounded-[1.75rem] border border-blue-100 bg-white/90 p-8 text-center text-slate-500 shadow-soft">
                    Belum ada berita yang tersedia.
                </div>
            @endforelse
        </div>
        <div class="mx-auto mt-8 w-full max-w-7xl px-4">
            {{ $posts->links() }}
        </div>
    </section>
@endsection
