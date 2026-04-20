# SMAN Ilum Modern

Monorepo website sekolah yang berisi dua aplikasi utama:

- `backend/`: Laravel 9 + Blade + MySQL untuk CMS, login admin, API publik, dan manajemen konten
- `frontend/`: Next.js 16 + React 19 untuk website publik yang siap dipasang di Vercel

Struktur ini tetap nyaman dipakai lokal dengan XAMPP untuk backend, sambil menjaga frontend tetap mudah dipublish sebagai project Vercel terpisah.

## Stack

- Backend CMS: Laravel 9
- Frontend publik: Next.js 16
- Dashboard admin: Blade + Tailwind CDN
- Database: MySQL
- Authentication admin: Laravel session auth
- Upload file: Laravel `public` disk

## Struktur Project

```text
smanilum/
|-- backend/
|   |-- app/
|   |-- database/
|   |-- resources/views/
|   |-- routes/
|   `-- .env.example
|-- docs/
`-- frontend/
```

## Fitur Utama

### Backend Laravel

- Website publik Blade
- Login admin berbasis session
- Dashboard admin
- CRUD berita
- CRUD kategori berita
- CRUD banner
- CRUD halaman profil
- CRUD ekstrakurikuler
- CRUD pengumuman
- CRUD galeri
- Pengaturan website
- Manajemen user admin
- API publik untuk konsumsi frontend
- Upload file ke `storage/app/public`

### Frontend Next.js

- Landing page sekolah modern
- Halaman profil, akademik, ekstrakurikuler, berita, galeri, dan kontak
- Link admin dan endpoint API berbasis environment variable
- Siap dijadikan Vercel project dengan `frontend` sebagai Root Directory

## Menjalankan Backend Lokal

1. Simpan project di `c:\xampp\htdocs\smanilum`
2. Nyalakan `Apache` dan `MySQL` di XAMPP
3. Buat database MySQL `smanilum_school`
4. Masuk ke folder backend:

```powershell
cd c:\xampp\htdocs\smanilum\backend
```

5. Copy `.env.example` menjadi `.env`, lalu pastikan nilai penting berikut sesuai:

```env
APP_URL=http://localhost/smanilum/backend/public
DB_DATABASE=smanilum_school
DB_USERNAME=root
DB_PASSWORD=
FILESYSTEM_DISK=public
```

6. Jalankan setup:

```powershell
composer install
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
```

Backend lokal tersedia di:

- Website publik Blade: `http://localhost/smanilum/backend/public`
- Login admin: `http://localhost/smanilum/backend/public/admin/login`
- Dashboard admin: `http://localhost/smanilum/backend/public/admin/dashboard`

## Menjalankan Frontend Lokal

1. Masuk ke folder frontend:

```powershell
cd c:\xampp\htdocs\smanilum\frontend
```

2. Copy `.env.example` menjadi `.env.local`
3. Install dependency dan jalankan dev server:

```powershell
npm install
npm run dev
```

Frontend tersedia di `http://localhost:3000`.

## Login Admin Default

Super Admin:

- Email: `superadmin@sekolah.test`
- Password: `ChangeMe123!`

Editor:

- Email: `editor@sekolah.test`
- Password: `ChangeMe123!`

## Deploy

### Frontend ke Vercel

- Import repository ini ke Vercel
- Gunakan `Framework Preset: Services`
- Repo ini sudah punya [vercel.json](/abs/c:/xampp/htdocs/smanilum/vercel.json:1) di root untuk service `frontend`
- Tambahkan env berikut:

```env
NEXT_PUBLIC_SITE_URL=https://nama-project-anda.vercel.app
NEXT_PUBLIC_BACKEND_URL=https://backend-anda.example.com
```

- Deploy project

### Backend Laravel

Backend Laravel belum saya daftarkan sebagai Vercel Service di `vercel.json`. Alasannya, backend ini adalah aplikasi PHP Laravel, sedangkan konfigurasi seperti `framework: "vite"` hanya cocok untuk build asset frontend, bukan untuk menjalankan runtime Laravel. Untuk saat ini, deploy backend ke hosting PHP yang kompatibel, misalnya VPS, Forge, shared hosting modern, atau platform PHP lain, lalu arahkan `NEXT_PUBLIC_BACKEND_URL` frontend ke domain backend tersebut.

Untuk Railway, panduan deploy backend yang spesifik ke repo ini ada di [docs/railway-backend.md](/abs/c:/xampp/htdocs/smanilum/docs/railway-backend.md:1). Repo ini sudah memiliki [backend/railway.toml](/abs/c:/xampp/htdocs/smanilum/backend/railway.toml:1), script [backend/railway/predeploy.sh](/abs/c:/xampp/htdocs/smanilum/backend/railway/predeploy.sh:1), dan endpoint `/healthz` untuk health check service.

## Supabase Storage

Panduan setup env, bucket, policy, dan testing upload end-to-end ada di [docs/supabase-storage.md](/abs/c:/xampp/htdocs/smanilum/docs/supabase-storage.md:1).

## Verifikasi Lokal yang Sudah Pernah Dilakukan

- `php artisan route:list` sukses
- `php artisan migrate:fresh --seed` sukses
