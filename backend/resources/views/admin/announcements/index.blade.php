@extends('admin.layouts.app')
@section('title', 'Agenda & Pengumuman')
@section('page_heading', 'Agenda & Pengumuman')
@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold">Pengumuman</h2>
        <a href="{{ route('admin.announcements.create') }}" class="rounded-full bg-primary px-5 py-3 text-sm font-semibold text-white">Tambah Pengumuman</a>
    </div>
    <div class="overflow-hidden rounded-[1.75rem] border border-blue-100 bg-white/90 shadow-soft">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-surface-soft"><tr><th class="px-5 py-4">Judul</th><th class="px-5 py-4">Tanggal</th><th class="px-5 py-4">Status</th><th class="px-5 py-4">Aksi</th></tr></thead>
            <tbody>
            @foreach($announcements as $announcement)
                <tr class="border-t border-blue-50">
                    <td class="px-5 py-4 font-semibold">{{ $announcement->title }}</td>
                    <td class="px-5 py-4">{{ optional($announcement->event_date)->format('d M Y') }}</td>
                    <td class="px-5 py-4">{{ ucfirst($announcement->status) }}</td>
                    <td class="px-5 py-4"><div class="flex gap-3"><a href="{{ route('admin.announcements.edit', $announcement) }}" class="text-primary">Edit</a><form method="POST" action="{{ route('admin.announcements.destroy', $announcement) }}" onsubmit="return confirm('Hapus pengumuman ini?')">@csrf @method('DELETE')<button class="text-rose-600">Hapus</button></form></div></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="border-t border-blue-50 px-5 py-4">{{ $announcements->links() }}</div>
    </div>
@endsection

