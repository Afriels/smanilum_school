@extends('admin.layouts.app')
@section('title', 'Kategori Berita')
@section('page_heading', 'Kategori Berita')
@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold">Kategori</h2>
        <a href="{{ route('admin.categories.create') }}" class="rounded-full bg-primary px-5 py-3 text-sm font-semibold text-white">Tambah Kategori</a>
    </div>
    <div class="overflow-hidden rounded-[1.75rem] border border-blue-100 bg-white/90 shadow-soft">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-surface-soft">
                <tr>
                    <th class="px-5 py-4">Nama</th>
                    <th class="px-5 py-4">Slug</th>
                    <th class="px-5 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr class="border-t border-blue-50">
                        <td class="px-5 py-4 font-semibold">{{ $category->name }}</td>
                        <td class="px-5 py-4">{{ $category->slug }}</td>
                        <td class="px-5 py-4">
                            <div class="flex gap-3">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="text-primary">Edit</a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf @method('DELETE')
                                    <button class="text-rose-600">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="border-t border-blue-50 px-5 py-4">{{ $categories->links() }}</div>
    </div>
@endsection

