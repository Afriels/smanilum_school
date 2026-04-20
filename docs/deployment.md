# Deployment Strategy

## Arsitektur yang Disarankan

- `frontend/` di-deploy ke Vercel sebagai project Next.js
- `backend/` di-deploy ke hosting PHP terpisah
- Frontend membaca URL backend dari environment variable

Pendekatan ini paling realistis untuk repo ini karena frontend sangat cocok untuk Vercel, sedangkan backend Laravel membutuhkan runtime PHP, writable storage, dan konfigurasi server yang lebih sesuai di luar Vercel standar.

## Lokal dengan XAMPP

- MySQL dari XAMPP
- Apache dari XAMPP
- Laravel di `backend/public`
- Frontend Next.js opsional berjalan di `localhost:3000`

Jalankan backend:

```powershell
cd backend
composer install
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
```

Jalankan frontend:

```powershell
cd ../frontend
copy .env.example .env.local
npm install
npm run dev
```

## Deploy Frontend ke Vercel

1. Import repository GitHub ke Vercel.
2. Saat setup project, set `Root Directory` ke `frontend`.
3. Tambahkan environment variable:

```env
NEXT_PUBLIC_SITE_URL=https://your-frontend.vercel.app
NEXT_PUBLIC_BACKEND_URL=https://your-backend-domain.example.com
```

4. Deploy dengan preset Next.js bawaan Vercel.

Catatan:

- `frontend/vercel.json` sudah disiapkan agar framework terbaca sebagai `nextjs`.
- Tautan admin dan endpoint API demo di frontend sudah memakai env, tidak lagi hardcoded ke localhost.

## Deploy Backend Laravel

Pilihan realistis:

- VPS + Nginx/Apache
- Laravel Forge
- Shared hosting modern
- Platform PHP lain yang kompatibel

Gunakan document root ke `backend/public`.

Pastikan production backend menyiapkan:

- database MySQL production
- `APP_DEBUG=false`
- storage write access
- `php artisan storage:link`
- `php artisan migrate --force`

## Migrasi dari Lokal ke Production

1. Export database MySQL lokal.
2. Import ke database production.
3. Set `.env` backend production.
4. Sinkronkan folder upload/media.
5. Jalankan `php artisan migrate --force`.
