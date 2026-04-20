@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')
@section('page_heading', 'Dashboard Utama')

@section('content')
    <section class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
        @foreach ($stats as $label => $value)
            <article class="rounded-[1.75rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
                <div class="text-xs font-bold uppercase tracking-[0.25em] text-slate-500">{{ str_replace('_', ' ', $label) }}</div>
                <div class="mt-3 text-4xl font-bold text-primary">{{ $value }}</div>
            </article>
        @endforeach
    </section>

    <section class="mt-8 grid gap-6 xl:grid-cols-[minmax(0,1fr)_360px]">
        <article class="rounded-[1.75rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold">Aktivitas Admin</h2>
                    <p class="mt-2 text-sm text-slate-600">Audit log terbaru dari login dan pengelolaan konten.</p>
                </div>
            </div>
            <div class="mt-6 space-y-4">
                @forelse ($recentAudits as $audit)
                    <div class="rounded-2xl bg-surface-soft p-4">
                        <div class="text-sm font-semibold">{{ $audit->description }}</div>
                        <div class="mt-2 text-xs uppercase tracking-[0.2em] text-slate-500">{{ $audit->event }} • {{ $audit->created_at?->format('d M Y H:i') }}</div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada aktivitas terbaru.</p>
                @endforelse
            </div>
        </article>

        <aside class="rounded-[1.75rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
            <h2 class="text-2xl font-bold">Postingan Terbaru</h2>
            <div class="mt-6 space-y-4">
                @foreach ($recentPosts as $post)
                    <div class="rounded-2xl border border-blue-100 p-4">
                        <div class="font-semibold">{{ $post->title }}</div>
                        <div class="mt-2 text-xs uppercase tracking-[0.2em] text-slate-500">{{ $post->status }} • {{ $post->created_at?->format('d M Y') }}</div>
                    </div>
                @endforeach
            </div>
        </aside>
    </section>
@endsection

