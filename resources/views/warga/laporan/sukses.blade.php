@extends('layouts.app')

@section('title', 'Laporan Berhasil Dikirim')
@section('page-title', 'Laporan Berhasil Dikirim')

@section('content')
<div class="d-flex justify-content-center">
    <div style="max-width: 620px; width: 100%">

        {{-- Banner Sukses --}}
        <div class="card border-0 mb-4" style="background: linear-gradient(135deg, #1a3a5c, #2e7d32)">
            <div class="card-body text-center py-5 text-white">
                <div class="mb-3">
                    <i class="bi bi-check-circle-fill" style="font-size: 4rem; color: #81c784"></i>
                </div>
                <h4 class="fw-bold mb-1">Laporan Berhasil Dikirim!</h4>
                <p class="mb-0 opacity-75">Inspektorat Kabupaten Sumbawa telah menerima laporan Anda</p>
            </div>
        </div>

        {{-- Kode Laporan --}}
        <div class="card mb-4">
            <div class="card-body text-center py-4">
                <p class="text-muted mb-2 small">KODE LAPORAN ANDA</p>
                <div class="d-inline-block px-4 py-3 rounded-3 mb-3"
                    style="background:#f0f4ff; border: 2px dashed #1a3a5c">
                    <span class="fw-bold fs-3 text-primary font-monospace tracking-wide">
                        {{ $pelaporan->kode_laporan }}
                    </span>
                </div>
                <div class="d-flex justify-content-center gap-2">
                    <button onclick="copyKode()" class="btn btn-outline-primary btn-sm" id="btnCopy">
                        <i class="bi bi-clipboard me-1"></i>Salin Kode
                    </button>
                </div>
                <p class="text-muted mt-3 mb-0" style="font-size:.82rem">
                    <i class="bi bi-exclamation-triangle-fill text-warning me-1"></i>
                    <strong>Simpan kode ini!</strong> Gunakan untuk mengecek status laporan Anda kapan saja.
                </p>
            </div>
        </div>

        {{-- Info Laporan --}}
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-info-circle me-2 text-primary"></i>Ringkasan Laporan</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm mb-0">
                    <tr>
                        <td class="text-muted small fw-semibold" style="width:40%">Desa / Kelurahan</td>
                        <td class="fw-semibold">{{ optional($pelaporan->desa)->nama_desa }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small fw-semibold">Kecamatan</td>
                        <td>{{ optional($pelaporan->desa)->kecamatan }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small fw-semibold">Judul Laporan</td>
                        <td>{{ $pelaporan->judul_laporan }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small fw-semibold">Kategori</td>
                        <td>{{ str_replace('_', ' ', $pelaporan->kategori) }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small fw-semibold">Status</td>
                        <td>
                            <span class="badge bg-primary">{{ $pelaporan->status }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted small fw-semibold">Tanggal Kirim</td>
                        <td>{{ $pelaporan->created_at->format('d F Y, H:i') }} WIB</td>
                    </tr>
                    <tr>
                        <td class="text-muted small fw-semibold">Mode</td>
                        <td>
                            @if($pelaporan->is_anonim)
                                <span class="badge bg-dark"><i class="bi bi-incognito me-1"></i>Anonim</span>
                            @else
                                <span class="badge bg-secondary"><i class="bi bi-person me-1"></i>Teridentifikasi</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Timeline Status --}}
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-diagram-3 me-2 text-success"></i>Alur Proses Laporan</h6>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-start gap-3 mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                        style="width:36px;height:36px;background:#1a3a5c;color:#fff;font-weight:700">1</div>
                    <div>
                        <div class="fw-semibold">Laporan Diterima <span class="badge bg-success ms-1">✓ Selesai</span></div>
                        <small class="text-muted">Laporan Anda telah masuk ke sistem dan tercatat dengan kode unik</small>
                    </div>
                </div>
                <div class="d-flex align-items-start gap-3 mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                        style="width:36px;height:36px;background:#e9ecef;color:#6c757d;font-weight:700">2</div>
                    <div>
                        <div class="fw-semibold text-muted">Verifikasi & Penelaahan</div>
                        <small class="text-muted">Petugas Inspektorat melakukan verifikasi awal terhadap laporan</small>
                    </div>
                </div>
                <div class="d-flex align-items-start gap-3 mb-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                        style="width:36px;height:36px;background:#e9ecef;color:#6c757d;font-weight:700">3</div>
                    <div>
                        <div class="fw-semibold text-muted">Tindak Lanjut</div>
                        <small class="text-muted">Petugas mengambil langkah penanganan sesuai prosedur</small>
                    </div>
                </div>
                <div class="d-flex align-items-start gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                        style="width:36px;height:36px;background:#e9ecef;color:#6c757d;font-weight:700">4</div>
                    <div>
                        <div class="fw-semibold text-muted">Penyelesaian</div>
                        <small class="text-muted">Laporan ditandai selesai dan hasilnya dapat dilihat publik</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Cara cek status --}}
        <div class="alert alert-info d-flex gap-3 align-items-start mb-4">
            <i class="bi bi-search fs-4 flex-shrink-0 mt-1"></i>
            <div>
                <div class="fw-semibold mb-1">Cara mengecek status laporan Anda:</div>
                <ol class="mb-2 ps-3 small">
                    <li>Kunjungi halaman <strong>Cek Status Laporan</strong></li>
                    <li>Masukkan kode: <code class="fw-bold">{{ $pelaporan->kode_laporan }}</code></li>
                    <li>Status terkini akan ditampilkan</li>
                </ol>
                <a href="{{ route('cek-laporan') }}" class="btn btn-sm btn-info text-white" target="_blank">
                    <i class="bi bi-search me-1"></i>Cek Status Laporan
                </a>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('warga.laporan.create') }}" class="btn btn-outline-primary">
                <i class="bi bi-plus-lg me-1"></i>Buat Laporan Lain
            </a>
            <a href="{{ route('warga.dashboard') }}" class="btn btn-outline-secondary">
                <i class="bi bi-house me-1"></i>Kembali ke Dashboard
            </a>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    function copyKode() {
        const kode = '{{ $pelaporan->kode_laporan }}';
        navigator.clipboard.writeText(kode).then(() => {
            const btn = document.getElementById('btnCopy');
            btn.innerHTML = '<i class="bi bi-check2 me-1"></i>Tersalin!';
            btn.classList.replace('btn-outline-primary', 'btn-success');
            setTimeout(() => {
                btn.innerHTML = '<i class="bi bi-clipboard me-1"></i>Salin Kode';
                btn.classList.replace('btn-success', 'btn-outline-primary');
            }, 2000);
        });
    }
</script>
@endpush
