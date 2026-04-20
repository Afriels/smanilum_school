@extends('public.layouts.app')

@section('title', 'Kontak | '.($siteSettings['site_name'] ?? 'SMAN Ilum Modern'))

@section('content')
    <section class="pt-10">
        <div class="mx-auto w-full max-w-7xl px-4">
            <div class="rounded-[2rem] border border-blue-100 bg-white/90 p-8 shadow-soft md:p-12">
                <div class="text-xs font-bold uppercase tracking-[0.25em] text-primary">Kontak Sekolah</div>
                <h1 class="mt-4 text-4xl font-bold md:text-5xl">Hubungi kami untuk informasi lebih lanjut</h1>
                <p class="mt-5 max-w-3xl text-lg leading-8 text-slate-600">{{ $page->excerpt ?? 'Silakan gunakan formulir kontak berikut untuk menyampaikan pertanyaan atau kebutuhan informasi.' }}</p>
            </div>
        </div>
    </section>
    <section class="pt-8">
        <div class="mx-auto grid w-full max-w-7xl gap-6 px-4 lg:grid-cols-[360px_minmax(0,1fr)]">
            <aside class="rounded-[1.75rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
                <h2 class="text-2xl font-bold">Informasi Kontak</h2>
                <div class="mt-5 space-y-4 text-sm leading-7 text-slate-600">
                    <p>{{ $settings['address'] ?? '-' }}</p>
                    <p>{{ $settings['phone'] ?? '-' }}</p>
                    <p>{{ $settings['email'] ?? '-' }}</p>
                    <p>Senin - Jumat, 07.00 - 15.30 WIB</p>
                </div>
            </aside>
            <div class="grid gap-6">
                <div class="rounded-[1.75rem] border border-blue-100 bg-white/90 p-6 shadow-soft">
                    @include('partials.flash')
                    <form method="POST" action="{{ route('public.contact.store') }}" class="grid gap-4 md:grid-cols-2">
                        @csrf
                        <input type="text" name="name" placeholder="Nama lengkap" value="{{ old('name') }}" class="rounded-2xl border border-blue-100 px-4 py-3">
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="rounded-2xl border border-blue-100 px-4 py-3">
                        <input type="text" name="subject" placeholder="Subjek" value="{{ old('subject') }}" class="rounded-2xl border border-blue-100 px-4 py-3 md:col-span-2">
                        <textarea name="message" placeholder="Pesan" rows="6" class="rounded-2xl border border-blue-100 px-4 py-3 md:col-span-2">{{ old('message') }}</textarea>
                        <input type="text" name="company" tabindex="-1" autocomplete="off" class="hidden">
                        <button class="rounded-full bg-primary px-6 py-3 text-sm font-semibold text-white md:col-span-2">Kirim Pesan</button>
                    </form>
                </div>
                <div class="overflow-hidden rounded-[1.75rem] border border-blue-100 bg-white/90 shadow-soft">
                    <iframe src="{{ $settings['map_embed_url'] ?? 'https://www.google.com/maps?q=Jakarta&output=embed' }}" title="Peta lokasi sekolah" class="h-[360px] w-full border-0"></iframe>
                </div>
            </div>
        </div>
    </section>
@endsection

