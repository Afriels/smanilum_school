@extends('admin.layouts.app')
@section('title', 'Ekstrakurikuler')
@section('page_heading', 'Ekstrakurikuler')
@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold">Daftar Ekstrakurikuler</h2>
        <a href="{{ route('admin.extracurriculars.create') }}" class="rounded-full bg-primary px-5 py-3 text-sm font-semibold text-white">Tambah Ekskul</a>
    </div>
    <div class="grid gap-5 md:grid-cols-2">
        @foreach($extracurriculars as $extracurricular)
            <article class="rounded-[1.75rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
                <div class="font-bold">{{ $extracurricular->name }}</div>
                <div class="mt-2 text-sm leading-7 text-slate-600">{{ $extracurricular->summary }}</div>
                <div class="mt-4 flex gap-3">
                    <a href="{{ route('admin.extracurriculars.edit', $extracurricular) }}" class="text-primary">Edit</a>
                    <form method="POST" action="{{ route('admin.extracurriculars.destroy', $extracurricular) }}" onsubmit="return confirm('Hapus ekstrakurikuler ini?')">@csrf @method('DELETE')<button class="text-rose-600">Hapus</button></form>
                </div>
            </article>
        @endforeach
    </div>
    <div class="mt-6">{{ $extracurriculars->links() }}</div>
@endsection

