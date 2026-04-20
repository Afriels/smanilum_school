@extends('admin.layouts.app')
@section('title', 'Halaman Profil')
@section('page_heading', 'Halaman Profil')
@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold">Halaman Statis</h2>
        <a href="{{ route('admin.pages.create') }}" class="rounded-full bg-primary px-5 py-3 text-sm font-semibold text-white">Tambah Halaman</a>
    </div>
    <div class="overflow-hidden rounded-[1.75rem] border border-blue-100 bg-white/90 shadow-soft">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-surface-soft"><tr><th class="px-5 py-4">Judul</th><th class="px-5 py-4">Slug</th><th class="px-5 py-4">Status</th><th class="px-5 py-4">Aksi</th></tr></thead>
            <tbody>
            @foreach($pages as $page)
                <tr class="border-t border-blue-50">
                    <td class="px-5 py-4 font-semibold">{{ $page->title }}</td>
                    <td class="px-5 py-4">{{ $page->slug }}</td>
                    <td class="px-5 py-4">{{ ucfirst($page->status) }}</td>
                    <td class="px-5 py-4"><div class="flex gap-3"><a href="{{ route('admin.pages.edit', $page) }}" class="text-primary">Edit</a><form method="POST" action="{{ route('admin.pages.destroy', $page) }}" onsubmit="return confirm('Hapus halaman ini?')">@csrf @method('DELETE')<button class="text-rose-600">Hapus</button></form></div></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="border-t border-blue-50 px-5 py-4">{{ $pages->links() }}</div>
    </div>
@endsection

