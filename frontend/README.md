# Frontend SMAN Ilum Modern

Frontend publik berbasis Next.js untuk website sekolah. Folder ini dimaksudkan sebagai project yang di-deploy ke Vercel dari monorepo utama.

## Jalankan Lokal

1. Copy `.env.example` menjadi `.env.local`
2. Install dependency:

```bash
npm install
```

3. Jalankan dev server:

```bash
npm run dev
```

Frontend akan aktif di `http://localhost:3000`.

## Environment Variable

```env
NEXT_PUBLIC_SITE_URL=http://localhost:3000
NEXT_PUBLIC_BACKEND_URL=http://localhost/smanilum/backend/public
```

## Deploy ke Vercel

Saat import repository ini ke Vercel:

- gunakan `Framework Preset: Services`
- biarkan root repo memakai `vercel.json`
- isi `NEXT_PUBLIC_SITE_URL` dengan URL Vercel frontend
- isi `NEXT_PUBLIC_BACKEND_URL` dengan domain backend Laravel production

Frontend ini tidak lagi mengandung URL localhost yang hardcoded untuk admin atau API demo.
