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
2. Set `Framework Preset` ke `Services`.
3. Tambahkan environment variable:

```env
NEXT_PUBLIC_SITE_URL=https://your-frontend.vercel.app
NEXT_PUBLIC_BACKEND_URL=https://your-backend-domain.example.com
```

4. Deploy. Service `frontend` akan dibaca dari `vercel.json` root repo.

Catatan:

- `vercel.json` harus berada di root repo untuk mode multi-service.
- Saat ini hanya `frontend` yang didaftarkan sebagai service.
- Tautan admin dan endpoint API demo di frontend sudah memakai env, tidak lagi hardcoded ke localhost.

## Deploy Backend Laravel

Pilihan realistis:

- VPS + Nginx/Apache
- Laravel Forge
- Shared hosting modern
- Platform PHP lain yang kompatibel
- Railway

Gunakan document root ke `backend/public`.

Catatan penting:

- Konfigurasi `backend` sebagai Vercel Service belum ditambahkan karena repo ini memakai Laravel/PHP.
- Menetapkan `framework: "vite"` untuk folder `backend` tidak akan menjalankan aplikasi Laravel; itu hanya relevan untuk build asset Vite.
- Berdasarkan dokumentasi Vercel Services terbaru, fitur ini masih Private Beta dan yang disebut production-ready terutama Python dan Go. Saya tidak menebak konfigurasi PHP service yang belum tervalidasi untuk repo ini.

Pastikan production backend menyiapkan:

- database MySQL production
- `APP_DEBUG=false`
- storage write access
- `php artisan storage:link`
- `php artisan migrate --force`

Untuk Railway, panduan yang spesifik ke repo ini ada di [docs/railway-backend.md](/abs/c:/xampp/htdocs/smanilum/docs/railway-backend.md:1). File [backend/railway.toml](/abs/c:/xampp/htdocs/smanilum/backend/railway.toml:1) dan [backend/railway/predeploy.sh](/abs/c:/xampp/htdocs/smanilum/backend/railway/predeploy.sh:1) sudah disiapkan agar `migrate --force` dan init dasar bisa jalan otomatis saat deploy.

## Migrasi dari Lokal ke Production

1. Export database MySQL lokal.
2. Import ke database production.
3. Set `.env` backend production.
4. Sinkronkan folder upload/media.
5. Jalankan `php artisan migrate --force`.
