# Deploy Backend Laravel ke Railway

Panduan ini khusus untuk folder `backend/` pada repo ini. Frontend Next.js tetap dideploy terpisah ke Vercel.

## File yang Sudah Disiapkan

- [backend/railway.toml](/abs/c:/xampp/htdocs/smanilum/backend/railway.toml:1)
  Konfigurasi service Railway untuk backend Laravel
- [backend/railway/predeploy.sh](/abs/c:/xampp/htdocs/smanilum/backend/railway/predeploy.sh:1)
  Script pre-deploy yang menjalankan migration dan inisialisasi aman
- [backend/routes/web.php](/abs/c:/xampp/htdocs/smanilum/backend/routes/web.php:1)
  Menambahkan endpoint health check `/healthz`

## Buat Service Backend di Railway

1. Buat project baru di Railway.
2. Pilih `Deploy from GitHub repo`.
3. Pilih repository `Afriels/smanilum_school`.
4. Pada service backend, set `Root Directory` ke `backend`.
5. Generate public domain Railway untuk service tersebut.

Setelah domain Railway terbentuk, gunakan domain itu untuk `APP_URL` dan untuk `NEXT_PUBLIC_BACKEND_URL` di Vercel frontend.

## Checklist Variables Railway

Isi variable berikut di service `backend` Railway.

### Wajib

```env
APP_NAME="SMAN Ilum Modern"
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:ISI_HASIL_PHP_ARTISAN_KEY_GENERATE
APP_URL=https://nama-service-anda.up.railway.app

LOG_CHANNEL=stderr
LOG_LEVEL=info
LOG_STDERR_FORMATTER=\Monolog\Formatter\JsonFormatter

DB_CONNECTION=mysql
DB_HOST=HOST_MYSQL_RAILWAY
DB_PORT=3306
DB_DATABASE=NAMA_DB
DB_USERNAME=USER_DB
DB_PASSWORD=PASSWORD_DB

FILESYSTEM_DISK=public
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_SECURE_COOKIE=true
SESSION_DOMAIN=
TRUSTED_PROXIES=*

FRONTEND_URL=https://nama-frontend-anda.vercel.app
SANCTUM_STATEFUL_DOMAINS=nama-frontend-anda.vercel.app

SUPABASE_URL=https://fmvljjyejyqoqeaxpexe.supabase.co
SUPABASE_ANON_KEY=sb_publishable_Ries-dtwe88Fz2aQfzqz4g_ErorHvNl
SUPABASE_SECRET_KEY=ISI_SECRET_KEY_BACKEND_ANDA
SUPABASE_BUCKET_LOGOS=logos
SUPABASE_BUCKET_FAVICONS=favicons
SUPABASE_BUCKET_POSTS=posts
SUPABASE_BUCKET_GALLERIES=galleries
SUPABASE_BUCKET_BANNERS=banners
```

### Opsional tapi Direkomendasikan

```env
MAIL_MAILER=log
MAIL_FROM_ADDRESS=admin@sekolah.sch.id
MAIL_FROM_NAME="SMAN Ilum Modern"
MEDIA_MAX_FILE_SIZE=5120
MEDIA_ALLOWED_IMAGE_MIMES=image/jpeg,image/png,image/webp
MEDIA_ALLOWED_DOCUMENT_MIMES=application/pdf
RAILWAY_RUN_SEEDERS=false
RAILWAY_FIX_SUPABASE_URLS=true
```

Catatan:

- `APP_KEY` harus dibuat sekali, lalu simpan permanen di Railway.
- `SUPABASE_SECRET_KEY` hanya untuk backend Laravel. Jangan dipasang di Vercel frontend.
- `SANCTUM_STATEFUL_DOMAINS` cukup isi hostname frontend tanpa `https://`.
- `TRUSTED_PROXIES=*` membantu Laravel mengenali HTTPS dan host asli di balik proxy Railway.

## Alur Deploy yang Sudah Disiapkan

Saat Railway deploy backend ini, file [backend/railway/predeploy.sh](/abs/c:/xampp/htdocs/smanilum/backend/railway/predeploy.sh:1) akan menjalankan:

1. `php artisan optimize:clear`
2. `php artisan config:cache`
3. `php artisan migrate --force`
4. `php artisan db:seed --force` jika `RAILWAY_RUN_SEEDERS=true`
5. `php artisan media:fix-supabase-urls` jika `RAILWAY_FIX_SUPABASE_URLS=true`

Ini membuat deploy pertama dan deploy berikutnya tetap konsisten tanpa perlu klik terminal manual setiap kali.

## Command Init yang Dipakai Sekali Saja

Beberapa hal tetap sebaiknya dilakukan sekali saat setup awal:

1. Buat `APP_KEY` lokal lalu salin ke Railway:

```powershell
cd c:\xampp\htdocs\smanilum\backend
php artisan key:generate --show
```

2. Siapkan database MySQL Railway lalu isi semua `DB_*` variable.
3. Pastikan bucket Supabase `logos`, `favicons`, `posts`, `galleries`, dan `banners` sudah ada.

## Verifikasi Setelah Deploy

1. Buka `https://domain-backend-anda/healthz`
   Respons harus berupa JSON dengan `status: ok`
2. Buka `https://domain-backend-anda/admin/login`
   Halaman login admin Laravel harus tampil
3. Update env Vercel frontend:

```env
NEXT_PUBLIC_BACKEND_URL=https://domain-backend-anda
```

4. Redeploy frontend Vercel

## Jika Deploy Gagal

- `APP_KEY is required before deploying to Railway`
  Isi `APP_KEY` di Railway terlebih dahulu
- Error koneksi database saat `migrate --force`
  Cek ulang `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- Tombol admin di frontend mengarah ke Supabase atau localhost
  Perbaiki `NEXT_PUBLIC_BACKEND_URL` di Vercel agar mengarah ke domain Railway backend
