@extends('layouts.app')

@section('title', 'Detail Laporan')
@section('page-title', 'Detail Laporan — ' . $pelaporan->kode_laporan)

@section('content')
<div class="row g-3">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-flag me-2 text-danger"></i>Isi Laporan</h6>
            </div>
            <div class="card-body">
                <div class="mb-3 d-flex gap-2 flex-wrap">
                    <span class="badge bg-{{ $pelaporan->status_color }} fs-6">{{ $pelaporan->status }}</span>
                    <span class="badge bg-secondary">{{ $pelaporan->kanal }}</span>
                    @if($pelaporan->is_anonim)
                        <span class="badge bg-dark"><i class="bi bi-incognito me-1"></i>Anonim</span>
                    @endif
                </div>

                <h5 class="fw-bold">{{ $pelaporan->judul_laporan }}</h5>

                <table class="table table-borderless table-sm mt-3">
                    <tr>
                        <td class="text-muted small fw-semibold" style="width:35%">Kode Laporan</td>
                        <td><code>{{ $pelaporan->kode_laporan }}</code></td>
                    </tr>
                    <tr>
                        <td class="text-muted small fw-semibold">Desa</td>
                        <td>{{ optional($pelaporan->desa)->nama_desa }} — {{ optional($pelaporan->desa)->kecamatan }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small fw-semibold">Kategori</td>
                        <td>{{ str_replace('_', ' ', $pelaporan->kategori) }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted small fw-semibold">Pelapor</td>
                        <td>
                            @if($pelaporan->is_anonim)
                                <em class="text-muted">Anonim</em>
                            @else
                                {{ optional($pelaporan->pelapor)->nama_lengkap ?? 'Tidak diketahui' }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-muted small fw-semibold">Tanggal</td>
                        <td>{{ $pelaporan->created_at->format('d F Y, H:i') }}</td>
                    </tr>
                </table>

                <hr>
                <h6 class="fw-semibold">Isi Laporan:</h6>
                <p class="text-break">{!! nl2br(e($pelaporan->isi_laporan)) !!}</p>

                @if($pelaporan->bukti_url)
                    <hr>
                    <h6 class="fw-semibold">Bukti Pendukung:</h6>
                    <a href="{{ Storage::url($pelaporan->bukti_url) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-paperclip me-1"></i>Lihat Bukti
                    </a>
                @endif

                @if($pelaporan->tindak_lanjut)
                    <hr>
                    <h6 class="fw-semibold">Tindak Lanjut:</h6>
                    <p class="text-break">{!! nl2br(e($pelaporan->tindak_lanjut)) !!}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h6 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Update Tindak Lanjut</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.laporan.tindak-lanjut', $pelaporan) }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status Baru <span class="text-danger">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="DIPROSES" {{ old('status') === 'DIPROSES' ? 'selected' : '' }}>DIPROSES</option>
                            <option value="SELESAI" {{ old('status') === 'SELESAI' ? 'selected' : '' }}>SELESAI</option>
                            <option value="DITOLAK" {{ old('status') === 'DITOLAK' ? 'selected' : '' }}>DITOLAK</option>
                        </select>
                        @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Uraian Tindak Lanjut <span class="text-danger">*</span></label>
                        <textarea name="tindak_lanjut" class="form-control @error('tindak_lanjut') is-invalid @enderror"
                            rows="5" placeholder="Jelaskan tindak lanjut yang dilakukan..."
                            required minlength="20">{{ old('tindak_lanjut', $pelaporan->tindak_lanjut) }}</textarea>
                        @error('tindak_lanjut') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-save me-2"></i>Simpan Tindak Lanjut
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('admin.laporan.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection
