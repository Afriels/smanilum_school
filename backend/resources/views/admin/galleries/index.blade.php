@extends('admin.layouts.app')
@section('title', 'Galeri')
@section('page_heading', 'Galeri')
@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold">Album Galeri</h2>
        <a href="{{ route('admin.galleries.create') }}" class="rounded-full bg-primary px-5 py-3 text-sm font-semibold text-white">Tambah Galeri</a>
    </div>
    <div class="grid gap-5 md:grid-cols-2">
        @foreach($galleries as $gallery)
            <article class="rounded-[1.75rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
                <div class="font-bold">{{ $gallery->title }}</div>
                <div class="mt-2 text-sm text-slate-600">{{ $gallery->description }}</div>
                <div class="mt-2 text-xs uppercase tracking-[0.2em] text-slate-500">{{ $gallery->items_count }} item • {{ $gallery->status }}</div>
                <div class="mt-4 flex gap-3">
                    <a href="{{ route('admin.galleries.edit', $gallery) }}" class="text-primary">Edit</a>
                    <form method="POST" action="{{ route('admin.galleries.destroy', $gallery) }}" onsubmit="return confirm('Hapus galeri ini?')">@csrf @method('DELETE')<button class="text-rose-600">Hapus</button></form>
                </div>
            </article>
        @endforeach
    </div>
    <div class="mt-6">{{ $galleries->links() }}</div>
@endsection

