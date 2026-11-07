<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status Laporan — MAGITA Inspektorat Kabupaten Sumbawa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1a3a5c 0%, #1e4976 60%, #2e7d32 100%);
            min-height: 100vh;
            padding: 2rem 0;
        }
        .card { border: none; border-radius: 1rem; box-shadow: 0 .5rem 2rem rgba(0,0,0,.15); }
        .status-timeline { position: relative; padding-left: 2rem; }
        .status-timeline::before {
            content: '';
            position: absolute;
            left: .6rem;
            top: .5rem;
            bottom: .5rem;
            width: 2px;
            background: #dee2e6;
        }
        .timeline-item { position: relative; margin-bottom: 1.25rem; }
        .timeline-dot {
            position: absolute;
            left: -1.65rem;
            top: .25rem;
            width: 1.1rem;
            height: 1.1rem;
            border-radius: 50%;
            border: 2px solid #dee2e6;
            background: #fff;
        }
        .timeline-dot.aktif { background: #1a3a5c; border-color: #1a3a5c; }
        .timeline-dot.selesai { background: #198754; border-color: #198754; }
        .timeline-dot.ditolak { background: #dc3545; border-color: #dc3545; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">

            {{-- Header --}}
            <div class="text-center mb-4">
                <i class="bi bi-shield-check text-white" style="font-size:3rem"></i>
                <h4 class="text-white fw-bold mt-2 mb-0">Cek Status Laporan</h4>
                <p class="text-white-50 small">MAGITA — Inspektorat Kabupaten Sumbawa</p>
            </div>

            {{-- Form Pencarian --}}
            <div class="card mb-4">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('cek-laporan.cek') }}">
                        @csrf
                        <label class="form-label fw-semibold">Masukkan Kode Laporan</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input
                                type="text"
                                name="kode_laporan"
                                class="form-control text-uppercase font-monospace @error('kode_laporan') is-invalid @enderror"
                                placeholder="Contoh: LAP-ABC123XYZ"
                                value="{{ old('kode_laporan', $kode ?? '') }}"
                                style="letter-spacing:.05em"
                                autofocus
                                required
                            >
                            <button class="btn btn-primary" type="submit">Cek</button>
                            @error('kode_laporan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-text mt-1">
                            Kode laporan diterima saat Anda mengirim laporan melalui portal MAGITA.
                        </div>
                    </form>
                </div>
            </div>

            {{-- Hasil Pencarian --}}
            @if(isset($kode))
                @if(isset($pelaporan) && $pelaporan)
                    {{-- Ditemukan --}}
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fw-bold">
                                <i class="bi bi-file-earmark-text me-2"></i>Detail Laporan
                            </h6>
                            <span class="badge fs-6
                                @if($pelaporan->status === 'BARU') bg-primary
                                @elseif($pelaporan->status === 'DIPROSES') bg-warning text-dark
                                @elseif($pelaporan->status === 'SELESAI') bg-success
                                @else bg-danger
                                @endif">
                                {{ $pelaporan->status }}
                            </span>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless table-sm mb-0">
                                <tr>
                                    <td class="text-muted small fw-semibold" style="width:42%">Kode Laporan</td>
                                    <td><code class="fw-bold">{{ $pelaporan->kode_laporan }}</code></td>
                                </tr>
                                <tr>
                                    <td class="text-muted small fw-semibold">Desa / Kelurahan</td>
                                    <td>{{ optional($pelaporan->desa)->nama_desa }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted small fw-semibold">Kecamatan</td>
                                    <td>{{ optional($pelaporan->desa)->kecamatan }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted small fw-semibold">Judul</td>
                                    <td>{{ $pelaporan->judul_laporan }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted small fw-semibold">Kategori</td>
                                    <td>{{ str_replace('_', ' ', $pelaporan->kategori) }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted small fw-semibold">Tanggal Lapor</td>
                                    <td>{{ $pelaporan->created_at->format('d F Y, H:i') }} WIB</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    {{-- Timeline Status --}}
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="mb-0"><i class="bi bi-clock-history me-2 text-primary"></i>Perjalanan Laporan</h6>
                        </div>
                        <div class="card-body">
                            <div class="status-timeline">
                                {{-- Step 1: Diterima --}}
                                <div class="timeline-item">
                                    <div class="timeline-dot selesai"></div>
                                    <div class="d-flex justify-content-between">
                                        <span class="fw-semibold small">✅ Laporan Diterima</span>
                                        <span class="text-muted small">{{ $pelaporan->created_at->format('d/m/Y H:i') }}</span>
                                    </div>
                                    <p class="text-muted mb-0" style="font-size:.8rem">
                                        Laporan tercatat di sistem dengan kode <code>{{ $pelaporan->kode_laporan }}</code>
                                    </p>
                                </div>

                                {{-- Step 2: Diproses --}}
                                <div class="timeline-item">
                                    <div class="timeline-dot {{ in_array($pelaporan->status, ['DIPROSES','SELESAI','DITOLAK']) ? 'aktif' : '' }}"></div>
                                    <div class="fw-semibold small
                                        {{ in_array($pelaporan->status, ['DIPROSES','SELESAI','DITOLAK']) ? '' : 'text-muted' }}">
                                        @if(in_array($pelaporan->status, ['DIPROSES','SELESAI','DITOLAK']))
                                            🔵 Sedang Diproses
                                        @else
                                            ⭕ Menunggu Proses
                                        @endif
                                    </div>
                                    <p class="text-muted mb-0" style="font-size:.8rem">
                                        Petugas Inspektorat sedang menindaklanjuti laporan
                                    </p>
                                </div>

                                {{-- Step 3: Selesai / Ditolak --}}
                                <div class="timeline-item">
                                    @if($pelaporan->status === 'SELESAI')
                                        <div class="timeline-dot selesai"></div>
                                        <div class="fw-semibold small">✅ Laporan Selesai Ditangani</div>
                                    @elseif($pelaporan->status === 'DITOLAK')
                                        <div class="timeline-dot ditolak"></div>
                                        <div class="fw-semibold small text-danger">❌ Laporan Ditolak</div>
                                    @else
                                        <div class="timeline-dot"></div>
                                        <div class="fw-semibold small text-muted">⭕ Penyelesaian</div>
                                    @endif

                                    @if($pelaporan->tindak_lanjut)
                                        <div class="mt-2 p-2 rounded" style="background:#f8f9fa; border-left:3px solid #1a3a5c">
                                            <div class="small fw-semibold text-primary mb-1">Keterangan dari Inspektorat:</div>
                                            <p class="mb-0 small">{!! nl2br(e($pelaporan->tindak_lanjut)) !!}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                @else
                    {{-- Tidak Ditemukan --}}
                    <div class="card text-center">
                        <div class="card-body py-5">
                            <i class="bi bi-search text-muted" style="font-size:3rem"></i>
                            <h5 class="mt-3 fw-bold">Laporan Tidak Ditemukan</h5>
                            <p class="text-muted">
                                Kode <code class="fw-bold">{{ $kode }}</code> tidak terdaftar dalam sistem.
                            </p>
                            <p class="text-muted small">
                                Pastikan kode yang Anda masukkan benar. Kode bersifat huruf kapital, contoh: <code>LAP-ABC123XYZ</code>
                            </p>
                        </div>
                    </div>
                @endif
            @endif

            {{-- Footer link --}}
            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="text-white-50 small text-decoration-none">
                    <i class="bi bi-arrow-left me-1"></i>Kembali ke Portal MAGITA
                </a>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
