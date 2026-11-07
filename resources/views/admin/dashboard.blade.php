@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Inspektorat')

@push('styles')
<style>
    #peta-sumbawa { height: 520px; border-radius: .5rem; }
</style>
@endpush

@section('content')

{{-- ── STAT CARDS ─────────────────────────────────────────────────────────── --}}
<div class="row g-3 mb-3">
    <div class="col-6 col-md-3">
        <div class="card stat-card biru h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small">Total Desa</div>
                        <div class="fs-3 fw-bold">{{ $stats['total_desa'] }}</div>
                    </div>
                    <i class="bi bi-geo-alt-fill fs-2 text-primary opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card merah h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small">Desa Laporan Tinggi</div>
                        <div class="fs-3 fw-bold text-danger">{{ $stats['desa_risiko_merah'] }}</div>
                    </div>
                    <i class="bi bi-exclamation-triangle-fill fs-2 text-danger opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card kuning h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small">Total Laporan</div>
                        <div class="fs-3 fw-bold text-warning">{{ $stats['total_laporan'] }}</div>
                    </div>
                    <i class="bi bi-flag-fill fs-2 text-warning opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card hijau h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="text-muted small">Laporan Baru</div>
                        <div class="fs-3 fw-bold text-success">{{ $stats['laporan_baru'] }}</div>
                    </div>
                    <i class="bi bi-bell-fill fs-2 text-success opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── KETERANGAN WARNA RISIKO ─────────────────────────────────────────────── --}}
<div class="alert alert-light border small py-2 mb-3 d-flex align-items-center gap-3 flex-wrap">
    <i class="bi bi-info-circle text-primary"></i>
    <span>Warna marker peta ditentukan dari <strong>jumlah laporan masuk</strong>:</span>
    <span class="badge badge-risiko-HIJAU">Hijau = 0–1 laporan</span>
    <span class="badge badge-risiko-KUNING">Kuning = 2–4 laporan</span>
    <span class="badge badge-risiko-MERAH">Merah = ≥5 laporan</span>
</div>

{{-- ── PETA FULL WIDTH ─────────────────────────────────────────────────────── --}}
<div class="card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0">
            <i class="bi bi-map me-2 text-primary"></i>Peta Sebaran Laporan Desa Kabupaten Sumbawa
        </h6>
        <div class="text-muted small">Klik marker untuk detail</div>
    </div>
    <div class="card-body p-2">
        <div id="peta-sumbawa"></div>
    </div>
</div>

{{-- ── DESA RISIKO TINGGI ──────────────────────────────────────────────────── --}}
<div class="card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="mb-0">
            <i class="bi bi-exclamation-triangle me-2 text-warning"></i>Desa dengan Laporan Terbanyak
        </h6>
        <a href="{{ route('admin.laporan.index') }}" class="btn btn-sm btn-outline-danger">
            <i class="bi bi-flag me-1"></i>Lihat Semua Laporan
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Desa</th>
                        <th>Kecamatan</th>
                        <th>Jumlah Laporan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($desaRisiko as $i => $desa)
                        <tr>
                            <td class="text-muted small">{{ $i + 1 }}</td>
                            <td class="fw-semibold">{{ $desa->nama_desa }}</td>
                            <td class="text-muted small">{{ $desa->kecamatan }}</td>
                            <td>
                                @php $maxLap = $desaRisiko->max('pelaporans_count') ?: 1; @endphp
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress flex-grow-1" style="height:6px;max-width:80px">
                                        <div class="progress-bar bg-{{ $desa->risiko_color }}"
                                            style="width:{{ ($desa->pelaporans_count / $maxLap) * 100 }}%"></div>
                                    </div>
                                    <span class="fw-bold text-{{ $desa->risiko_color }}">
                                        {{ $desa->pelaporans_count }}
                                    </span>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-risiko-{{ $desa->status_risiko }}">
                                    {{ $desa->status_risiko }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.laporan.index', ['kecamatan' => $desa->kecamatan]) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye me-1"></i>Laporan
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="bi bi-check-circle fs-3 text-success d-block mb-1"></i>
                                Belum ada desa dengan laporan masuk
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ── RINGKASAN LAPORAN ────────────────────────────────────────────────────── --}}
<div class="card">
    <div class="card-body py-3">
        <div class="row text-center g-0">
            <div class="col-md-4 border-end">
                <div class="text-muted small mb-1">Total Laporan Masuk</div>
                <div class="fs-3 fw-bold text-primary">{{ $stats['total_laporan'] }}</div>
                <div class="text-muted" style="font-size:.75rem">Semua laporan diterima</div>
            </div>
            <div class="col-md-4 border-end">
                <div class="text-muted small mb-1">Sedang Diproses</div>
                <div class="fs-3 fw-bold text-warning">{{ $stats['laporan_diproses'] }}</div>
                <div class="text-muted" style="font-size:.75rem">Dalam penanganan Inspektorat</div>
            </div>
            <div class="col-md-4">
                <div class="text-muted small mb-1">Selesai Ditangani</div>
                <div class="fs-3 fw-bold text-success">{{ $stats['laporan_selesai'] }}</div>
                @php
                    $pct = $stats['total_laporan'] > 0
                        ? round(($stats['laporan_selesai'] / $stats['total_laporan']) * 100, 1)
                        : 0;
                @endphp
                <div class="text-muted" style="font-size:.75rem">{{ $pct }}% dari total laporan</div>
                <div class="progress mt-1 mx-auto" style="height:5px;max-width:120px">
                    <div class="progress-bar bg-success" style="width:{{ $pct }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const peta = L.map('peta-sumbawa').setView([-8.4950, 117.4150], 9);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(peta);

    const warnaMarker = { 'HIJAU': '#198754', 'KUNING': '#ffc107', 'MERAH': '#dc3545' };
    const desaData = @json($desaMapData);

    desaData.forEach(function(desa) {
        const warna  = warnaMarker[desa.status_risiko] || '#6c757d';
        const radius = desa.pelaporans_count > 0 ? Math.min(6 + desa.pelaporans_count * 1.5, 18) : 7;

        const marker = L.circleMarker([desa.latitude, desa.longitude], {
            radius      : radius,
            fillColor   : warna,
            color       : '#fff',
            weight      : 2,
            opacity     : 1,
            fillOpacity : 0.85
        }).addTo(peta);

        const jmlLaporan = desa.pelaporans_count || 0;
        const badgeStyle = `background:${warna};color:${desa.status_risiko==='KUNING'?'#000':'#fff'}`;

        marker.bindPopup(`
            <div style="min-width:180px">
                <strong>${desa.nama_desa}</strong><br>
                <small style="color:#666">Kec. ${desa.kecamatan}</small>
                <hr style="margin:.4rem 0">
                <span style="display:inline-block;padding:2px 8px;border-radius:4px;font-size:.75rem;font-weight:700;${badgeStyle}">${desa.status_risiko}</span>
                <br><small><b>Jumlah laporan:</b> ${jmlLaporan}</small>
            </div>
        `);
    });
</script>
@endpush
