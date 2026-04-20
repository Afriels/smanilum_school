@extends('admin.layouts.app')
@section('title', 'Pengaturan Website')
@section('page_heading', 'Pengaturan Website')

@php
    $currentLogo = $settings['logo']->value ?? null;
    $currentFavicon = $settings['favicon']->value ?? null;
    $logoUrl = $currentLogo ? asset('storage/'.$currentLogo) : asset('images/logo-default.svg');
    $faviconUrl = $currentFavicon ? asset('storage/'.$currentFavicon) : asset('images/favicon.ico');
@endphp

@section('content')
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="grid gap-6">
        @csrf
        @method('PUT')

        <div class="grid gap-6 xl:grid-cols-[minmax(0,1.2fr)_380px]">
            <div class="rounded-[1.75rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
                <h2 class="text-2xl font-bold">Identitas Sekolah</h2>
                <p class="mt-2 text-sm leading-7 text-slate-600">Kelola nama website, informasi sekolah, statistik singkat, dan identitas visual dari satu halaman.</p>

                <div class="mt-6 grid gap-5 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Nama Situs</label>
                        <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name']->value ?? '') }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Tagline</label>
                        <input type="text" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline']->value ?? '') }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3">
                    </div>
                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-semibold">Deskripsi Situs</label>
                        <textarea name="site_description" rows="4" class="w-full rounded-2xl border border-blue-100 px-4 py-3">{{ old('site_description', $settings['site_description']->value ?? '') }}</textarea>
                    </div>
                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-semibold">Default OG Image Path</label>
                        <input type="text" name="default_og_image" value="{{ old('default_og_image', $settings['default_og_image']->value ?? 'images/default.jpg') }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3">
                    </div>
                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-semibold">Alamat</label>
                        <textarea name="address" rows="3" class="w-full rounded-2xl border border-blue-100 px-4 py-3">{{ old('address', $settings['address']->value ?? '') }}</textarea>
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Telepon</label>
                        <input type="text" name="phone" value="{{ old('phone', $settings['phone']->value ?? '') }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Email</label>
                        <input type="email" name="email" value="{{ old('email', $settings['email']->value ?? '') }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Facebook URL</label>
                        <input type="text" name="facebook_url" value="{{ old('facebook_url', $settings['facebook_url']->value ?? '') }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Instagram URL</label>
                        <input type="text" name="instagram_url" value="{{ old('instagram_url', $settings['instagram_url']->value ?? '') }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold">YouTube URL</label>
                        <input type="text" name="youtube_url" value="{{ old('youtube_url', $settings['youtube_url']->value ?? '') }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Map Embed URL</label>
                        <input type="text" name="map_embed_url" value="{{ old('map_embed_url', $settings['map_embed_url']->value ?? '') }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Jumlah Siswa</label>
                        <input type="text" name="student_count" value="{{ old('student_count', $settings['student_count']->value ?? '') }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Jumlah Guru</label>
                        <input type="text" name="teacher_count" value="{{ old('teacher_count', $settings['teacher_count']->value ?? '') }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Jumlah Ekskul</label>
                        <input type="text" name="extracurricular_count" value="{{ old('extracurricular_count', $settings['extracurricular_count']->value ?? '') }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3">
                    </div>
                    <div>
                        <label class="mb-2 block text-sm font-semibold">Tingkat Kelulusan</label>
                        <input type="text" name="graduation_rate" value="{{ old('graduation_rate', $settings['graduation_rate']->value ?? '') }}" class="w-full rounded-2xl border border-blue-100 px-4 py-3">
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-[1.75rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
                    <h2 class="text-xl font-bold">Logo Website</h2>
                    <p class="mt-2 text-sm leading-7 text-slate-600">Upload logo sekolah dalam format `jpg`, `jpeg`, `png`, atau `svg` dengan ukuran maksimal 2MB. Rekomendasi ukuran `300x100px`.</p>

                    <div class="mt-5 rounded-[1.5rem] border border-dashed border-blue-200 bg-surface-soft p-6">
                        <div class="flex min-h-[120px] items-center justify-center rounded-[1.25rem] bg-white p-4">
                            <img src="{{ $logoUrl }}" alt="Preview logo website" class="max-h-20 w-auto max-w-full object-contain">
                        </div>
                        <div class="mt-4">
                            <label class="mb-2 block text-sm font-semibold">Upload Logo Website</label>
                            <input type="file" name="logo" accept=".jpg,.jpeg,.png,.svg" class="block w-full rounded-2xl border border-blue-100 bg-white px-4 py-3 text-sm">
                        </div>
                        @if ($currentLogo)
                            <label class="mt-4 flex items-center gap-3 text-sm text-slate-600">
                                <input type="checkbox" name="remove_logo" value="1" class="rounded border-blue-200">
                                Hapus logo saat ini dan gunakan logo default
                            </label>
                        @endif
                    </div>
                </div>

                <div class="rounded-[1.75rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
                    <h2 class="text-xl font-bold">Favicon Website</h2>
                    <p class="mt-2 text-sm leading-7 text-slate-600">Upload favicon dalam format `png` atau `ico` dengan ukuran maksimal 1MB. Rekomendasi ukuran `32x32px`.</p>

                    <div class="mt-5 rounded-[1.5rem] border border-dashed border-blue-200 bg-surface-soft p-6">
                        <div class="flex min-h-[120px] items-center justify-center rounded-[1.25rem] bg-white p-4">
                            <img src="{{ $faviconUrl }}" alt="Preview favicon website" class="h-14 w-14 rounded-xl object-contain ring-1 ring-blue-100">
                        </div>
                        <div class="mt-4">
                            <label class="mb-2 block text-sm font-semibold">Upload Favicon Website</label>
                            <input type="file" name="favicon" accept=".png,.ico" class="block w-full rounded-2xl border border-blue-100 bg-white px-4 py-3 text-sm">
                        </div>
                        @if ($currentFavicon)
                            <label class="mt-4 flex items-center gap-3 text-sm text-slate-600">
                                <input type="checkbox" name="remove_favicon" value="1" class="rounded border-blue-200">
                                Hapus favicon saat ini dan gunakan favicon default
                            </label>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="flex gap-4">
            <button class="rounded-full bg-primary px-6 py-3 text-sm font-semibold text-white">Simpan Pengaturan</button>
        </div>
    </form>
@endsection
