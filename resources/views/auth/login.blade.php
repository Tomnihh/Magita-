<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — MAGITA Inspektorat Kabupaten Sumbawa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1a3a5c 0%, #1e4976 50%, #2e7d32 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-card {
            background: #fff;
            border-radius: .875rem;
            box-shadow: 0 .75rem 2rem rgba(0,0,0,.25);
            width: 100%;
            max-width: 360px;
            padding: 1.75rem 1.75rem 1.5rem;
        }
        .brand-logo {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #1a3a5c, #2e7d32);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto .75rem;
        }
        .divider { position: relative; text-align: center; margin: 1.25rem 0; }
        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            border-top: 1px solid #dee2e6;
        }
        .divider span {
            background: #fff;
            padding: 0 .75rem;
            position: relative;
            color: #6c757d;
            font-size: .85rem;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="text-center mb-3">
            <div class="brand-logo">
                <i class="bi bi-shield-check text-white fs-4"></i>
            </div>
            <h5 class="fw-bold text-dark mb-0">MAGITA</h5>
            <p class="text-muted small mb-0">Sistem Pengawasan Dana Desa</p>
            <p class="text-muted small">Inspektorat Kabupaten Sumbawa</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show py-2" role="alert">
                <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}" autocomplete="off">
            @csrf

            <div class="mb-2">
                <label for="identifier" class="form-label fw-semibold small">NIK atau Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input
                        type="text"
                        id="identifier"
                        name="identifier"
                        class="form-control @error('identifier') is-invalid @enderror"
                        placeholder="Masukkan NIK (16 digit) atau Email"
                        value="{{ old('identifier') }}"
                        autofocus
                        required
                    >
                    @error('identifier')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-2">
                <label for="password" class="form-label fw-semibold small">Kata Sandi</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Masukkan kata sandi"
                        required
                    >
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="bi bi-eye" id="eyeIcon"></i>
                    </button>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-2 form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                <label class="form-check-label text-muted small" for="remember">Ingat saya</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
            </button>
        </form>

        <div class="divider"><span>atau</span></div>

        <div class="text-center">
            <p class="text-muted small mb-1">Belum memiliki akun?</p>
            <a href="{{ route('register') }}" class="btn btn-outline-secondary w-100">
                <i class="bi bi-person-plus me-2"></i>Daftar sebagai Warga
            </a>
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('cek-laporan') }}" class="text-decoration-none small text-muted">
                <i class="bi bi-search me-1"></i>Cek Status Laporan (tanpa login)
            </a>
        </div>

        <p class="text-center text-muted mt-2 mb-0" style="font-size:.75rem">
            &copy; {{ date('Y') }} Inspektorat Kabupaten Sumbawa
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const pwd = document.getElementById('password');
            const icon = document.getElementById('eyeIcon');
            if (pwd.type === 'password') {
                pwd.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                pwd.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        });
    </script>
</body>
</html>
