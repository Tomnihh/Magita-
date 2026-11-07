@extends('layouts.app')

@section('title', 'Detail Verifikasi')
@section('page-title', 'Detail Pendaftar — ' . $user->nama_lengkap)

@section('content')
<div class="row g-3">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-person-badge me-2"></i>Data Pendaftar</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td class="text-muted small fw-semibold" style="width:40%">Nama Lengkap</td>
                        <td class="fw-bold">{{ $user->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small fw-semibold">NIK</td>
                        <td><code>{{ $user->nik }}</code></td>
                    </tr>
                    <tr>
                        <td class="text-muted small fw-semibold">Email</td>
                        <td>{{ $user->email ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small fw-semibold">WhatsApp</td>
                        <td>{{ $user->no_whatsapp }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small fw-semibold">Status</td>
                        <td>
                            <span class="badge bg-warning text-dark">{{ $user->status_akun }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted small fw-semibold">Terdaftar</td>
                        <td class="small">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Foto KTP -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-card-image me-2"></i>Foto KTP</h6>
            </div>
            <div class="card-body text-center">
                @if($user->foto_ktp_url)
                    <img src="{{ Storage::url($user->foto_ktp_url) }}"
                        alt="Foto KTP {{ $user->nama_lengkap }}"
                        class="img-fluid rounded"
                        style="max-height:300px; object-fit:contain">
                @else
                    <div class="text-muted py-4">
                        <i class="bi bi-image fs-1 d-block mb-2"></i>
                        Foto KTP tidak tersedia
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <!-- Form Setujui -->
        <div class="card mb-3">
            <div class="card-header bg-success text-white">
                <h6 class="mb-0"><i class="bi bi-check-circle me-2"></i>Setujui Pendaftaran</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.verifikasi.setujui', $user) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="role" class="form-label fw-semibold">Tetapkan Role <span class="text-danger">*</span></label>
                        <select name="role" id="role" class="form-select @error('role') is-invalid @enderror" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="WARGA" {{ old('role') === 'WARGA' ? 'selected' : '' }}>WARGA</option>
                        </select>
                        @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="catatan_setuju" class="form-label fw-semibold">Catatan (opsional)</label>
                        <textarea name="catatan" id="catatan_setuju" class="form-control" rows="2" maxlength="500" placeholder="Catatan verifikasi..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-success w-100">
                        <i class="bi bi-check-lg me-2"></i>Setujui Akun Ini
                    </button>
                </form>
            </div>
        </div>

        <!-- Form Tolak -->
        <div class="card">
            <div class="card-header bg-danger text-white">
                <h6 class="mb-0"><i class="bi bi-x-circle me-2"></i>Tolak Pendaftaran</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.verifikasi.tolak', $user) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="catatan_tolak" class="form-label fw-semibold">Alasan Penolakan <span class="text-danger">*</span></label>
                        <textarea name="catatan" id="catatan_tolak" class="form-control @error('catatan') is-invalid @enderror"
                            rows="3" maxlength="500"
                            placeholder="Jelaskan alasan penolakan..."
                            required>{{ old('catatan') }}</textarea>
                        @error('catatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-danger w-100"
                        onclick="return confirm('Yakin ingin menolak akun ini?')">
                        <i class="bi bi-x-lg me-2"></i>Tolak Akun Ini
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('admin.verifikasi.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection
