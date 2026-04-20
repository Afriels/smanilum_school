@extends('admin.layouts.app')

@section('title', $post->exists ? 'Edit Berita' : 'Tambah Berita')
@section('page_heading', $post->exists ? 'Edit Berita' : 'Tambah Berita')

@section('content')
    <form method="POST" action="{{ $post->exists ? route('admin.posts.update', $post) : route('admin.posts.store') }}" enctype="multipart/form-data" class="grid gap-6">
        @csrf
        @if($post->exists) @method('PUT') @endif

        <div class="rounded-[1.75rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
            <div class="grid gap-5 md:grid-cols-2">
                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-semibold">Judul</label>
                    <input type="text" name="title" value="{{ old('title', $post->title) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold">Slug</label>
                    <input type="text" name="slug" value="{{ old('slug', $post->slug) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold">Kategori</label>
                    <select name="post_category_id" class="w-full rounded-2xl border border-blue-100 px-4 py-3">
                        <option value="">Pilih kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('post_category_id', $post->post_category_id) == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-semibold">Ringkasan</label>
                    <textarea name="excerpt" rows="3" class="w-full rounded-2xl border border-blue-100 px-4 py-3">{{ old('excerpt', $post->excerpt) }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-semibold">Konten</label>
                    <textarea name="content" rows="12" class="w-full rounded-2xl border border-blue-100 px-4 py-3">{{ old('content', $post->content) }}</textarea>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold">Status</label>
                    <select name="status" class="w-full rounded-2xl border border-blue-100 px-4 py-3">
                        @foreach (['draft', 'published', 'archived'] as $status)
                            <option value="{{ $status }}" @selected(old('status', $post->status) === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold">Tanggal Publish</label>
                    <input type="datetime-local" name="published_at" value="{{ old('published_at', $post->published_at?->format('Y-m-d\TH:i')) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold">Thumbnail / Gambar</label>
                    <input type="file" name="featured_image" accept=".jpg,.jpeg,.png,.webp" class="w-full rounded-2xl border border-blue-100 px-4 py-3">
                    <p class="mt-2 text-xs leading-6 text-slate-500">Format: jpg, jpeg, png, webp. Maksimal 5MB.</p>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold">Preview Thumbnail</label>
                    <div class="overflow-hidden rounded-[1.25rem] border border-blue-100 bg-surface-soft">
                        <img
                            src="{{ \App\Support\MediaUrl::url($post->featured_image_path, 'images/default.jpg') }}"
                            alt="Preview thumbnail berita"
                            class="h-44 w-full object-cover"
                            onerror="this.onerror=null;this.src='{{ \App\Support\MediaUrl::url(null, 'images/default.jpg') }}';"
                        >
                    </div>
                </div>
                <div class="grid gap-3">
                    <label class="flex items-center gap-3 text-sm"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $post->is_featured))> Featured post</label>
                    <label class="flex items-center gap-3 text-sm"><input type="checkbox" name="show_in_slider" value="1" @checked(old('show_in_slider', $post->show_in_slider))> Tampilkan di slider beranda</label>
                </div>
                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-semibold">SEO Title</label>
                    <input type="text" name="seo_title" value="{{ old('seo_title', $post->seo_title) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3">
                </div>
                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-semibold">SEO Description</label>
                    <textarea name="seo_description" rows="3" class="w-full rounded-2xl border border-blue-100 px-4 py-3">{{ old('seo_description', $post->seo_description) }}</textarea>
                </div>
            </div>
        </div>
        <div class="flex gap-4">
            <button class="rounded-full bg-primary px-6 py-3 text-sm font-semibold text-white">Simpan</button>
            <a href="{{ route('admin.posts.index') }}" class="rounded-full border border-blue-100 px-6 py-3 text-sm font-semibold">Batal</a>
        </div>
    </form>
@endsection
