@extends('admin.layouts.app')
@section('title', $page->exists ? 'Edit Halaman' : 'Tambah Halaman')
@section('page_heading', $page->exists ? 'Edit Halaman' : 'Tambah Halaman')
@section('content')
    <form method="POST" enctype="multipart/form-data" action="{{ $page->exists ? route('admin.pages.update', $page) : route('admin.pages.store') }}" class="grid gap-6">
        @csrf @if($page->exists) @method('PUT') @endif
        <div class="rounded-[1.75rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
            <div class="grid gap-5">
                <div><label class="mb-2 block text-sm font-semibold">Judul</label><input type="text" name="title" value="{{ old('title', $page->title) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                <div><label class="mb-2 block text-sm font-semibold">Slug</label><input type="text" name="slug" value="{{ old('slug', $page->slug) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                <div><label class="mb-2 block text-sm font-semibold">Ringkasan</label><textarea name="excerpt" rows="3" class="w-full rounded-2xl border border-blue-100 px-4 py-3">{{ old('excerpt', $page->excerpt) }}</textarea></div>
                <div><label class="mb-2 block text-sm font-semibold">Konten</label><textarea name="content" rows="14" class="w-full rounded-2xl border border-blue-100 px-4 py-3">{{ old('content', $page->content) }}</textarea></div>
                <div class="grid gap-5 md:grid-cols-2">
                    <div><label class="mb-2 block text-sm font-semibold">Status</label><select name="status" class="w-full rounded-2xl border border-blue-100 px-4 py-3">@foreach(['draft','published','archived'] as $status)<option value="{{ $status }}" @selected(old('status', $page->status) === $status)>{{ ucfirst($status) }}</option>@endforeach</select></div>
                    <div><label class="mb-2 block text-sm font-semibold">Gambar Halaman</label><input type="file" name="featured_image" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                </div>
            </div>
        </div>
        <div class="flex gap-4"><button class="rounded-full bg-primary px-6 py-3 text-sm font-semibold text-white">Simpan</button></div>
    </form>
@endsection

