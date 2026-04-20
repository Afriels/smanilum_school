@extends('admin.layouts.app')
@section('title', 'Banner Slider')
@section('page_heading', 'Banner Slider')
@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold">Banner / Fallback Slider</h2>
        <a href="{{ route('admin.banners.create') }}" class="rounded-full bg-primary px-5 py-3 text-sm font-semibold text-white">Tambah Banner</a>
    </div>
    <div class="grid gap-5 md:grid-cols-2">
        @foreach($banners as $banner)
            <article class="rounded-[1.75rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
                <div class="font-bold">{{ $banner->title }}</div>
                <div class="mt-2 text-sm text-slate-600">{{ $banner->subtitle }}</div>
                <div class="mt-3 text-xs uppercase tracking-[0.2em] text-slate-500">{{ $banner->status }} • sort {{ $banner->sort_order }}</div>
                <div class="mt-5 flex gap-3">
                    <a href="{{ route('admin.banners.edit', $banner) }}" class="text-primary">Edit</a>
                    <form method="POST" action="{{ route('admin.banners.destroy', $banner) }}" onsubmit="return confirm('Hapus banner ini?')">
                        @csrf @method('DELETE')
                        <button class="text-rose-600">Hapus</button>
                    </form>
                </div>
            </article>
        @endforeach
    </div>
    <div class="mt-6">{{ $banners->links() }}</div>
@endsection

