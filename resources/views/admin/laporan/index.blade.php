@extends('layouts.app')

@section('title', 'Laporan Warga')
@section('page-title', 'Manajemen Laporan Warga')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h6 class="mb-0"><i class="bi bi-flag me-2 text-danger"></i>Daftar Laporan Masuk</h6>
        {{-- Tombol Export PDF --}}
        <a href="{{ route('admin.laporan.export-pdf', request()->query()) }}"
           class="btn btn-danger btn-sm"
           target="_blank">
            <i class="bi bi-file-earmark-pdf me-1"></i>Download PDF
        </a>
    </div>

    {{-- Filter --}}
    <div class="card-body border-bottom">
        <form method="GET" class="row g-2">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control form-control-sm"
                    placeholder="Cari kode atau judul..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    @foreach(['BARU', 'DIPROSES', 'SELESAI', 'DITOLAK'] as $s)
                        <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="kategori" class="form-select form-select-sm">
                    <option value="">Semua Kategori</option>
                    @foreach(['GRATIFIKASI', 'KORUPSI', 'PENYALAHGUNAAN', 'MARK_UP', 'LAINNYA'] as $k)
                        <option value="{{ $k }}" {{ request('kategori') === $k ? 'selected' : '' }}>
                            {{ str_replace('_', ' ', $k) }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="kecamatan" class="form-select form-select-sm">
                    <option value="">Semua Kecamatan</option>
                    @foreach($kecamatans as $kec)
                        <option value="{{ $kec }}" {{ request('kecamatan') === $kec ? 'selected' : '' }}>{{ $kec }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex gap-1">
                <button type="submit" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-funnel me-1"></i>Filter
                </button>
                <a href="{{ route('admin.laporan.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>

    {{-- Tabel --}}
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Judul</th>
                        <th>Desa</th>
                        <th>Kecamatan</th>
                        <th>Kategori</th>
                        <th>Kanal</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelaporans as $lap)
                        <tr>
                            <td><code class="small">{{ $lap->kode_laporan }}</code></td>
                            <td class="small">{{ Str::limit($lap->judul_laporan, 35) }}</td>
                            <td class="small">{{ optional($lap->desa)->nama_desa }}</td>
                            <td class="small text-muted">{{ optional($lap->desa)->kecamatan }}</td>
                            <td class="small">{{ str_replace('_', ' ', $lap->kategori) }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $lap->kanal }}</span>
                                @if($lap->is_anonim)
                                    <span class="badge bg-dark ms-1" title="Anonim">
                                        <i class="bi bi-incognito"></i>
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $lap->status_color }}">{{ $lap->status }}</span>
                            </td>
                            <td class="small text-muted" style="white-space:nowrap">
                                {{ $lap->created_at->format('d/m/Y') }}
                            </td>
                            <td>
                                <a href="{{ route('admin.laporan.show', $lap) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>Tidak ada laporan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($pelaporans->hasPages())
        <div class="card-footer">{{ $pelaporans->links() }}</div>
    @endif
</div>
@endsection
