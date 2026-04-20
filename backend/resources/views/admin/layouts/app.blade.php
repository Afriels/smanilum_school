<!DOCTYPE html>
<html lang="id">
<head>
    @php
        $adminLogoUrl = \App\Support\MediaUrl::url($siteSettings['logo'] ?? null, 'images/logo-default.svg');
        $adminFaviconUrl = \App\Support\MediaUrl::url($siteSettings['favicon'] ?? null, 'images/favicon.ico');
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin')</title>
    <link rel="icon" href="{{ $adminFaviconUrl }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0f4fbf',
                        'primary-dark': '#0a387f',
                        ink: '#11233f',
                        'surface-soft': '#eef6ff'
                    },
                    boxShadow: {
                        soft: '0 20px 56px rgba(15, 79, 191, 0.12)'
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen bg-[radial-gradient(circle_at_top_left,rgba(15,79,191,.1),transparent_24%),linear-gradient(180deg,#f5fbff,#ffffff)] text-ink">
    <div class="flex min-h-screen">
        <aside class="hidden w-72 border-r border-blue-100 bg-white/90 p-6 backdrop-blur xl:block">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center overflow-hidden rounded-full bg-white ring-1 ring-blue-100">
                    <img src="{{ $adminLogoUrl }}" alt="Logo {{ $siteSettings['site_name'] ?? 'Website sekolah' }}" class="h-full w-full object-contain">
                </div>
                <div>
                    <div class="text-xs font-bold uppercase tracking-[0.2em] text-primary">Admin Panel</div>
                    <div class="text-lg font-bold">{{ $siteSettings['site_name'] ?? 'SMAN Ilum Modern' }}</div>
                </div>
            </a>
            <nav class="mt-8 grid gap-2 text-sm">
                <a href="{{ route('admin.dashboard') }}" class="rounded-2xl px-4 py-3 font-semibold hover:bg-blue-50">Dashboard</a>
                <a href="{{ route('admin.posts.index') }}" class="rounded-2xl px-4 py-3 font-semibold hover:bg-blue-50">Berita</a>
                <a href="{{ route('admin.categories.index') }}" class="rounded-2xl px-4 py-3 font-semibold hover:bg-blue-50">Kategori Berita</a>
                <a href="{{ route('admin.banners.index') }}" class="rounded-2xl px-4 py-3 font-semibold hover:bg-blue-50">Banner Slider</a>
                <a href="{{ route('admin.pages.index') }}" class="rounded-2xl px-4 py-3 font-semibold hover:bg-blue-50">Halaman Profil</a>
                <a href="{{ route('admin.extracurriculars.index') }}" class="rounded-2xl px-4 py-3 font-semibold hover:bg-blue-50">Ekstrakurikuler</a>
                <a href="{{ route('admin.announcements.index') }}" class="rounded-2xl px-4 py-3 font-semibold hover:bg-blue-50">Agenda & Pengumuman</a>
                <a href="{{ route('admin.galleries.index') }}" class="rounded-2xl px-4 py-3 font-semibold hover:bg-blue-50">Galeri</a>
                <a href="{{ route('admin.settings.edit') }}" class="rounded-2xl px-4 py-3 font-semibold hover:bg-blue-50">Pengaturan Website</a>
                @if (auth()->user()?->hasRole('super-admin'))
                    <a href="{{ route('admin.users.index') }}" class="rounded-2xl px-4 py-3 font-semibold hover:bg-blue-50">User Admin</a>
                @endif
            </nav>
        </aside>

        <div class="flex-1">
            <header class="border-b border-blue-100 bg-white/80 px-4 py-4 backdrop-blur md:px-8">
                <div class="mx-auto flex max-w-6xl items-center justify-between gap-4">
                    <div>
                        <div class="text-xs font-bold uppercase tracking-[0.25em] text-primary">Dashboard</div>
                        <h1 class="mt-1 text-2xl font-bold">@yield('page_heading', 'Panel Admin')</h1>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('public.home') }}" class="rounded-full border border-blue-100 px-4 py-2 text-sm font-semibold">Lihat Website</a>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button class="rounded-full bg-primary px-4 py-2 text-sm font-semibold text-white">Logout</button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="mx-auto max-w-6xl px-4 py-8 md:px-8">
                @include('partials.flash')
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
