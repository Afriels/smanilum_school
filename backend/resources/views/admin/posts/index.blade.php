@extends('admin.layouts.app')

@section('title', 'Kelola Berita')
@section('page_heading', 'Berita')

@section('content')
    <div class="mb-6 flex items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold">Daftar Berita</h2>
            <p class="mt-2 text-sm text-slate-600">Kelola postingan, featured slider, dan status publikasi.</p>
        </div>
        <a href="{{ route('admin.posts.create') }}" class="rounded-full bg-primary px-5 py-3 text-sm font-semibold text-white">Tambah Berita</a>
    </div>

    <div class="overflow-hidden rounded-[1.75rem] border border-blue-100 bg-white/90 shadow-soft">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-surface-soft text-slate-600">
                    <tr>
                        <th class="px-5 py-4">Judul</th>
                        <th class="px-5 py-4">Kategori</th>
                        <th class="px-5 py-4">Status</th>
                        <th class="px-5 py-4">Slider</th>
                        <th class="px-5 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr class="border-t border-blue-50">
                            <td class="px-5 py-4">
                                <div class="font-semibold">{{ $post->title }}</div>
                                <div class="mt-1 text-xs uppercase tracking-[0.2em] text-slate-500">{{ optional($post->published_at)->format('d M Y') }}</div>
                            </td>
                            <td class="px-5 py-4">{{ $post->categoryRecord?->name ?? '-' }}</td>
                            <td class="px-5 py-4">{{ ucfirst($post->status) }}</td>
                            <td class="px-5 py-4">{{ $post->show_in_slider ? 'Ya' : 'Tidak' }}</td>
                            <td class="px-5 py-4">
                                <div class="flex flex-wrap gap-3">
                                    <a href="{{ route('admin.posts.edit', $post) }}" class="text-primary">Edit</a>
                                    <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('Hapus berita ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-rose-600">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="border-t border-blue-50 px-5 py-4">{{ $posts->links() }}</div>
    </div>
@endsection

