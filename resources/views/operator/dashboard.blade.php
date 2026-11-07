@extends('layouts.app')

@section('title', 'Dashboard Operator')
@section('page-title', 'Dashboard Operator Desa')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card stat-card biru text-center">
            <div class="card-body">
                <i class="bi bi-geo-alt-fill fs-2 text-primary"></i>
                <div class="fs-3 fw-bold mt-1">{{ $stats['total_desa'] }}</div>
                <div class="text-muted small">Desa Kelolaan</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card kuning text-center">
            <div class="card-body">
                <i class="bi bi-flag-fill fs-2 text-warning"></i>
                <div class="fs-3 fw-bold mt-1">{{ $stats['laporan_baru'] }}</div>
                <div class="text-muted small">Laporan Baru</div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card hijau text-center">
            <div class="card-body">
                <i class="bi bi-clipboard-data fs-2 text-success"></i>
                <div class="fs-3 fw-bold mt-1">{{ $stats['total_laporan'] }}</div>
                <div class="text-muted small">Total Laporan</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-geo me-2 text-primary"></i>Desa Kelolaan</h6>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($desas as $desa)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-semibold">{{ $desa->nama_desa }}</div>
                                <small class="text-muted">{{ $desa->kecamatan }} · {{ $desa->pagu_formatted }}</small>
                            </div>
                            <span class="badge badge-risiko-{{ $desa->status_risiko }}">{{ $desa->status_risiko }}</span>
                        </li>
                    @empty
                        <li class="list-group-item text-muted small text-center py-3">Belum ada desa ditugaskan</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-flag me-2 text-danger"></i>Laporan Terbaru</h6>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($laporanTerbaru as $lap)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div class="small fw-semibold">{{ Str::limit($lap->judul_laporan, 40) }}</div>
                                    <small class="text-muted">{{ optional($lap->desa)->nama_desa }} · {{ $lap->created_at->diffForHumans() }}</small>
                                </div>
                                <span class="badge bg-{{ $lap->status_color }}">{{ $lap->status }}</span>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item text-muted small text-center py-3">Belum ada laporan</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
