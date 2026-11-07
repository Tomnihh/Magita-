@extends('layouts.app')

@section('title', 'Detail Laporan')
@section('page-title', 'Detail Laporan — ' . $pelaporan->kode_laporan)

@section('content')
<div class="card" style="max-width:760px">
    <div class="card-header d-flex justify-content-between">
        <h6 class="mb-0"><i class="bi bi-flag me-2 text-danger"></i>Detail Laporan Saya</h6>
        <span class="badge bg-{{ $pelaporan->status_color }} fs-6">{{ $pelaporan->status }}</span>
    </div>
    <div class="card-body">
        <table class="table table-borderless table-sm">
            <tr>
                <td class="text-muted small fw-semibold" style="width:35%">Kode Laporan</td>
                <td><code>{{ $pelaporan->kode_laporan }}</code></td>
            </tr>
            <tr>
                <td class="text-muted small fw-semibold">Desa</td>
                <td>{{ optional($pelaporan->desa)->nama_desa }}</td>
            </tr>
            <tr>
                <td class="text-muted small fw-semibold">Kategori</td>
                <td>{{ str_replace('_', ' ', $pelaporan->kategori) }}</td>
            </tr>
            <tr>
                <td class="text-muted small fw-semibold">Tanggal Lapor</td>
                <td>{{ $pelaporan->created_at->format('d F Y, H:i') }}</td>
            </tr>
        </table>

        <hr>
        <h6 class="fw-bold">{{ $pelaporan->judul_laporan }}</h6>
        <p class="text-break">{!! nl2br(e($pelaporan->isi_laporan)) !!}</p>

        @if($pelaporan->bukti_url)
            <a href="{{ Storage::url($pelaporan->bukti_url) }}" target="_blank" class="btn btn-sm btn-outline-secondary mb-3">
                <i class="bi bi-paperclip me-1"></i>Lihat Bukti
            </a>
        @endif

        @if($pelaporan->tindak_lanjut)
            <div class="alert alert-success">
                <h6 class="fw-semibold"><i class="bi bi-check-circle me-1"></i>Tindak Lanjut Inspektorat</h6>
                <p class="mb-0 small">{!! nl2br(e($pelaporan->tindak_lanjut)) !!}</p>
            </div>
        @else
            <div class="alert alert-info small">
                <i class="bi bi-clock me-1"></i>Laporan Anda sedang dalam proses peninjauan oleh Inspektorat.
            </div>
        @endif
    </div>
    <div class="card-footer">
        <a href="{{ route('warga.dashboard') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Kembali
        </a>
    </div>
</div>
@endsection
