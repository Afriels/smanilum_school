@extends('public.layouts.app')

@section('title', 'Galeri | '.($siteSettings['site_name'] ?? 'SMAN Ilum Modern'))

@section('content')
    <section class="pt-10">
        <div class="mx-auto w-full max-w-7xl px-4">
            <div class="rounded-[2rem] border border-blue-100 bg-white/90 p-8 shadow-soft md:p-12">
                <div class="text-xs font-bold uppercase tracking-[0.25em] text-primary">Galeri Sekolah</div>
                <h1 class="mt-4 text-4xl font-bold md:text-5xl">Dokumentasi kegiatan dan momen sekolah</h1>
            </div>
        </div>
    </section>
    <section class="pt-8">
        <div class="mx-auto grid w-full max-w-7xl gap-6 px-4 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($galleries as $gallery)
                <a href="{{ route('public.galleries.show', $gallery->slug) }}" class="overflow-hidden rounded-[1.75rem] border border-blue-100 bg-white/90 shadow-soft">
                    @if ($gallery->cover_image_path)
                        <img src="{{ asset('storage/'.$gallery->cover_image_path) }}" alt="{{ $gallery->title }}" class="h-64 w-full object-cover">
                    @else
                        <div class="h-64 bg-gradient-to-br from-blue-100 via-blue-200 to-blue-500"></div>
                    @endif
                    <div class="p-6">
                        <h2 class="text-xl font-bold">{{ $gallery->title }}</h2>
                        <p class="mt-3 text-sm leading-7 text-slate-600">{{ $gallery->description }}</p>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="mx-auto mt-8 w-full max-w-7xl px-4">
            {{ $galleries->links() }}
        </div>
    </section>
@endsection

