# Security Checklist

- Authentication aman dengan hashing password Laravel
- Session/token diregenerasi setelah login
- Opsi 2FA tersedia di model user
- Rate limiting login aktif
- Semua route admin memakai `auth:sanctum`
- Middleware `role` membatasi akses per role
- Validasi request di controller
- Eloquent/query builder untuk cegah SQL injection
- CSRF tetap aktif pada route web Laravel
- Secure headers middleware aktif
- Mime type dan ukuran upload dibatasi
- Honeypot/rate limit pada form publik
- `APP_DEBUG=false` di production
- Audit log untuk aktivitas admin
- HTTPS ready
- Backup database berkala

