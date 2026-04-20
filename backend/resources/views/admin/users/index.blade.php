@extends('admin.layouts.app')
@section('title', 'User Admin')
@section('page_heading', 'User Admin')
@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold">Manajemen User</h2>
        <a href="{{ route('admin.users.create') }}" class="rounded-full bg-primary px-5 py-3 text-sm font-semibold text-white">Tambah User</a>
    </div>
    <div class="overflow-hidden rounded-[1.75rem] border border-blue-100 bg-white/90 shadow-soft">
        <table class="min-w-full text-left text-sm">
            <thead class="bg-surface-soft"><tr><th class="px-5 py-4">Nama</th><th class="px-5 py-4">Email</th><th class="px-5 py-4">Role</th><th class="px-5 py-4">Status</th><th class="px-5 py-4">Aksi</th></tr></thead>
            <tbody>
            @foreach($users as $user)
                <tr class="border-t border-blue-50">
                    <td class="px-5 py-4 font-semibold">{{ $user->name }}</td>
                    <td class="px-5 py-4">{{ $user->email }}</td>
                    <td class="px-5 py-4">{{ $user->role?->name }}</td>
                    <td class="px-5 py-4">{{ $user->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                    <td class="px-5 py-4"><div class="flex gap-3"><a href="{{ route('admin.users.edit', $user) }}" class="text-primary">Edit</a><form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Hapus user ini?')">@csrf @method('DELETE')<button class="text-rose-600">Hapus</button></form></div></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="border-t border-blue-50 px-5 py-4">{{ $users->links() }}</div>
    </div>
@endsection

