<!DOCTYPE html>
<html lang="id">
<head>
    @php
        $loginLogoUrl = !empty($siteSettings['logo']) ? asset('storage/'.$siteSettings['logo']) : asset('images/logo-default.svg');
        $loginFaviconUrl = !empty($siteSettings['favicon']) ? asset('storage/'.$siteSettings['favicon']) : asset('images/favicon.ico');
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | {{ $siteSettings['site_name'] ?? 'SMAN Ilum Modern' }}</title>
    <link rel="icon" href="{{ $loginFaviconUrl }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-[radial-gradient(circle_at_top_left,rgba(15,79,191,.12),transparent_26%),linear-gradient(180deg,#f5fbff,#ffffff)] text-slate-900">
    <div class="mx-auto grid min-h-screen w-full max-w-7xl gap-8 px-4 py-8 lg:grid-cols-[minmax(0,1.1fr)_420px] lg:items-center">
        <section class="rounded-[2rem] bg-gradient-to-br from-[#0a387f] via-[#0f4fbf] to-[#72a8ff] p-10 text-white shadow-2xl">
            <div class="flex h-20 w-20 items-center justify-center overflow-hidden rounded-[1.5rem] bg-white p-3">
                <img src="{{ $loginLogoUrl }}" alt="Logo {{ $siteSettings['site_name'] ?? 'Website sekolah' }}" class="h-full w-full object-contain">
            </div>
            <div class="inline-flex rounded-full bg-white/15 px-4 py-2 text-xs font-bold uppercase tracking-[0.28em]">Admin Portal</div>
            <h1 class="mt-6 max-w-2xl text-4xl font-bold leading-tight md:text-5xl">Kelola seluruh konten website sekolah dari dashboard yang aman.</h1>
            <p class="mt-5 max-w-2xl text-base leading-8 text-white/85">Login admin ini terhubung langsung ke session auth Laravel. Setelah berhasil masuk, seluruh menu admin dilindungi middleware auth dan role.</p>
            <div class="mt-8 grid gap-4">
                <div class="rounded-2xl bg-white/12 p-4 text-sm leading-7">
                    <div class="font-semibold">Akun default seeder</div>
                    <div class="mt-2">Email: <span class="font-semibold">superadmin@sekolah.test</span></div>
                    <div>Password: <span class="font-semibold">ChangeMe123!</span></div>
                </div>
            </div>
        </section>

        <section class="rounded-[2rem] border border-blue-100 bg-white/90 p-8 shadow-xl backdrop-blur">
            <div class="inline-flex rounded-full bg-blue-50 px-4 py-2 text-xs font-bold uppercase tracking-[0.24em] text-blue-700">Masuk Admin</div>
            <h2 class="mt-5 text-3xl font-bold">Login</h2>
            <p class="mt-3 text-sm leading-7 text-slate-600">Masukkan email dan password admin untuk mengakses dashboard.</p>

            @include('partials.flash')

            <form method="POST" action="{{ route('admin.login.store') }}" class="mt-6 grid gap-5">
                @csrf
                <div>
                    <label class="mb-2 block text-sm font-semibold">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-2xl border border-blue-100 px-4 py-3 outline-none ring-primary/20 focus:ring-4">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-semibold">Password</label>
                    <input type="password" name="password" required class="w-full rounded-2xl border border-blue-100 px-4 py-3 outline-none ring-primary/20 focus:ring-4">
                </div>
                <label class="flex items-center gap-3 text-sm text-slate-600">
                    <input type="checkbox" name="remember" value="1" class="rounded border-blue-200">
                    Ingat saya
                </label>
                <button class="rounded-full bg-primary px-5 py-3 text-sm font-semibold text-white">Masuk ke Dashboard</button>
            </form>
        </section>
    </div>
</body>
</html>
