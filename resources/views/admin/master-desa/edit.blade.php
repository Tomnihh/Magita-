@extends('layouts.app')

@section('title', 'Edit Desa')
@section('page-title', 'Edit Data — ' . $masterDesa->nama_desa)

@section('content')
<div class="card" style="max-width:700px">
    <div class="card-header">
        <h6 class="mb-0">
            <i class="bi bi-pencil-square me-2 text-warning"></i>
            Edit Data Desa: <strong>{{ $masterDesa->nama_desa }}</strong>
            <span class="badge bg-secondary ms-2">{{ $masterDesa->kecamatan }}</span>
        </h6>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.master-desa.update', $masterDesa) }}">
            @csrf @method('PUT')

            {{-- Info nama & kecamatan hanya tampil, tidak bisa diubah --}}
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label text-muted small">Nama Desa/Kelurahan</label>
                    <input type="text" class="form-control bg-light" value="{{ $masterDesa->nama_desa }}" disabled>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small">Kecamatan</label>
                    <input type="text" class="form-control bg-light" value="{{ $masterDesa->kecamatan }}" disabled>
                </div>
            </div>

            <hr>

            <div class="row g-3">
                {{-- Status Risiko --}}
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Status Risiko <span class="text-danger">*</span></label>
                    <select name="status_risiko" class="form-select @error('status_risiko') is-invalid @enderror" required>
                        @foreach(['HIJAU' => '🟢 HIJAU', 'KUNING' => '🟡 KUNING', 'MERAH' => '🔴 MERAH'] as $val => $label)
                            <option value="{{ $val }}" {{ old('status_risiko', $masterDesa->status_risiko) === $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('status_risiko') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Tahun Anggaran --}}
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Tahun Anggaran <span class="text-danger">*</span></label>
                    <input type="number" name="tahun_anggaran" min="2020" max="2035"
                        class="form-control @error('tahun_anggaran') is-invalid @enderror"
                        value="{{ old('tahun_anggaran', $masterDesa->tahun_anggaran) }}" required>
                    @error('tahun_anggaran') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Pagu Anggaran --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Pagu Anggaran (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="pagu_anggaran" step="1" min="0"
                        class="form-control @error('pagu_anggaran') is-invalid @enderror"
                        value="{{ old('pagu_anggaran', (int) $masterDesa->pagu_anggaran) }}" required>
                    @error('pagu_anggaran') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Realisasi Anggaran --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Realisasi Anggaran (Rp)</label>
                    <input type="number" name="realisasi_anggaran" step="1" min="0"
                        class="form-control @error('realisasi_anggaran') is-invalid @enderror"
                        value="{{ old('realisasi_anggaran', (int) $masterDesa->realisasi_anggaran) }}">
                    @error('realisasi_anggaran') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Koordinat + Map Picker --}}
                <div class="col-12">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-geo-alt-fill text-danger me-1"></i>Koordinat
                        <span class="text-muted fw-normal small ms-1">— klik peta untuk menentukan titik lokasi desa</span>
                    </label>
                    <div class="row g-2 mb-2">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-text small text-muted">Lat</span>
                                <input type="number" id="input-latitude" name="latitude" step="0.0000001"
                                    class="form-control @error('latitude') is-invalid @enderror"
                                    value="{{ old('latitude', $masterDesa->latitude) }}"
                                    placeholder="-8.4950">
                                @error('latitude') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-text small text-muted">Lng</span>
                                <input type="number" id="input-longitude" name="longitude" step="0.0000001"
                                    class="form-control @error('longitude') is-invalid @enderror"
                                    value="{{ old('longitude', $masterDesa->longitude) }}"
                                    placeholder="117.4150">
                                @error('longitude') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button type="button" id="btn-reset-marker" class="btn btn-outline-secondary w-100">
                                <i class="bi bi-arrow-counterclockwise me-1"></i>Reset
                            </button>
                        </div>
                    </div>

                    {{-- Mini Map Picker --}}
                    <div id="map-picker" style="height:350px;border-radius:.5rem;border:1px solid #dee2e6;cursor:crosshair"></div>
                    <div class="text-muted small mt-1">
                        <i class="bi bi-info-circle me-1"></i>
                        Klik pada peta untuk meletakkan marker. Drag marker untuk menyesuaikan posisi.
                    </div>
                </div>

                {{-- Keterangan --}}
                <div class="col-12">
                    <label class="form-label fw-semibold">Keterangan / Catatan</label>
                    <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                        rows="3" maxlength="1000"
                        placeholder="Catatan tambahan mengenai desa ini...">{{ old('keterangan', $masterDesa->keterangan) }}</textarea>
                    @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-warning fw-semibold">
                    <i class="bi bi-save me-2"></i>Simpan Perubahan
                </button>
                <a href="{{ route('admin.master-desa.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    const inputLat = document.getElementById('input-latitude');
    const inputLng = document.getElementById('input-longitude');

    // Nilai awal: pakai koordinat tersimpan, atau center Sumbawa kalau belum ada
    const initLat = parseFloat(inputLat.value) || -8.4950;
    const initLng = parseFloat(inputLng.value) || 117.4150;
    const hasCoord = !!inputLat.value;

    // Inisialisasi peta
    const peta = L.map('map-picker').setView([initLat, initLng], hasCoord ? 13 : 10);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(peta);

    // Marker draggable
    let marker = null;

    function buatMarker(lat, lng) {
        if (marker) { marker.remove(); }
        marker = L.marker([lat, lng], { draggable: true }).addTo(peta);
        marker.bindPopup(
            '<strong>{{ $masterDesa->nama_desa }}</strong><br><small>Drag untuk sesuaikan posisi</small>'
        ).openPopup();

        marker.on('dragend', function (e) {
            const pos = e.target.getLatLng();
            inputLat.value = pos.lat.toFixed(7);
            inputLng.value = pos.lng.toFixed(7);
        });
    }

    // Taruh marker kalau koordinat sudah ada
    if (hasCoord) {
        buatMarker(initLat, initLng);
    }

    // Klik peta → pindahkan marker
    peta.on('click', function (e) {
        buatMarker(e.latlng.lat, e.latlng.lng);
        inputLat.value = e.latlng.lat.toFixed(7);
        inputLng.value = e.latlng.lng.toFixed(7);
    });

    // Kalau input lat/lng diketik manual → pindahkan marker & center peta
    function syncMapFromInput() {
        const lat = parseFloat(inputLat.value);
        const lng = parseFloat(inputLng.value);
        if (!isNaN(lat) && !isNaN(lng)) {
            buatMarker(lat, lng);
            peta.setView([lat, lng], 13);
        }
    }
    inputLat.addEventListener('change', syncMapFromInput);
    inputLng.addEventListener('change', syncMapFromInput);

    // Tombol reset → hapus marker & kosongkan input
    document.getElementById('btn-reset-marker').addEventListener('click', function () {
        if (marker) { marker.remove(); marker = null; }
        inputLat.value = '';
        inputLng.value = '';
        peta.setView([-8.4950, 117.4150], 10);
    });
})();
</script>
@endpush
