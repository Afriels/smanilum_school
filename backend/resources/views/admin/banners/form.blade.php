@extends('admin.layouts.app')
@section('title', $banner->exists ? 'Edit Banner' : 'Tambah Banner')
@section('page_heading', $banner->exists ? 'Edit Banner' : 'Tambah Banner')
@section('content')
    <form method="POST" enctype="multipart/form-data" action="{{ $banner->exists ? route('admin.banners.update', $banner) : route('admin.banners.store') }}" class="grid gap-6">
        @csrf @if($banner->exists) @method('PUT') @endif
        <div class="rounded-[1.75rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
            <div class="grid gap-5 md:grid-cols-2">
                <div class="md:col-span-2"><label class="mb-2 block text-sm font-semibold">Judul</label><input type="text" name="title" value="{{ old('title', $banner->title) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                <div><label class="mb-2 block text-sm font-semibold">Slug</label><input type="text" name="slug" value="{{ old('slug', $banner->slug) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                <div><label class="mb-2 block text-sm font-semibold">Subtitle</label><input type="text" name="subtitle" value="{{ old('subtitle', $banner->subtitle) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                <div class="md:col-span-2"><label class="mb-2 block text-sm font-semibold">Deskripsi</label><textarea name="description" rows="5" class="w-full rounded-2xl border border-blue-100 px-4 py-3">{{ old('description', $banner->description) }}</textarea></div>
                <div><label class="mb-2 block text-sm font-semibold">CTA Utama</label><input type="text" name="primary_cta_label" value="{{ old('primary_cta_label', $banner->primary_cta_label) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                <div><label class="mb-2 block text-sm font-semibold">URL CTA Utama</label><input type="text" name="primary_cta_url" value="{{ old('primary_cta_url', $banner->primary_cta_url) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                <div><label class="mb-2 block text-sm font-semibold">CTA Kedua</label><input type="text" name="secondary_cta_label" value="{{ old('secondary_cta_label', $banner->secondary_cta_label) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                <div><label class="mb-2 block text-sm font-semibold">URL CTA Kedua</label><input type="text" name="secondary_cta_url" value="{{ old('secondary_cta_url', $banner->secondary_cta_url) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                <div><label class="mb-2 block text-sm font-semibold">Status</label><select name="status" class="w-full rounded-2xl border border-blue-100 px-4 py-3">@foreach(['draft','published','archived'] as $status)<option value="{{ $status }}" @selected(old('status', $banner->status) === $status)>{{ ucfirst($status) }}</option>@endforeach</select></div>
                <div><label class="mb-2 block text-sm font-semibold">Urutan</label><input type="number" name="sort_order" value="{{ old('sort_order', $banner->sort_order ?? 0) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                <div><label class="mb-2 block text-sm font-semibold">Gambar Banner</label><input type="file" name="image" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                <div class="flex items-center gap-3 pt-8"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $banner->is_active))><span class="text-sm">Aktif</span></div>
            </div>
        </div>
        <div class="flex gap-4"><button class="rounded-full bg-primary px-6 py-3 text-sm font-semibold text-white">Simpan</button></div>
    </form>
@endsection

