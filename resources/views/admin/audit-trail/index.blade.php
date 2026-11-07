@extends('layouts.app')

@section('title', 'Audit Trail')
@section('page-title', 'Riwayat Audit Sistem')

@section('content')
<div class="card">
    <div class="card-header">
        <h6 class="mb-0"><i class="bi bi-journal-text me-2 text-secondary"></i>Log Aktivitas Sistem</h6>
    </div>

    <div class="card-body border-bottom">
        <form method="GET" class="row g-2">
            <div class="col-md-3">
                <select name="aksi" class="form-select form-select-sm">
                    <option value="">Semua Aksi</option>
                    @foreach($aksiList as $aksi)
                        <option value="{{ $aksi }}" {{ request('aksi') === $aksi ? 'selected' : '' }}>{{ $aksi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="date" name="tanggal_dari" class="form-control form-control-sm"
                    value="{{ request('tanggal_dari') }}" placeholder="Dari tanggal">
            </div>
            <div class="col-md-2">
                <input type="date" name="tanggal_sampai" class="form-control form-control-sm"
                    value="{{ request('tanggal_sampai') }}" placeholder="Sampai tanggal">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-sm btn-outline-primary me-1">
                    <i class="bi bi-search me-1"></i>Filter
                </button>
                <a href="{{ route('admin.audit-trail.index') }}" class="btn btn-sm btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-sm mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Waktu</th>
                        <th>Pengguna</th>
                        <th>Aksi</th>
                        <th>Model</th>
                        <th>IP Address</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($auditTrails as $log)
                        <tr>
                            <td class="small text-muted" style="white-space:nowrap">{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                            <td class="small">{{ optional($log->user)->nama_lengkap ?? '<em class="text-muted">Sistem</em>' }}</td>
                            <td>
                                @php
                                    $aksiColor = match(true) {
                                        str_contains($log->aksi, 'LOGIN') => 'info',
                                        str_contains($log->aksi, 'HAPUS') => 'danger',
                                        str_contains($log->aksi, 'BUAT') => 'success',
                                        str_contains($log->aksi, 'UPDATE') => 'warning',
                                        str_contains($log->aksi, 'VERIFIKASI') => 'primary',
                                        default => 'secondary'
                                    };
                                @endphp
                                <span class="badge bg-{{ $aksiColor }} small">{{ $log->aksi }}</span>
                            </td>
                            <td class="small text-muted">
                                @if($log->model_type)
                                    {{ class_basename($log->model_type) }} #{{ $log->model_id }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="small text-muted">{{ $log->ip_address ?? '-' }}</td>
                            <td class="small">{{ Str::limit($log->keterangan, 50) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Tidak ada log audit</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($auditTrails->hasPages())
        <div class="card-footer">{{ $auditTrails->links() }}</div>
    @endif
</div>
@endsection
