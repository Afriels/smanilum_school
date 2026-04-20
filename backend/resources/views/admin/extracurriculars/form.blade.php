@extends('admin.layouts.app')
@section('title', $extracurricular->exists ? 'Edit Ekstrakurikuler' : 'Tambah Ekstrakurikuler')
@section('page_heading', $extracurricular->exists ? 'Edit Ekstrakurikuler' : 'Tambah Ekstrakurikuler')
@section('content')
    <form method="POST" enctype="multipart/form-data" action="{{ $extracurricular->exists ? route('admin.extracurriculars.update', $extracurricular) : route('admin.extracurriculars.store') }}" class="grid gap-6">
        @csrf @if($extracurricular->exists) @method('PUT') @endif
        <div class="rounded-[1.75rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
            <div class="grid gap-5">
                <div><label class="mb-2 block text-sm font-semibold">Nama</label><input type="text" name="name" value="{{ old('name', $extracurricular->name) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                <div><label class="mb-2 block text-sm font-semibold">Slug</label><input type="text" name="slug" value="{{ old('slug', $extracurricular->slug) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                <div><label class="mb-2 block text-sm font-semibold">Ringkasan</label><textarea name="summary" rows="3" class="w-full rounded-2xl border border-blue-100 px-4 py-3">{{ old('summary', $extracurricular->summary) }}</textarea></div>
                <div><label class="mb-2 block text-sm font-semibold">Deskripsi</label><textarea name="description" rows="10" class="w-full rounded-2xl border border-blue-100 px-4 py-3">{{ old('description', $extracurricular->description) }}</textarea></div>
                <div class="grid gap-5 md:grid-cols-2">
                    <div><label class="mb-2 block text-sm font-semibold">Status</label><select name="status" class="w-full rounded-2xl border border-blue-100 px-4 py-3">@foreach(['draft','published','archived'] as $status)<option value="{{ $status }}" @selected(old('status', $extracurricular->status) === $status)>{{ ucfirst($status) }}</option>@endforeach</select></div>
                    <div><label class="mb-2 block text-sm font-semibold">Gambar</label><input type="file" name="featured_image" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                </div>
                <label class="flex items-center gap-3 text-sm"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $extracurricular->is_featured))> Tampilkan sebagai unggulan</label>
            </div>
        </div>
        <div class="flex gap-4"><button class="rounded-full bg-primary px-6 py-3 text-sm font-semibold text-white">Simpan</button></div>
    </form>
@endsection

