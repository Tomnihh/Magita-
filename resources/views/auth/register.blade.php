<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — MAGITA Inspektorat Kabupaten Sumbawa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1a3a5c 0%, #1e4976 50%, #2e7d32 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }
        .auth-card {
            background: #fff;
            border-radius: .875rem;
            box-shadow: 0 .75rem 2rem rgba(0,0,0,.25);
            width: 100%;
            max-width: 520px;
            margin: auto;
            padding: 2rem;
        }
        .ktp-preview { max-height: 150px; object-fit: contain; border-radius: .375rem; }

        /* Indikator validasi inline */
        .field-hint { font-size: .75rem; margin-top: .25rem; }
        .field-hint.ok   { color: #198754; }
        .field-hint.err  { color: #dc3545; }
        .field-hint.idle { color: #6c757d; }

        .input-group .form-control.is-valid  { border-color: #198754; }
        .input-group .form-control.is-invalid{ border-color: #dc3545; }
    </style>
</head>
<body>
<div class="container">
    <div class="auth-card">
        <div class="text-center mb-3">
            <i class="bi bi-person-plus-fill fs-2 text-primary"></i>
            <h5 class="fw-bold mt-1 mb-0">Daftar Akun Warga</h5>
            <p class="text-muted small">MAGITA — Inspektorat Kabupaten Sumbawa</p>
        </div>

        <div class="alert alert-info small py-2 mb-3">
            <i class="bi bi-info-circle me-1"></i>
            Pendaftaran memerlukan foto KTP asli. Akun aktif setelah diverifikasi administrator.
        </div>

        <form method="POST" action="{{ route('register.post') }}" enctype="multipart/form-data" id="formRegister" novalidate>
            @csrf

            <div class="row g-3">

                {{-- NIK --}}
                <div class="col-12">
                    <label for="nik" class="form-label fw-semibold small">
                        NIK <span class="text-danger">*</span>
                    </label>
                    <input
                        type="text"
                        id="nik"
                        name="nik"
                        class="form-control @error('nik') is-invalid @enderror"
                        placeholder="16 digit sesuai KTP"
                        value="{{ old('nik') }}"
                        maxlength="16"
                        inputmode="numeric"
                        autocomplete="off"
                        required
                    >
                    @error('nik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        <div class="field-hint idle" id="nikHint">
                            <i class="bi bi-info-circle me-1"></i>
                            NIK terdiri dari 16 digit angka yang tertera di KTP Anda
                        </div>
                    @enderror
                </div>

                {{-- Nama Lengkap --}}
                <div class="col-12">
                    <label for="nama_lengkap" class="form-label fw-semibold small">
                        Nama Lengkap <span class="text-danger">*</span>
                    </label>
                    <input
                        type="text"
                        id="nama_lengkap"
                        name="nama_lengkap"
                        class="form-control @error('nama_lengkap') is-invalid @enderror"
                        placeholder="Sesuai KTP (tanpa gelar)"
                        value="{{ old('nama_lengkap') }}"
                        required
                    >
                    @error('nama_lengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @else
                        <div class="field-hint idle">Tuliskan nama persis seperti di KTP</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="col-12">
                    <label for="email" class="form-label fw-semibold small">
                        Email <span class="text-muted">(opsional)</span>
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="contoh@email.com"
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Nomor WhatsApp --}}
                <div class="col-12">
                    <label for="no_whatsapp" class="form-label fw-semibold small">
                        Nomor WhatsApp <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-success text-white">
                            <i class="bi bi-whatsapp"></i>
                        </span>
                        <input
                            type="text"
                            id="no_whatsapp"
                            name="no_whatsapp"
                            class="form-control @error('no_whatsapp') is-invalid @enderror"
                            placeholder="Contoh: 081234567890"
                            value="{{ old('no_whatsapp') }}"
                            maxlength="16"
                            inputmode="tel"
                            required
                        >
                        @error('no_whatsapp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @unless($errors->has('no_whatsapp'))
                        <div class="field-hint idle" id="waHint">
                            <i class="bi bi-info-circle me-1"></i>
                            Format: <strong>08xx</strong>, <strong>+628xx</strong>, atau <strong>628xx</strong> — 10 hingga 15 digit
                        </div>
                    @endunless
                </div>

                {{-- Password --}}
                <div class="col-md-6">
                    <label for="password" class="form-label fw-semibold small">
                        Kata Sandi <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control @error('password') is-invalid @enderror"
                            placeholder="Minimal 8 karakter"
                            required
                        >
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePwd('password','eyePwd')">
                            <i class="bi bi-eye" id="eyePwd"></i>
                        </button>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="field-hint idle" id="pwdHint">Minimal 8 karakter</div>
                </div>

                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label fw-semibold small">
                        Konfirmasi Sandi <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            class="form-control"
                            placeholder="Ulangi kata sandi"
                            required
                        >
                        <button type="button" class="btn btn-outline-secondary" onclick="togglePwd('password_confirmation','eyeConf')">
                            <i class="bi bi-eye" id="eyeConf"></i>
                        </button>
                    </div>
                    <div class="field-hint idle" id="confirmHint">Harus sama dengan kata sandi</div>
                </div>

                {{-- Foto KTP --}}
                <div class="col-12">
                    <label for="foto_ktp" class="form-label fw-semibold small">
                        Foto KTP <span class="text-danger">*</span>
                    </label>
                    <input
                        type="file"
                        id="foto_ktp"
                        name="foto_ktp"
                        class="form-control @error('foto_ktp') is-invalid @enderror"
                        accept="image/jpg,image/jpeg,image/png"
                        required
                    >
                    <div class="field-hint idle">
                        <i class="bi bi-camera me-1"></i>
                        Format JPG/PNG, maks. 2MB. Foto harus jelas terbaca — seluruh bagian KTP terlihat
                    </div>
                    @error('foto_ktp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="ktpPreviewWrapper" class="mt-2 d-none">
                        <img id="ktpPreview" src="#" alt="Preview KTP"
                            class="ktp-preview img-thumbnail d-block">
                        <small class="text-success"><i class="bi bi-check-circle me-1"></i>Foto dipilih</small>
                    </div>
                </div>

            </div>{{-- /row --}}

            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold mt-4">
                <i class="bi bi-send me-2"></i>Kirim Pendaftaran
            </button>
        </form>

        <hr class="my-3">
        <div class="text-center">
            <a href="{{ route('login') }}" class="text-decoration-none small">
                <i class="bi bi-arrow-left me-1"></i>Sudah punya akun? Masuk
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
/* ── Helpers ─────────────────────────────────────────── */
function setHint(el, type, msg) {
    el.className = 'field-hint ' + type;
    el.innerHTML = msg;
}
function togglePwd(inputId, iconId) {
    const inp  = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if (inp.type === 'password') {
        inp.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        inp.type = 'password';
        icon.className = 'bi bi-eye';
    }
}

/* ── NIK Validasi ─────────────────────────────────────── */
const nikInput = document.getElementById('nik');
const nikHint  = document.getElementById('nikHint');

nikInput.addEventListener('input', function () {
    // Hanya angka
    this.value = this.value.replace(/\D/g, '');
    const v = this.value;

    if (v.length === 0) {
        this.classList.remove('is-valid','is-invalid');
        if (nikHint) setHint(nikHint, 'idle',
            '<i class="bi bi-info-circle me-1"></i>NIK terdiri dari 16 digit angka yang tertera di KTP Anda');
        return;
    }
    if (v.length < 16) {
        this.classList.replace('is-valid','is-invalid') || this.classList.add('is-invalid');
        this.classList.remove('is-valid');
        if (nikHint) setHint(nikHint, 'err',
            `<i class="bi bi-x-circle me-1"></i>Baru ${v.length} digit — NIK harus tepat 16 digit`);
        return;
    }

    // Cek kode wilayah (2 digit pertama 11–92)
    const kodeWil = parseInt(v.substring(0, 2));
    if (kodeWil < 11 || kodeWil > 92) {
        this.classList.add('is-invalid'); this.classList.remove('is-valid');
        if (nikHint) setHint(nikHint, 'err',
            '<i class="bi bi-x-circle me-1"></i>Kode wilayah tidak valid (digit 1–2)');
        return;
    }

    // Cek tanggal lahir (digit 7–8: wanita +40, pria 01–31)
    const tgl = parseInt(v.substring(6, 8));
    const tglValid = (tgl >= 1 && tgl <= 31) || (tgl >= 41 && tgl <= 71);
    if (!tglValid) {
        this.classList.add('is-invalid'); this.classList.remove('is-valid');
        if (nikHint) setHint(nikHint, 'err',
            '<i class="bi bi-x-circle me-1"></i>Tanggal lahir tidak valid (digit 7–8)');
        return;
    }

    // Cek bulan lahir (digit 9–10: 01–12)
    const bln = parseInt(v.substring(8, 10));
    if (bln < 1 || bln > 12) {
        this.classList.add('is-invalid'); this.classList.remove('is-valid');
        if (nikHint) setHint(nikHint, 'err',
            '<i class="bi bi-x-circle me-1"></i>Bulan lahir tidak valid (digit 9–10)');
        return;
    }

    this.classList.remove('is-invalid'); this.classList.add('is-valid');
    if (nikHint) setHint(nikHint, 'ok',
        '<i class="bi bi-check-circle me-1"></i>Format NIK valid');
});

/* ── WhatsApp Validasi ────────────────────────────────── */
const waInput = document.getElementById('no_whatsapp');
const waHint  = document.getElementById('waHint');
const waRegex = /^(\+62|62|0)8[1-9][0-9]{7,11}$/;

if (waInput) {
    waInput.addEventListener('input', function () {
        const v = this.value.trim();
        if (v.length === 0) {
            this.classList.remove('is-valid','is-invalid');
            if (waHint) setHint(waHint, 'idle',
                '<i class="bi bi-info-circle me-1"></i>Format: <strong>08xx</strong>, <strong>+628xx</strong>, atau <strong>628xx</strong> — 10 hingga 15 digit');
            return;
        }
        if (waRegex.test(v)) {
            this.classList.remove('is-invalid'); this.classList.add('is-valid');
            if (waHint) setHint(waHint, 'ok',
                '<i class="bi bi-check-circle me-1"></i>Nomor WhatsApp valid');
        } else {
            this.classList.remove('is-valid'); this.classList.add('is-invalid');
            if (waHint) setHint(waHint, 'err',
                '<i class="bi bi-x-circle me-1"></i>Format salah. Gunakan: 08xx / +628xx / 628xx');
        }
    });
}

/* ── Password strength ────────────────────────────────── */
const pwdInput  = document.getElementById('password');
const confInput = document.getElementById('password_confirmation');
const pwdHint   = document.getElementById('pwdHint');
const confHint  = document.getElementById('confirmHint');

pwdInput.addEventListener('input', function () {
    const v = this.value;
    if (v.length === 0) {
        this.classList.remove('is-valid','is-invalid');
        setHint(pwdHint, 'idle', 'Minimal 8 karakter');
        return;
    }
    if (v.length < 8) {
        this.classList.add('is-invalid'); this.classList.remove('is-valid');
        setHint(pwdHint, 'err', `<i class="bi bi-x-circle me-1"></i>${v.length}/8 karakter`);
    } else {
        this.classList.remove('is-invalid'); this.classList.add('is-valid');
        setHint(pwdHint, 'ok', '<i class="bi bi-check-circle me-1"></i>Kata sandi cukup kuat');
    }
    // Re-check konfirmasi kalau sudah diisi
    if (confInput.value.length > 0) confInput.dispatchEvent(new Event('input'));
});

confInput.addEventListener('input', function () {
    const v = this.value;
    if (v.length === 0) {
        this.classList.remove('is-valid','is-invalid');
        setHint(confHint, 'idle', 'Harus sama dengan kata sandi');
        return;
    }
    if (v === pwdInput.value) {
        this.classList.remove('is-invalid'); this.classList.add('is-valid');
        setHint(confHint, 'ok', '<i class="bi bi-check-circle me-1"></i>Kata sandi cocok');
    } else {
        this.classList.add('is-invalid'); this.classList.remove('is-valid');
        setHint(confHint, 'err', '<i class="bi bi-x-circle me-1"></i>Kata sandi tidak cocok');
    }
});

/* ── Preview KTP ──────────────────────────────────────── */
document.getElementById('foto_ktp').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (ev) {
            document.getElementById('ktpPreview').src = ev.target.result;
            document.getElementById('ktpPreviewWrapper').classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    }
});

/* ── Blokir submit jika ada error frontend ────────────── */
document.getElementById('formRegister').addEventListener('submit', function (e) {
    const nik = document.getElementById('nik');
    const wa  = document.getElementById('no_whatsapp');
    if (nik.classList.contains('is-invalid') || wa.classList.contains('is-invalid')) {
        e.preventDefault();
        nik.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});
</script>
</body>
</html>
