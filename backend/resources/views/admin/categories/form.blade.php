@extends('admin.layouts.app')
@section('title', $category->exists ? 'Edit Kategori' : 'Tambah Kategori')
@section('page_heading', $category->exists ? 'Edit Kategori' : 'Tambah Kategori')
@section('content')
    <form method="POST" action="{{ $category->exists ? route('admin.categories.update', $category) : route('admin.categories.store') }}" class="grid gap-6">
        @csrf
        @if($category->exists) @method('PUT') @endif
        <div class="rounded-[1.75rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
            <div class="grid gap-5">
                <div>
                    <label class="mb-2 block text-sm font-semibold">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $category->slug) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold">Deskripsi</label>
                    <textarea name="description" rows="5" class="w-full rounded-2xl border border-blue-100 px-4 py-3">{{ old('description', $category->description) }}</textarea>
                </div>
            </div>
        </div>
        <div class="flex gap-4"><button class="rounded-full bg-primary px-6 py-3 text-sm font-semibold text-white">Simpan</button></div>
    </form>
@endsection

