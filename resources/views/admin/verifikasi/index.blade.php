@extends('layouts.app')

@section('title', 'Verifikasi Akun')
@section('page-title', 'Verifikasi Akun Pendaftar')

@section('content')
<div class="row g-3">
    <!-- Akun Pending -->
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">
                    <i class="bi bi-person-clock me-2 text-warning"></i>
                    Menunggu Verifikasi
                    @if($akunPending->total() > 0)
                        <span class="badge bg-warning text-dark ms-1">{{ $akunPending->total() }}</span>
                    @endif
                </h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nama Lengkap</th>
                                <th>NIK</th>
                                <th>Email</th>
                                <th>WhatsApp</th>
                                <th>Foto KTP</th>
                                <th>Terdaftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($akunPending as $akun)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="fw-semibold">{{ $akun->nama_lengkap }}</td>
                                    <td><code>{{ $akun->nik }}</code></td>
                                    <td>{{ $akun->email ?? '-' }}</td>
                                    <td>{{ $akun->no_whatsapp }}</td>
                                    <td>
                                        @if($akun->foto_ktp_url)
                                            <a href="{{ Storage::url($akun->foto_ktp_url) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                                <i class="bi bi-image me-1"></i>Lihat
                                            </a>
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                    <td class="small text-muted">{{ $akun->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('admin.verifikasi.show', $akun) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye me-1"></i>Verifikasi
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        <i class="bi bi-check-circle fs-3 text-success d-block mb-1"></i>
                                        Tidak ada akun yang menunggu verifikasi
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($akunPending->hasPages())
                <div class="card-footer">{{ $akunPending->links() }}</div>
            @endif
        </div>
    </div>

    <!-- Riwayat Verifikasi -->
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-clock-history me-2 text-secondary"></i>Riwayat Verifikasi</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 table-sm">
                        <thead class="table-light">
                            <tr>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Catatan</th>
                                <th>Diverifikasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($akunDiverifikasi as $akun)
                                <tr>
                                    <td class="fw-semibold small">{{ $akun->nama_lengkap }}</td>
                                    <td class="small"><code>{{ $akun->nik }}</code></td>
                                    <td class="small">{{ $akun->role }}</td>
                                    <td>
                                        <span class="badge bg-{{ $akun->status_akun === 'AKTIF' ? 'success' : 'danger' }}">
                                            {{ $akun->status_akun }}
                                        </span>
                                    </td>
                                    <td class="small text-muted">{{ Str::limit($akun->catatan_verifikasi, 40) }}</td>
                                    <td class="small text-muted">{{ optional($akun->verified_at)->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="text-center text-muted small">Belum ada riwayat</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
