<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | SMAN Ilum Modern</title>
    <style>
        :root {
            --bg: #f5fbff;
            --surface: rgba(255, 255, 255, 0.95);
            --surface-soft: #eef6ff;
            --primary: #0f4fbf;
            --primary-dark: #0a387f;
            --border: #d8e6f7;
            --text: #11233f;
            --muted: #4c6584;
            --danger: #b42318;
            --shadow: 0 24px 64px rgba(15, 79, 191, 0.14);
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(15, 79, 191, .14), transparent 24%),
                linear-gradient(180deg, var(--bg), #ffffff);
        }

        .shell {
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
        }

        .layout {
            width: min(1080px, 100%);
            display: grid;
            gap: 24px;
        }

        @media (min-width: 900px) {
            .layout {
                grid-template-columns: minmax(0, 1.05fr) minmax(360px, .95fr);
                align-items: stretch;
            }
        }

        .panel,
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 28px;
            box-shadow: var(--shadow);
            backdrop-filter: blur(12px);
        }

        .panel {
            padding: 40px;
            background: linear-gradient(145deg, #0a387f, #0f4fbf 54%, #72a8ff);
            color: white;
        }

        .card { padding: 32px; }
        .badge {
            display: inline-flex;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,.14);
            color: white;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .22em;
            text-transform: uppercase;
        }

        .soft-badge {
            display: inline-flex;
            padding: 8px 14px;
            border-radius: 999px;
            background: var(--surface-soft);
            color: var(--primary);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .18em;
            text-transform: uppercase;
        }

        h1, h2 {
            margin: 0;
            line-height: 1.2;
        }

        .panel h1 {
            margin-top: 18px;
            font-size: 44px;
            max-width: 560px;
        }

        .panel p {
            margin: 14px 0 0;
            max-width: 560px;
            color: rgba(255,255,255,.84);
            font-size: 17px;
            line-height: 1.8;
        }

        .info-grid {
            display: grid;
            gap: 14px;
            margin-top: 28px;
        }

        .info-item {
            padding: 16px 18px;
            border-radius: 20px;
            background: rgba(255,255,255,.12);
        }

        .info-item strong {
            display: block;
            font-size: 14px;
            margin-bottom: 6px;
        }

        .card h2 {
            margin-top: 18px;
            font-size: 34px;
        }

        .card p {
            color: var(--muted);
            line-height: 1.8;
        }

        form {
            margin-top: 24px;
            display: grid;
            gap: 16px;
        }

        label {
            display: grid;
            gap: 8px;
            font-size: 14px;
            font-weight: 700;
            color: var(--text);
        }

        input {
            width: 100%;
            padding: 14px 16px;
            border-radius: 16px;
            border: 1px solid var(--border);
            background: white;
            color: var(--text);
            font-size: 15px;
            outline: none;
        }

        input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(15, 79, 191, .12);
        }

        button {
            border: none;
            border-radius: 999px;
            padding: 14px 18px;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
            color: white;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
        }

        button[disabled] {
            opacity: .7;
            cursor: wait;
        }

        .helper {
            margin-top: 18px;
            padding: 16px 18px;
            border-radius: 18px;
            background: var(--surface-soft);
            color: var(--muted);
            font-size: 14px;
            line-height: 1.7;
        }

        .error,
        .success {
            display: none;
            border-radius: 16px;
            padding: 14px 16px;
            font-size: 14px;
            line-height: 1.7;
        }

        .error {
            background: #fff1f1;
            color: var(--danger);
            border: 1px solid #fecaca;
        }

        .success {
            background: #ecfdf3;
            color: #027a48;
            border: 1px solid #abefc6;
        }

        code {
            background: rgba(17, 35, 63, .07);
            padding: 4px 8px;
            border-radius: 999px;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="shell">
        <div class="layout">
            <section class="panel">
                <span class="badge">Admin Portal</span>
                <h1>Masuk ke dashboard admin sekolah yang aman dan mudah dikelola.</h1>
                <p>
                    Area admin ini terhubung langsung ke API Laravel. Setelah login berhasil, token akses akan dipakai untuk membaca data dashboard dan mengelola modul konten secara terpisah dari website publik.
                </p>

                <div class="info-grid">
                    <div class="info-item">
                        <strong>Kredensial Awal</strong>
                        <span><code>superadmin@sekolah.test</code> / <code>ChangeMe123!</code></span>
                    </div>
                    <div class="info-item">
                        <strong>Keamanan Dasar</strong>
                        <span>Rate limiting login, role-based access control, audit log, dan token Sanctum.</span>
                    </div>
                    <div class="info-item">
                        <strong>Langkah Berikutnya</strong>
                        <span>Setelah login, dashboard bisa dilanjutkan ke CRUD berita, banner, galeri, guru/staf, dan pengaturan situs.</span>
                    </div>
                </div>
            </section>

            <section class="card">
                <span class="soft-badge">Login Admin</span>
                <h2>Masuk</h2>
                <p>Gunakan akun admin yang tersedia untuk mengakses dashboard.</p>

                <div id="login-success" class="success"></div>
                <div id="login-error" class="error"></div>

                <form id="login-form">
                    <label>
                        Email
                        <input id="email" name="email" type="email" autocomplete="username" required>
                    </label>

                    <label>
                        Password
                        <input id="password" name="password" type="password" autocomplete="current-password" required>
                    </label>

                    <button id="submit-button" type="submit">Masuk ke Dashboard</button>
                </form>

                <div class="helper">
                    Endpoint login aktif di <code>{{ url('/api/v1/admin/login') }}</code>. Token akan disimpan di browser agar dashboard dapat memuat data sesi admin.
                </div>
            </section>
        </div>
    </div>

    <script>
        const form = document.getElementById('login-form');
        const submitButton = document.getElementById('submit-button');
        const errorBox = document.getElementById('login-error');
        const successBox = document.getElementById('login-success');
        const tokenKey = 'smanilum_admin_token';
        const userKey = 'smanilum_admin_user';

        const existingToken = localStorage.getItem(tokenKey);
        if (existingToken) {
            window.location.href = "{{ url('/admin') }}";
        }

        function setMessage(element, text) {
            element.textContent = text;
            element.style.display = text ? 'block' : 'none';
        }

        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            setMessage(errorBox, '');
            setMessage(successBox, '');
            submitButton.disabled = true;
            submitButton.textContent = 'Memproses...';

            const payload = {
                email: document.getElementById('email').value.trim(),
                password: document.getElementById('password').value
            };

            try {
                const response = await fetch("{{ url('/api/v1/admin/login') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();

                if (!response.ok) {
                    const validationErrors = result.errors ? Object.values(result.errors).flat().join(' ') : '';
                    throw new Error(validationErrors || result.message || 'Login gagal.');
                }

                localStorage.setItem(tokenKey, result.token);
                localStorage.setItem(userKey, JSON.stringify(result.user));
                setMessage(successBox, 'Login berhasil. Mengarahkan ke dashboard...');
                window.setTimeout(() => {
                    window.location.href = "{{ url('/admin') }}";
                }, 700);
            } catch (error) {
                setMessage(errorBox, error.message || 'Terjadi kesalahan saat login.');
            } finally {
                submitButton.disabled = false;
                submitButton.textContent = 'Masuk ke Dashboard';
            }
        });
    </script>
</body>
</html>

