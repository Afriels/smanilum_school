@extends('admin.layouts.app')
@section('title', $gallery->exists ? 'Edit Galeri' : 'Tambah Galeri')
@section('page_heading', $gallery->exists ? 'Edit Galeri' : 'Tambah Galeri')
@section('content')
    <form method="POST" enctype="multipart/form-data" action="{{ $gallery->exists ? route('admin.galleries.update', $gallery) : route('admin.galleries.store') }}" class="grid gap-6">
        @csrf @if($gallery->exists) @method('PUT') @endif
        <div class="rounded-[1.75rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
            <div class="grid gap-5">
                <div><label class="mb-2 block text-sm font-semibold">Judul Album</label><input type="text" name="title" value="{{ old('title', $gallery->title) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                <div><label class="mb-2 block text-sm font-semibold">Slug</label><input type="text" name="slug" value="{{ old('slug', $gallery->slug) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                <div><label class="mb-2 block text-sm font-semibold">Deskripsi</label><textarea name="description" rows="5" class="w-full rounded-2xl border border-blue-100 px-4 py-3">{{ old('description', $gallery->description) }}</textarea></div>
                <div class="grid gap-5 md:grid-cols-2">
                    <div><label class="mb-2 block text-sm font-semibold">Tipe</label><select name="type" class="w-full rounded-2xl border border-blue-100 px-4 py-3">@foreach(['photo','video'] as $type)<option value="{{ $type }}" @selected(old('type', $gallery->type) === $type)>{{ ucfirst($type) }}</option>@endforeach</select></div>
                    <div><label class="mb-2 block text-sm font-semibold">Status</label><select name="status" class="w-full rounded-2xl border border-blue-100 px-4 py-3">@foreach(['draft','published','archived'] as $status)<option value="{{ $status }}" @selected(old('status', $gallery->status) === $status)>{{ ucfirst($status) }}</option>@endforeach</select></div>
                </div>
                <div class="grid gap-5 md:grid-cols-2">
                    <div><label class="mb-2 block text-sm font-semibold">Cover Album</label><input type="file" name="cover_image" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                    <div><label class="mb-2 block text-sm font-semibold">Upload Foto Galeri</label><input type="file" name="gallery_images[]" multiple class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                </div>
                <label class="flex items-center gap-3 text-sm"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $gallery->is_featured))> Tandai sebagai galeri unggulan</label>
                @if($gallery->exists && $gallery->items->count())
                    <div>
                        <div class="mb-3 text-sm font-semibold">Item Saat Ini</div>
                        <div class="grid gap-4 md:grid-cols-3">
                            @foreach($gallery->items as $item)
                                <div class="overflow-hidden rounded-2xl border border-blue-100">
                                    @if($item->file_path)
                                        <img src="{{ asset('storage/'.$item->file_path) }}" alt="{{ $item->title }}" class="h-32 w-full object-cover">
                                    @else
                                        <div class="h-32 w-full bg-gradient-to-br from-blue-100 via-blue-200 to-blue-500"></div>
                                    @endif
                                    <div class="p-3 text-xs font-semibold">{{ $item->title }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="flex gap-4"><button class="rounded-full bg-primary px-6 py-3 text-sm font-semibold text-white">Simpan</button></div>
    </form>
@endsection
