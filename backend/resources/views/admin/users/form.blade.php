@extends('admin.layouts.app')
@section('title', $user->exists ? 'Edit User' : 'Tambah User')
@section('page_heading', $user->exists ? 'Edit User' : 'Tambah User')
@section('content')
    <form method="POST" action="{{ $user->exists ? route('admin.users.update', $user) : route('admin.users.store') }}" class="grid gap-6">
        @csrf @if($user->exists) @method('PUT') @endif
        <div class="rounded-[1.75rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
            <div class="grid gap-5 md:grid-cols-2">
                <div><label class="mb-2 block text-sm font-semibold">Nama</label><input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                <div><label class="mb-2 block text-sm font-semibold">Email</label><input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                <div><label class="mb-2 block text-sm font-semibold">Role</label><select name="role_id" class="w-full rounded-2xl border border-blue-100 px-4 py-3">@foreach($roles as $role)<option value="{{ $role->id }}" @selected(old('role_id', $user->role_id) == $role->id)>{{ $role->name }}</option>@endforeach</select></div>
                <div><label class="mb-2 block text-sm font-semibold">Password {{ $user->exists ? '(kosongkan jika tidak diubah)' : '' }}</label><input type="password" name="password" class="w-full rounded-2xl border border-blue-100 px-4 py-3"></div>
                <div class="flex items-center gap-3 pt-8"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $user->is_active))><span class="text-sm">Aktif</span></div>
            </div>
        </div>
        <div class="flex gap-4"><button class="rounded-full bg-primary px-6 py-3 text-sm font-semibold text-white">Simpan</button></div>
    </form>
@endsection

