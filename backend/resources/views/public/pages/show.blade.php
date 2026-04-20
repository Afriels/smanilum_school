@extends('public.layouts.app')

@section('title', $page->title.' | '.($siteSettings['site_name'] ?? 'SMAN Ilum Modern'))
@section('meta_description', $page->seo_description ?? $page->excerpt)

@section('content')
    <section class="pt-10">
        <div class="mx-auto w-full max-w-6xl px-4">
            <div class="rounded-[2rem] border border-blue-100 bg-white/90 p-8 shadow-soft md:p-12">
                <div class="text-xs font-bold uppercase tracking-[0.25em] text-primary">Halaman Informasi</div>
                <h1 class="mt-4 text-4xl font-bold md:text-5xl">{{ $page->title }}</h1>
                @if ($page->excerpt)
                    <p class="mt-5 max-w-3xl text-lg leading-8 text-slate-600">{{ $page->excerpt }}</p>
                @endif
            </div>
        </div>
    </section>

    <section class="pt-8">
        <div class="mx-auto grid w-full max-w-6xl gap-8 px-4 lg:grid-cols-[minmax(0,1fr)_340px]">
            <article class="rounded-[2rem] border border-blue-100 bg-white/90 p-8 shadow-soft">
                @if ($page->featured_image_path)
                    <img src="{{ \App\Support\MediaUrl::url($page->featured_image_path, 'images/default.jpg') }}" alt="{{ $page->title }}" class="mb-8 h-72 w-full rounded-[1.5rem] object-cover">
                @endif
                <div class="prose prose-slate max-w-none prose-headings:text-ink prose-a:text-primary">
                    {!! $page->content !!}
                </div>
            </article>

            <aside class="space-y-6">
                <div class="rounded-[2rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
                    <h2 class="text-xl font-bold">Navigasi Halaman</h2>
                    <div class="mt-4 grid gap-3 text-sm text-slate-600">
                        <a href="{{ route('public.profile') }}">Profil Sekolah</a>
                        <a href="{{ route('public.academic') }}">Akademik</a>
                        <a href="{{ route('public.extracurriculars.index') }}">Ekstrakurikuler</a>
                        <a href="{{ route('public.contact') }}">Kontak</a>
                    </div>
                </div>
            </aside>
        </div>
    </section>
@endsection
