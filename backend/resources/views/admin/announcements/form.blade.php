@extends('admin.layouts.app')
@section('title', $announcement->exists ? 'Edit Pengumuman' : 'Tambah Pengumuman')
@section('page_heading', $announcement->exists ? 'Edit Pengumuman' : 'Tambah Pengumuman')
@section('content')
    <form method="POST" action="{{ $announcement->exists ? route('admin.announcements.update', $announcement) : route('admin.announcements.store') }}" class="grid gap-6">
        @csrf @if($announcement->exists) @method('PUT') @endif
        <div class="rounded-[1.75rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
            <div class="grid gap-5">
                <div><label class="mb-2 block text-sm font-semibold">Judul</label><input type="text" name="title" value="{{ old('title', $announcement->title) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                <div><label class="mb-2 block text-sm font-semibold">Slug</label><input type="text" name="slug" value="{{ old('slug', $announcement->slug) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                <div><label class="mb-2 block text-sm font-semibold">Ringkasan</label><textarea name="excerpt" rows="3" class="w-full rounded-2xl border border-blue-100 px-4 py-3">{{ old('excerpt', $announcement->excerpt) }}</textarea></div>
                <div><label class="mb-2 block text-sm font-semibold">Konten</label><textarea name="content" rows="10" class="w-full rounded-2xl border border-blue-100 px-4 py-3">{{ old('content', $announcement->content) }}</textarea></div>
                <div class="grid gap-5 md:grid-cols-2">
                    <div><label class="mb-2 block text-sm font-semibold">Tanggal Agenda</label><input type="date" name="event_date" value="{{ old('event_date', optional($announcement->event_date)->format('Y-m-d')) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                    <div><label class="mb-2 block text-sm font-semibold">Status</label><select name="status" class="w-full rounded-2xl border border-blue-100 px-4 py-3">@foreach(['draft','published','archived'] as $status)<option value="{{ $status }}" @selected(old('status', $announcement->status) === $status)>{{ ucfirst($status) }}</option>@endforeach</select></div>
                </div>
                <label class="flex items-center gap-3 text-sm"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $announcement->is_featured))> Tandai sebagai pengumuman unggulan</label>
            </div>
        </div>
        <div class="flex gap-4"><button class="rounded-full bg-primary px-6 py-3 text-sm font-semibold text-white">Simpan</button></div>
    </form>
@endsection

