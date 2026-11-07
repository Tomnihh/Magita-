@extends('layouts.app')

@section('title', 'Master Desa')
@section('page-title', 'Manajemen Master Desa')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h6 class="mb-0"><i class="bi bi-map me-2 text-primary"></i>Data Desa Kabupaten Sumbawa</h6>
    </div>

    <!-- Filter -->
    <div class="card-body border-bottom">
        <form method="GET" class="row g-2">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control form-control-sm"
                    placeholder="Cari nama desa..." value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="kecamatan" class="form-select form-select-sm">
                    <option value="">Semua Kecamatan</option>
                    @foreach($kecamatans as $kec)
                        <option value="{{ $kec }}" {{ request('kecamatan') === $kec ? 'selected' : '' }}>{{ $kec }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <select name="status_risiko" class="form-select form-select-sm">
                    <option value="">Semua Risiko</option>
                    <option value="HIJAU" {{ request('status_risiko') === 'HIJAU' ? 'selected' : '' }}>Hijau</option>
                    <option value="KUNING" {{ request('status_risiko') === 'KUNING' ? 'selected' : '' }}>Kuning</option>
                    <option value="MERAH" {{ request('status_risiko') === 'MERAH' ? 'selected' : '' }}>Merah</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-sm btn-outline-primary me-1">
                    <i class="bi bi-search me-1"></i>Filter
                </button>
                <a href="{{ route('admin.master-desa.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama Desa</th>
                        <th>Kecamatan</th>
                        <th>Pagu Anggaran</th>
                        <th>Realisasi</th>
                        <th>%</th>
                        <th>Risiko</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($desas as $desa)
                        <tr>
                            <td>{{ $desas->firstItem() + $loop->index }}</td>
                            <td>
                                <div class="fw-semibold">{{ $desa->nama_desa }}</div>
                                @if($desa->latitude && $desa->longitude)
                                    <div class="text-muted" style="font-size:.75rem">
                                        <i class="bi bi-geo text-success me-1"></i>{{ round($desa->latitude, 4) }}, {{ round($desa->longitude, 4) }}
                                    </div>
                                @else
                                    <div class="text-danger" style="font-size:.75rem">
                                        <i class="bi bi-geo-alt-fill me-1"></i>Koordinat belum diisi
                                    </div>
                                @endif
                            </td>
                            <td>{{ $desa->kecamatan }}</td>
                            <td class="small">{{ $desa->pagu_formatted }}</td>
                            <td class="small">{{ $desa->realisasi_formatted }}</td>
                            <td>
                                <div class="progress" style="height:6px;min-width:60px">
                                    <div class="progress-bar bg-{{ $desa->risiko_color }}"
                                        style="width:{{ min($desa->persentase_realisasi, 100) }}%"></div>
                                </div>
                                <small class="text-muted">{{ $desa->persentase_realisasi }}%</small>
                            </td>
                            <td>
                                <span class="badge badge-risiko-{{ $desa->status_risiko }}">{{ $desa->status_risiko }}</span>
                            </td>
                            <td>
                                    <a href="{{ route('admin.master-desa.edit', $desa) }}" class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>Tidak ada data desa
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($desas->hasPages())
        <div class="card-footer">{{ $desas->links() }}</div>
    @endif
</div>
@endsection
