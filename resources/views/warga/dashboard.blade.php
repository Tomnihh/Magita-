@extends('layouts.app')

@section('title', 'Dashboard Warga')
@section('page-title', 'Dashboard Warga')

@section('content')

{{-- Sambutan --}}
<div class="card mb-4" style="background: linear-gradient(135deg, #1a3a5c, #2e7d32); color: #fff; border:none">
    <div class="card-body py-4">
        <h5 class="fw-bold">Selamat datang, {{ Auth::user()->nama_lengkap }}!</h5>
        <p class="mb-3 opacity-75">
            Laporkan dugaan penyimpangan dana desa secara aman melalui portal MAGITA.
            Identitas Anda dapat dijaga kerahasiaannya.
        </p>
        <a href="{{ route('warga.laporan.create') }}" class="btn btn-light fw-semibold">
            <i class="bi bi-megaphone me-2"></i>Buat Laporan Baru
        </a>
    </div>
</div>

{{-- Info singkat --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card text-center h-100">
            <div class="card-body py-4">
                <i class="bi bi-send-fill fs-2 text-primary mb-2"></i>
                <div class="fw-semibold">Kirim Laporan</div>
                <div class="text-muted small">Laporkan penyimpangan dana desa di wilayah Anda</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center h-100">
            <div class="card-body py-4">
                <i class="bi bi-shield-lock-fill fs-2 text-success mb-2"></i>
                <div class="fw-semibold">Terjamin Aman</div>
                <div class="text-muted small">Pilihan anonim tersedia untuk melindungi identitas Anda</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center h-100">
            <div class="card-body py-4">
                <i class="bi bi-search fs-2 text-info mb-2"></i>
                <div class="fw-semibold">Pantau Status</div>
                <div class="text-muted small">
                    Gunakan kode laporan untuk cek status di
                    <a href="{{ route('cek-laporan') }}" target="_blank">halaman publik</a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Laporan Saya --}}
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0">
            <i class="bi bi-list-check me-2 text-success"></i>Laporan Saya
        </h6>
        <a href="{{ route('warga.laporan.create') }}" class="btn btn-sm btn-success">
            <i class="bi bi-plus-lg me-1"></i>Buat Laporan
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-sm mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Judul</th>
                        <th>Desa</th>
                        <th>Bukti</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporanSaya as $lap)
                        <tr>
                            <td><code class="small">{{ $lap->kode_laporan }}</code></td>
                            <td class="small">{{ Str::limit($lap->judul_laporan, 30) }}</td>
                            <td class="small">{{ optional($lap->desa)->nama_desa }}</td>
                            <td class="text-center">
                                @if($lap->buktis_count > 0)
                                    <span class="badge bg-info">
                                        <i class="bi bi-camera me-1"></i>{{ $lap->buktis_count }}
                                    </span>
                                @else
                                    <span class="text-muted small">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $lap->status_color }}">{{ $lap->status }}</span>
                            </td>
                            <td class="small text-muted">{{ $lap->created_at->format('d/m/Y') }}</td>
                            <td>
                                @if(! $lap->is_anonim)
                                    <a href="{{ route('warga.laporan.show', $lap) }}"
                                       class="btn btn-xs btn-outline-primary"
                                       style="font-size:.72rem;padding:.15rem .45rem">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                <i class="bi bi-inbox d-block mb-1 fs-3"></i>
                                Belum ada laporan.<br>
                                <a href="{{ route('warga.laporan.create') }}">Buat laporan pertama Anda</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($laporanSaya->hasPages())
        <div class="card-footer">{{ $laporanSaya->links() }}</div>
    @endif
</div>

@endsection
