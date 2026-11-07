<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Dana Desa — MAGITA</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 9px; color: #222; }

        /* Header */
        .header { border-bottom: 2px solid #1a3a5c; padding-bottom: 10px; margin-bottom: 12px; }
        .header-table { width: 100%; }
        .header-logo-cell { width: 70px; vertical-align: middle; }
        .header-logo {
            width: 56px; height: 56px;
            background: #1a3a5c;
            border-radius: 50%;
            text-align: center;
            line-height: 56px;
            font-size: 22px;
            color: #fff;
            font-weight: 700;
        }
        .header-title-cell { vertical-align: middle; padding-left: 10px; }
        .header-title-cell h1 { font-size: 14px; color: #1a3a5c; font-weight: 700; margin-bottom: 2px; }
        .header-title-cell p { font-size: 8px; color: #555; margin: 1px 0; }
        .header-meta-cell { vertical-align: top; text-align: right; font-size: 7.5px; color: #666; }

        /* Filter Info */
        .filter-box {
            background: #f0f4ff;
            border: 1px solid #c5d2f7;
            border-radius: 4px;
            padding: 6px 10px;
            margin-bottom: 10px;
            font-size: 8px;
        }
        .filter-box strong { color: #1a3a5c; }

        /* Stats */
        .stats-table { width: 100%; margin-bottom: 12px; border-collapse: collapse; }
        .stats-table td {
            padding: 6px 8px;
            text-align: center;
            border: 1px solid #dee2e6;
            border-radius: 4px;
        }
        .stats-table .stat-num { font-size: 16px; font-weight: 700; }
        .stats-table .stat-label { font-size: 7px; color: #666; }
        .stat-biru .stat-num { color: #1a3a5c; }
        .stat-warning .stat-num { color: #e65100; }
        .stat-success .stat-num { color: #1b5e20; }
        .stat-danger .stat-num { color: #b71c1c; }

        /* Tabel utama */
        table.laporan-table { width: 100%; border-collapse: collapse; }
        table.laporan-table thead tr {
            background: #1a3a5c;
            color: #fff;
        }
        table.laporan-table th {
            padding: 5px 6px;
            font-size: 8px;
            font-weight: 700;
            text-align: left;
            border: 1px solid #1a3a5c;
        }
        table.laporan-table td {
            padding: 5px 6px;
            font-size: 8px;
            border: 1px solid #dee2e6;
            vertical-align: top;
        }
        table.laporan-table tr:nth-child(even) td { background: #f8f9fa; }
        table.laporan-table tr:hover td { background: #e8edf7; }

        /* Badge status */
        .badge { padding: 2px 5px; border-radius: 3px; font-size: 7px; font-weight: 700; color: #fff; }
        .badge-baru { background: #0d6efd; }
        .badge-diproses { background: #e65100; color: #fff; }
        .badge-selesai { background: #1b5e20; }
        .badge-ditolak { background: #b71c1c; }

        /* Risiko */
        .risiko { padding: 2px 5px; border-radius: 3px; font-size: 7px; font-weight: 700; }
        .risiko-HIJAU { background: #c8e6c9; color: #1b5e20; }
        .risiko-KUNING { background: #fff9c4; color: #f57f17; }
        .risiko-MERAH { background: #ffcdd2; color: #b71c1c; }

        /* Anonim */
        .anonim { color: #9e9e9e; font-style: italic; font-size: 7.5px; }

        /* Footer */
        .footer {
            margin-top: 15px;
            padding-top: 8px;
            border-top: 1px solid #dee2e6;
            font-size: 7.5px;
            color: #888;
            text-align: center;
        }

        /* Page break */
        .page-break { page-break-after: always; }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <div class="header">
        <table class="header-table">
            <tr>
                <td class="header-logo-cell">
                    <div class="header-logo">S</div>
                </td>
                <td class="header-title-cell">
                    <h1>REKAPITULASI LAPORAN PENGADUAN DANA DESA</h1>
                    <p>MAGITA — Sistem Pengawasan Dana Desa</p>
                    <p>Inspektorat Kabupaten Sumbawa, Nusa Tenggara Barat</p>
                </td>
                <td class="header-meta-cell">
                    <p>Tanggal cetak:</p>
                    <p><strong>{{ $generatedAt->format('d F Y') }}</strong></p>
                    <p>{{ $generatedAt->format('H:i') }} WIB</p>
                    <p style="margin-top:4px">Dicetak oleh:</p>
                    <p><strong>{{ $generatedBy }}</strong></p>
                </td>
            </tr>
        </table>
    </div>

    {{-- FILTER INFO --}}
    <div class="filter-box">
        <strong>Filter:</strong> {{ $filterInfo }} &nbsp;|&nbsp;
        <strong>Total Laporan:</strong> {{ $pelaporans->count() }}
    </div>

    {{-- STATISTIK --}}
    @php
        $totalBaru    = $pelaporans->where('status', 'BARU')->count();
        $totalProses  = $pelaporans->where('status', 'DIPROSES')->count();
        $totalSelesai = $pelaporans->where('status', 'SELESAI')->count();
        $totalDitolak = $pelaporans->where('status', 'DITOLAK')->count();
    @endphp
    <table class="stats-table">
        <tr>
            <td class="stat-biru">
                <div class="stat-num">{{ $pelaporans->count() }}</div>
                <div class="stat-label">TOTAL LAPORAN</div>
            </td>
            <td class="stat-warning">
                <div class="stat-num">{{ $totalBaru }}</div>
                <div class="stat-label">BARU</div>
            </td>
            <td style="color:#1565c0">
                <div class="stat-num" style="color:#1565c0">{{ $totalProses }}</div>
                <div class="stat-label">DIPROSES</div>
            </td>
            <td class="stat-success">
                <div class="stat-num">{{ $totalSelesai }}</div>
                <div class="stat-label">SELESAI</div>
            </td>
            <td class="stat-danger">
                <div class="stat-num">{{ $totalDitolak }}</div>
                <div class="stat-label">DITOLAK</div>
            </td>
        </tr>
    </table>

    {{-- TABEL LAPORAN --}}
    <table class="laporan-table">
        <thead>
            <tr>
                <th style="width:3%">#</th>
                <th style="width:13%">Kode Laporan</th>
                <th style="width:10%">Tanggal</th>
                <th style="width:12%">Desa</th>
                <th style="width:9%">Kecamatan</th>
                <th style="width:22%">Judul Laporan</th>
                <th style="width:11%">Kategori</th>
                <th style="width:7%">Risiko Desa</th>
                <th style="width:8%">Pelapor</th>
                <th style="width:5%">Kanal</th>
                <th style="width:8%">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pelaporans as $i => $lap)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><strong>{{ $lap->kode_laporan }}</strong></td>
                    <td>{{ $lap->created_at->format('d/m/Y') }}<br>
                        <span style="color:#888">{{ $lap->created_at->format('H:i') }}</span></td>
                    <td>{{ optional($lap->desa)->nama_desa ?? '-' }}</td>
                    <td>{{ optional($lap->desa)->kecamatan ?? '-' }}</td>
                    <td>{{ $lap->judul_laporan }}</td>
                    <td>{{ str_replace('_', ' ', $lap->kategori) }}</td>
                    <td>
                        @php $risiko = optional($lap->desa)->status_risiko ?? 'HIJAU'; @endphp
                        <span class="risiko risiko-{{ $risiko }}">{{ $risiko }}</span>
                    </td>
                    <td>
                        @if($lap->is_anonim)
                            <span class="anonim">Anonim</span>
                        @else
                            {{ optional($lap->pelapor)->nama_lengkap ?? '-' }}
                        @endif
                    </td>
                    <td>{{ $lap->kanal }}</td>
                    <td>
                        <span class="badge badge-{{ strtolower($lap->status) }}">{{ $lap->status }}</span>
                    </td>
                </tr>
                @if($lap->tindak_lanjut)
                    <tr>
                        <td colspan="11" style="background:#f0fff4; color:#1b5e20; font-size:7.5px; padding: 3px 6px;">
                            <strong>↳ Tindak Lanjut:</strong> {{ Str::limit($lap->tindak_lanjut, 200) }}
                        </td>
                    </tr>
                @endif
            @empty
                <tr>
                    <td colspan="11" style="text-align:center; padding:20px; color:#888">
                        Tidak ada data laporan untuk filter yang dipilih
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- FOOTER --}}
    <div class="footer">
        Dokumen ini digenerate secara otomatis oleh MAGITA — Sistem Pengawasan Dana Desa,
        Inspektorat Kabupaten Sumbawa &nbsp;|&nbsp;
        {{ $generatedAt->format('d F Y, H:i') }} WIB &nbsp;|&nbsp;
        Halaman ini bersifat resmi dan rahasia
    </div>

</body>
</html>
