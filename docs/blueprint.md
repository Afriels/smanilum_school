# Blueprint Website Sekolah Modern

## Arsitektur Final

Implementasi final memakai `Laravel monolith + Blade + MySQL`.

### Yang berjalan di XAMPP

- Apache
- PHP
- MySQL
- Seluruh website publik
- Seluruh dashboard admin
- Session auth admin
- Upload file lokal

## Struktur Folder Project

```text
backend/
├─ app/
│  ├─ Http/Controllers/Admin
│  ├─ Http/Controllers/Public
│  ├─ Models
│  └─ Support
├─ database/
├─ resources/views/admin
├─ resources/views/public
├─ public/
└─ routes/
```

## Struktur Database Inti

- `users`
- `roles`
- `audit_logs`
- `site_settings`
- `navigation_items`
- `banners`
- `posts`
- `staff_members`
- `extracurriculars`
- `gallery_albums`
- `gallery_items`
- `home_sections`
- `contact_messages`
- `pages`
- `announcements`
- `post_categories`

## Daftar Fitur Lengkap

### Public

- Beranda modular
- Profil sekolah
- Akademik
- Ekstrakurikuler
- Berita dan pengumuman
- Galeri foto/video
- Kontak + form + peta
- CTA pendaftaran/konsultasi
- SEO metadata dasar
- Pencarian konten
- Filter kategori berita

### Admin

- Login aman
- Dashboard statistik
- CRUD konten utama
- Site identity settings
- Menu management
- Draft / publish / archive
- Upload media dengan preview
- User management + role
- Audit log
- SEO setting dasar
- Featured slider post management
- User management

## Wireframe Per Halaman

### Beranda

1. Sticky header
2. Hero besar
3. Sambutan kepala sekolah
4. Highlight keunggulan
5. Statistik
6. Berita terbaru
7. Pengumuman / agenda
8. Galeri
9. Prestasi / testimoni
10. CTA
11. Footer lengkap

### Profil

1. Hero internal page
2. Sejarah
3. Visi & misi
4. Struktur organisasi
5. Guru & staf
6. Fasilitas

### Akademik

1. Hero internal page
2. Kurikulum
3. Program unggulan
4. Informasi akademik

### Ekstrakurikuler

1. Hero internal page
2. Grid daftar ekskul
3. Deskripsi kegiatan
4. Dokumentasi

### Berita

1. Hero internal page
2. Search bar
3. Filter kategori
4. Grid berita
5. Sidebar pengumuman

### Galeri

1. Hero internal page
2. Filter album
3. Grid foto/video
4. Detail album

### Kontak

1. Hero internal page
2. Info alamat & jam
3. Form kontak
4. Info humas
5. Embedded map

## UI Component List

- Sticky header
- Hero banner
- Section heading
- Statistic cards
- News cards
- Announcement list
- Feature cards
- Gallery cards
- CTA strip
- Staff cards
- Contact form
- Footer info grid
- Admin table
- Admin sidebar
- Status badge
- Media upload field

## Alur Dashboard Admin

1. Login admin
2. Validasi rate limit, auth, role, session/token
3. Verifikasi 2FA bila aktif
4. Dashboard overview
5. Kelola modul konten
6. Draft
7. Preview
8. Publish
9. Featured post bisa tampil di slider
10. Audit log tercatat

## Role & Permission Matrix

| Modul | Super Admin | Admin Konten | Editor | Viewer |
|---|---|---|---|---|
| Dashboard | Full | Full | Read | Read |
| User management | Full | No | No | No |
| Role assignment | Full | No | No | No |
| Site settings | Full | Limited | No | Read |
| Navigation | Full | Full | Limited | Read |
| Banner | Full | Full | Edit | Read |
| Profil sekolah | Full | Full | Edit | Read |
| Berita | Full | Full | Edit | Read |
| Pengumuman | Full | Full | Edit | Read |
| Galeri | Full | Full | Edit | Read |
| Guru & staf | Full | Full | Edit | Read |
| Ekskul | Full | Full | Edit | Read |
| Audit log | Full | Read | No | No |

## File `.env` Contoh

Lihat root [.env.example](../.env.example).
