# Supabase Storage Setup

Project ini memakai Supabase sebagai storage pendukung untuk upload media dari backend Laravel.

## Environment Variable

Tambahkan ke `backend/.env`:

```env
SUPABASE_URL=https://fmvljjyejyqoqeaxpexe.supabase.co
SUPABASE_ANON_KEY=sb_publishable_Ries-dtwe88Fz2aQfzqz4g_ErorHvNl
SUPABASE_SECRET_KEY=your_backend_secret_key
SUPABASE_STORAGE_CACHE_CONTROL=3600
SUPABASE_STORAGE_TIMEOUT=30
SUPABASE_BUCKET_LOGOS=logos
SUPABASE_BUCKET_FAVICONS=favicons
SUPABASE_BUCKET_POSTS=posts
SUPABASE_BUCKET_GALLERIES=galleries
SUPABASE_BUCKET_BANNERS=banners
```

Catatan:

- Jangan taruh `service_role` key di frontend.
- Backend Laravel akan memakai `SUPABASE_SECRET_KEY` jika tersedia, dan fallback ke `SUPABASE_ANON_KEY` hanya jika secret key belum diisi.
- `SUPABASE_ANON_KEY` tetap aman untuk kebutuhan client/public yang memang perlu dibaca publik.
- Agar upload backend berhasil, bucket dan policy Storage harus disiapkan di Supabase.

## Bucket yang Perlu Dibuat

Buat bucket public berikut di dashboard Supabase Storage:

- `logos`
- `favicons`
- `posts`
- `galleries`
- `banners`

Struktur path yang dipakai aplikasi:

- `logos/site/YYYY/MM/...`
- `favicons/site/YYYY/MM/...`
- `posts/thumbnails/YYYY/MM/...`
- `galleries/covers/YYYY/MM/...`
- `galleries/items/YYYY/MM/...`
- `banners/slides/YYYY/MM/...`

## Policy Storage

Model yang direkomendasikan:

- bucket dibuat public untuk file yang memang harus tampil di website
- upload dan delete dilakukan oleh backend Laravel memakai `SUPABASE_SECRET_KEY`
- frontend tidak pernah menerima secret key

Dengan model ini, policy yang perlu dibuka untuk publik cukup sebatas baca file yang memang public.

## Fitur yang Sudah Terhubung

- Upload logo website
- Upload favicon website
- Upload thumbnail berita
- Upload banner slider
- Upload galeri foto dan cover album

Semua operasi upload dilakukan dari backend Laravel. Database menyimpan nilai URL file yang dikembalikan oleh Supabase Storage.

## Validasi Upload

- logo: `jpg`, `jpeg`, `png`, `svg`, maks 2MB
- favicon: `png`, `ico`, maks 1MB
- thumbnail/banner/galeri: `jpg`, `jpeg`, `png`, `webp`, maks 5MB

## Testing End-to-End

1. Copy `backend/.env.example` ke `backend/.env`.
2. Pastikan semua bucket sudah dibuat di Supabase.
3. Pastikan policy bucket mengizinkan upload dan delete untuk role yang dipakai.
4. Jalankan backend Laravel.
5. Login admin.
6. Uji upload:
   - Pengaturan Website: upload logo dan favicon
   - Berita: upload thumbnail
   - Banner Slider: upload banner
   - Galeri: upload cover dan beberapa foto
7. Simpan form dan pastikan:
   - preview tampil di dashboard admin
   - URL file tersimpan di database
   - halaman publik memuat gambar dari domain Supabase
8. Ubah file yang sama sekali lagi dan pastikan file lama terhapus dari bucket jika policy delete aktif.

## Perbaikan URL Lama

Jika ada data lama yang masih menyimpan URL seperti:

```text
https://...supabase.co/storage/v1/object/<bucket>/<path>
```

jalankan command Laravel berikut:

```powershell
php artisan media:fix-supabase-urls --dry-run
php artisan media:fix-supabase-urls
```

Command ini akan memperbaiki URL menjadi format public yang benar:

```text
https://...supabase.co/storage/v1/object/public/<bucket>/<path>
```

## Catatan Verifikasi

Di environment pengembangan ini saya bisa memverifikasi integrasi kode dan alur build Laravel/Blade, tetapi tidak bisa menyelesaikan upload live ke project Supabase tanpa akses network runtime dan policy bucket aktif di project Supabase Anda.
