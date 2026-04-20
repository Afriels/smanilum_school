@extends('public.layouts.app')

@section('title', 'Ekstrakurikuler | '.($siteSettings['site_name'] ?? 'SMAN Ilum Modern'))

@section('content')
    <section class="pt-10">
        <div class="mx-auto w-full max-w-7xl px-4">
            <div class="rounded-[2rem] border border-blue-100 bg-white/90 p-8 shadow-soft md:p-12">
                <div class="text-xs font-bold uppercase tracking-[0.25em] text-primary">Ekstrakurikuler</div>
                <h1 class="mt-4 text-4xl font-bold md:text-5xl">Kegiatan pengembangan minat dan bakat siswa</h1>
            </div>
        </div>
    </section>
    <section class="pt-8">
        <div class="mx-auto grid w-full max-w-7xl gap-6 px-4 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($extracurriculars as $extracurricular)
                <article class="overflow-hidden rounded-[1.75rem] border border-blue-100 bg-white/90 shadow-soft">
                    @if ($extracurricular->featured_image_path)
                        <img src="{{ \App\Support\MediaUrl::url($extracurricular->featured_image_path, 'images/default.jpg') }}" alt="{{ $extracurricular->name }}" class="h-60 w-full object-cover">
                    @else
                        <div class="h-60 bg-gradient-to-br from-blue-100 via-blue-200 to-blue-500"></div>
                    @endif
                    <div class="p-6">
                        <h2 class="text-xl font-bold">{{ $extracurricular->name }}</h2>
                        <p class="mt-3 text-sm leading-7 text-slate-600">{{ $extracurricular->summary }}</p>
                        <div class="mt-4 text-sm leading-7 text-slate-500">{{ \Illuminate\Support\Str::limit(strip_tags($extracurricular->description), 160) }}</div>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="mx-auto mt-8 w-full max-w-7xl px-4">
            {{ $extracurriculars->links() }}
        </div>
    </section>
@endsection
