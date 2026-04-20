<!DOCTYPE html>
<html lang="id">
<head>
    @php
        $publicLogoUrl = \App\Support\MediaUrl::url($siteSettings['logo'] ?? null, 'images/logo-default.svg');
        $publicFaviconUrl = \App\Support\MediaUrl::url($siteSettings['favicon'] ?? null, 'images/favicon.ico');
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $seo['title'] ?? ($siteSettings['site_name'] ?? 'SMAN Ilum Modern') }}</title>
    <meta name="description" content="{{ $seo['description'] ?? ($siteSettings['site_description'] ?? 'Website sekolah modern dan profesional.') }}">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="{{ $seo['url'] ?? url()->current() }}">
    <link rel="icon" href="{{ $publicFaviconUrl }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ $publicFaviconUrl }}" type="image/x-icon">

    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="{{ $seo['site_name'] ?? ($siteSettings['site_name'] ?? 'SMAN Ilum Modern') }}">
    <meta property="og:title" content="{{ $seo['title'] ?? ($siteSettings['site_name'] ?? 'SMAN Ilum Modern') }}">
    <meta property="og:description" content="{{ $seo['description'] ?? ($siteSettings['site_description'] ?? 'Website sekolah modern dan profesional.') }}">
    <meta property="og:image" content="{{ $seo['image'] ?? url('images/default.jpg') }}">
    <meta property="og:image:secure_url" content="{{ $seo['image'] ?? url('images/default.jpg') }}">
    <meta property="og:image:width" content="{{ $seo['image_width'] ?? 1200 }}">
    <meta property="og:image:height" content="{{ $seo['image_height'] ?? 630 }}">
    <meta property="og:url" content="{{ $seo['url'] ?? url()->current() }}">
    <meta property="og:type" content="{{ $seo['type'] ?? 'website' }}">

    <meta name="twitter:card" content="{{ $seo['twitter_card'] ?? 'summary_large_image' }}">
    <meta name="twitter:title" content="{{ $seo['title'] ?? ($siteSettings['site_name'] ?? 'SMAN Ilum Modern') }}">
    <meta name="twitter:description" content="{{ $seo['description'] ?? ($siteSettings['site_description'] ?? 'Website sekolah modern dan profesional.') }}">
    <meta name="twitter:image" content="{{ $seo['image'] ?? url('images/default.jpg') }}">

    @if (!empty($seo['published_time']))
        <meta property="article:published_time" content="{{ $seo['published_time'] }}">
    @endif
    @yield('head')
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0f4fbf',
                        'primary-dark': '#0a387f',
                        'surface-soft': '#eef6ff',
                        ink: '#11233f'
                    },
                    boxShadow: {
                        soft: '0 24px 64px rgba(15, 79, 191, 0.12)'
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-[radial-gradient(circle_at_top_left,rgba(15,79,191,.12),transparent_24%),linear-gradient(180deg,#f5fbff,#ffffff)] text-ink">
    <div class="border-b border-blue-100 bg-white/70 backdrop-blur">
        <div class="mx-auto flex w-full max-w-7xl flex-wrap items-center justify-between gap-3 px-4 py-2 text-sm text-slate-600">
            <div class="flex flex-wrap items-center gap-4">
                <span>{{ $siteSettings['address'] ?? 'Alamat sekolah belum diatur' }}</span>
                <span>{{ $siteSettings['phone'] ?? '-' }}</span>
            </div>
            <div class="flex items-center gap-3">
                @foreach ($headerAnnouncements as $announcement)
                    <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-primary">
                        {{ $announcement->title }}
                    </span>
                @endforeach
            </div>
        </div>
    </div>

    <header class="sticky top-0 z-40 border-b border-blue-100 bg-white/85 backdrop-blur">
        <div class="mx-auto flex w-full max-w-7xl items-center justify-between gap-6 px-4 py-4">
            <a href="{{ route('public.home') }}" class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center overflow-hidden rounded-full bg-white ring-1 ring-blue-100">
                    <img src="{{ $publicLogoUrl }}" alt="Logo {{ $siteSettings['site_name'] ?? 'Website sekolah' }}" class="h-full w-full object-contain">
                </div>
                <div>
                    <div class="text-xs font-bold uppercase tracking-[0.25em] text-primary">Website Profil</div>
                    <div class="text-lg font-bold">{{ $siteSettings['site_name'] ?? 'SMAN Ilum Modern' }}</div>
                </div>
            </a>
            <nav class="hidden items-center gap-2 lg:flex">
                <a href="{{ route('public.home') }}" class="rounded-full px-4 py-2 text-sm font-semibold hover:bg-blue-50">Beranda</a>
                <a href="{{ route('public.profile') }}" class="rounded-full px-4 py-2 text-sm font-semibold hover:bg-blue-50">Profil</a>
                <a href="{{ route('public.academic') }}" class="rounded-full px-4 py-2 text-sm font-semibold hover:bg-blue-50">Akademik</a>
                <a href="{{ route('public.extracurriculars.index') }}" class="rounded-full px-4 py-2 text-sm font-semibold hover:bg-blue-50">Ekstrakurikuler</a>
                <a href="{{ route('public.posts.index') }}" class="rounded-full px-4 py-2 text-sm font-semibold hover:bg-blue-50">Berita</a>
                <a href="{{ route('public.galleries.index') }}" class="rounded-full px-4 py-2 text-sm font-semibold hover:bg-blue-50">Galeri</a>
                <a href="{{ route('public.contact') }}" class="rounded-full px-4 py-2 text-sm font-semibold hover:bg-blue-50">Kontak</a>
            </nav>
            <a href="{{ route('admin.login') }}" class="rounded-full bg-primary px-5 py-2.5 text-sm font-semibold text-white">Admin Login</a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="mt-16 border-t border-blue-100 bg-white/80">
        <div class="mx-auto grid w-full max-w-7xl gap-10 px-4 py-12 md:grid-cols-2 xl:grid-cols-4">
            <div>
                <div class="text-xs font-bold uppercase tracking-[0.25em] text-primary">Sekolah Modern</div>
                <div class="mt-3 flex items-center gap-3">
                    <div class="flex h-12 w-12 items-center justify-center overflow-hidden rounded-full bg-white ring-1 ring-blue-100">
                        <img src="{{ $publicLogoUrl }}" alt="Logo {{ $siteSettings['site_name'] ?? 'Website sekolah' }}" class="h-full w-full object-contain">
                    </div>
                    <h3 class="text-2xl font-bold">{{ $siteSettings['site_name'] ?? 'SMAN Ilum Modern' }}</h3>
                </div>
                <p class="mt-4 text-sm leading-7 text-slate-600">{{ $siteSettings['site_description'] ?? 'Website sekolah profesional yang mudah dikelola.' }}</p>
            </div>
            <div>
                <h3 class="text-lg font-bold">Kontak</h3>
                <div class="mt-4 space-y-3 text-sm leading-7 text-slate-600">
                    <p>{{ $siteSettings['address'] ?? '-' }}</p>
                    <p>{{ $siteSettings['phone'] ?? '-' }}</p>
                    <p>{{ $siteSettings['email'] ?? '-' }}</p>
                </div>
            </div>
            <div>
                <h3 class="text-lg font-bold">Navigasi Cepat</h3>
                <div class="mt-4 grid gap-3 text-sm text-slate-600">
                    <a href="{{ route('public.posts.index') }}">Berita & Pengumuman</a>
                    <a href="{{ route('public.galleries.index') }}">Galeri</a>
                    <a href="{{ route('public.extracurriculars.index') }}">Ekstrakurikuler</a>
                    <a href="{{ route('public.contact') }}">Hubungi Sekolah</a>
                </div>
            </div>
            <div>
                <h3 class="text-lg font-bold">Media Sosial</h3>
                <div class="mt-4 grid gap-3 text-sm text-slate-600">
                    <a href="{{ $siteSettings['facebook_url'] ?? '#' }}">Facebook</a>
                    <a href="{{ $siteSettings['instagram_url'] ?? '#' }}">Instagram</a>
                    <a href="{{ $siteSettings['youtube_url'] ?? '#' }}">YouTube</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
