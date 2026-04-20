@extends('public.layouts.app')

@section('title', $gallery->title.' | '.($siteSettings['site_name'] ?? 'SMAN Ilum Modern'))

@section('content')
    <section class="pt-10">
        <div class="mx-auto w-full max-w-6xl px-4">
            <div class="rounded-[2rem] border border-blue-100 bg-white/90 p-8 shadow-soft md:p-12">
                <div class="text-xs font-bold uppercase tracking-[0.25em] text-primary">Detail Galeri</div>
                <h1 class="mt-4 text-4xl font-bold md:text-5xl">{{ $gallery->title }}</h1>
                <p class="mt-5 max-w-3xl text-lg leading-8 text-slate-600">{{ $gallery->description }}</p>
            </div>
        </div>
    </section>
    <section class="pt-8">
        <div class="mx-auto w-full max-w-6xl px-4">
            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @forelse ($gallery->items as $item)
                    <div class="overflow-hidden rounded-[1.5rem] border border-blue-100 bg-white/90 shadow-soft">
                        @if ($item->file_path)
                            <img src="{{ \App\Support\MediaUrl::url($item->file_path, 'images/default.jpg') }}" alt="{{ $item->title }}" class="h-64 w-full object-cover">
                        @else
                            <div class="h-64 bg-gradient-to-br from-blue-100 via-blue-200 to-blue-500"></div>
                        @endif
                        <div class="p-4 text-sm font-semibold">{{ $item->title }}</div>
                    </div>
                @empty
                    <div class="col-span-full rounded-[1.5rem] border border-blue-100 bg-white/90 p-8 text-center text-slate-500 shadow-soft">
                        Belum ada foto di album ini.
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
