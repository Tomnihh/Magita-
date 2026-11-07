@extends('layouts.app')

@section('title', 'Buat Laporan')
@section('page-title', 'Kirim Laporan Pengaduan')

@push('styles')
<style>
    .bukti-item { background:#f8f9fa; border:1px solid #dee2e6; border-radius:.5rem; padding:1rem; position:relative; }
    .bukti-item .btn-hapus { position:absolute; top:.5rem; right:.5rem; }
    .preview-img { max-height:120px; object-fit:cover; border-radius:.375rem; }
    .drop-zone {
        border: 2px dashed #adb5bd;
        border-radius: .5rem;
        padding: 2rem;
        text-align: center;
        cursor: pointer;
        transition: all .2s;
        background: #f8f9fa;
    }
    .drop-zone:hover, .drop-zone.dragover { border-color: #0d6efd; background: #e8f0fe; }
    .drop-zone input[type=file] { display:none; }
</style>
@endpush

@section('content')
<div class="card" style="max-width:800px">
    <div class="card-header">
        <h6 class="mb-0">
            <i class="bi bi-megaphone me-2 text-danger"></i>Form Laporan Pengaduan Dana Desa
        </h6>
    </div>
    <div class="card-body">
        <div class="alert alert-warning small py-2 mb-4">
            <i class="bi bi-shield-lock me-1"></i>
            Laporan Anda dijamin kerahasiaannya. Anda bisa memilih untuk melaporkan secara anonim.
        </div>

        <form method="POST" action="{{ route('warga.laporan.store') }}"
              enctype="multipart/form-data" id="formLaporan">
            @csrf

            <div class="row g-3">

                {{-- Desa --}}
                <div class="col-md-8">
                    <label class="form-label fw-semibold">
                        Desa yang Dilaporkan <span class="text-danger">*</span>
                    </label>
                    <select name="desa_id" class="form-select @error('desa_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Desa --</option>
                        @foreach($desas->groupBy('kecamatan') as $kecamatan => $desaList)
                            <optgroup label="Kec. {{ $kecamatan }}">
                                @foreach($desaList as $desa)
                                    <option value="{{ $desa->id }}"
                                        {{ old('desa_id') == $desa->id ? 'selected' : '' }}>
                                        {{ $desa->nama_desa }}
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    @error('desa_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Kategori --}}
                <div class="col-md-4">
                    <label class="form-label fw-semibold">
                        Kategori <span class="text-danger">*</span>
                    </label>
                    <select name="kategori" class="form-select @error('kategori') is-invalid @enderror" required>
                        <option value="">-- Kategori --</option>
                        @foreach([
                            'GRATIFIKASI'          => 'Gratifikasi',
                            'KORUPSI'              => 'Korupsi',
                            'PENYALAHGUNAAN'       => 'Penyalahgunaan Wewenang',
                            'MARK_UP'              => 'Mark Up Harga',
                            'LAINNYA'              => 'Lainnya',
                        ] as $val => $label)
                            <option value="{{ $val }}" {{ old('kategori') === $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Judul --}}
                <div class="col-12">
                    <label class="form-label fw-semibold">
                        Judul Laporan <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="judul_laporan"
                        class="form-control @error('judul_laporan') is-invalid @enderror"
                        value="{{ old('judul_laporan') }}"
                        placeholder="Ringkasan singkat masalah yang dilaporkan (min. 10 karakter)"
                        minlength="10" required>
                    @error('judul_laporan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Isi Laporan --}}
                <div class="col-12">
                    <label class="form-label fw-semibold">
                        Isi Laporan <span class="text-danger">*</span>
                    </label>
                    <textarea name="isi_laporan"
                        class="form-control @error('isi_laporan') is-invalid @enderror"
                        rows="6"
                        placeholder="Uraikan secara detail: kejadian apa, kapan, di mana, siapa yang terlibat, dan berapa perkiraan kerugiannya. (min. 50 karakter)"
                        minlength="50"
                        required>{{ old('isi_laporan') }}</textarea>
                    @error('isi_laporan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- BUKTI FOTO / FILE ──────────────────────────────────── --}}
                <div class="col-12">
                    <label class="form-label fw-semibold">
                        <i class="bi bi-camera me-1 text-primary"></i>
                        Foto / File Bukti
                        <span class="text-muted small">(opsional, maks. 5 file)</span>
                    </label>
                    <div class="form-text mb-2">
                        Unggah foto kejadian, dokumen, tangkapan layar, atau bukti lain.
                        Format: JPG, PNG, PDF — maks. 5 MB per file.
                    </div>

                    {{-- Error untuk bukti --}}
                    @error('bukti') <div class="text-danger small mb-2">{{ $message }}</div> @enderror
                    @foreach($errors->get('bukti.*') as $err)
                        <div class="text-danger small mb-1">{{ $err[0] }}</div>
                    @endforeach

                    {{-- Drop zone --}}
                    <div class="drop-zone" id="dropZone" onclick="document.getElementById('inputBukti').click()">
                        <input type="file" id="inputBukti" name="bukti[]"
                            accept="image/jpg,image/jpeg,image/png,application/pdf"
                            multiple>
                        <i class="bi bi-cloud-upload fs-2 text-muted d-block mb-2"></i>
                        <div class="text-muted">Klik atau seret file ke sini</div>
                        <div class="text-muted small">JPG · PNG · PDF — maks. 5 MB/file · maks. 5 file</div>
                    </div>

                    {{-- Preview container --}}
                    <div id="previewContainer" class="row g-2 mt-2"></div>

                    {{-- Container input file tersembunyi untuk keterangan --}}
                    <div id="hiddenInputs"></div>
                </div>

                {{-- Anonim --}}
                <div class="col-12">
                    <div class="form-check">
                        <input type="hidden" name="is_anonim" value="0">
                        <input class="form-check-input" type="checkbox"
                            name="is_anonim" value="1"
                            id="is_anonim" {{ old('is_anonim') ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="is_anonim">
                            <i class="bi bi-incognito me-1 text-dark"></i>Kirim secara Anonim
                        </label>
                        <div class="form-text">Identitas Anda tidak akan ditampilkan kepada siapapun</div>
                    </div>
                </div>

            </div>{{-- /row --}}

            <div class="mt-4 d-flex gap-2">
                <button type="submit" class="btn btn-danger fw-semibold">
                    <i class="bi bi-send me-2"></i>Kirim Laporan
                </button>
                <a href="{{ route('warga.dashboard') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
let fileList = [];

const dropZone   = document.getElementById('dropZone');
const inputBukti = document.getElementById('inputBukti');
const preview    = document.getElementById('previewContainer');

// Drag events
dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('dragover'); });
dropZone.addEventListener('dragleave', () => dropZone.classList.remove('dragover'));
dropZone.addEventListener('drop', e => {
    e.preventDefault();
    dropZone.classList.remove('dragover');
    addFiles(e.dataTransfer.files);
});

inputBukti.addEventListener('change', function() {
    addFiles(this.files);
    this.value = ''; // reset supaya bisa pilih file yang sama lagi
});

function addFiles(files) {
    Array.from(files).forEach(file => {
        if (fileList.length >= 5) {
            alert('Maksimal 5 file bukti.'); return;
        }
        if (file.size > 5 * 1024 * 1024) {
            alert(`${file.name}: ukuran melebihi 5 MB.`); return;
        }
        fileList.push(file);
    });
    renderPreview();
}

function removeFile(idx) {
    fileList.splice(idx, 1);
    renderPreview();
}

function renderPreview() {
    preview.innerHTML = '';

    fileList.forEach((file, idx) => {
        const isImg = file.type.startsWith('image/');
        const col   = document.createElement('div');
        col.className = 'col-md-4 col-6';

        col.innerHTML = `
            <div class="bukti-item">
                <button type="button" class="btn btn-sm btn-danger btn-hapus"
                    onclick="removeFile(${idx})">
                    <i class="bi bi-x"></i>
                </button>
                ${isImg
                    ? `<img src="${URL.createObjectURL(file)}" class="preview-img w-100 mb-2">`
                    : `<div class="text-center py-3 mb-2"><i class="bi bi-file-earmark-pdf fs-1 text-danger"></i></div>`
                }
                <div class="small text-truncate fw-semibold" title="${file.name}">${file.name}</div>
                <div class="text-muted" style="font-size:.72rem">${(file.size/1024).toFixed(1)} KB</div>
                <input type="text" class="form-control form-control-sm mt-1"
                    name="keterangan_bukti[${idx}]"
                    placeholder="Keterangan (opsional)">
            </div>
        `;
        preview.appendChild(col);
    });

    // Rebuild hidden file inputs dari DataTransfer
    rebuildFileInput();
}

function rebuildFileInput() {
    // Gunakan DataTransfer untuk membuat FileList baru
    const dt = new DataTransfer();
    fileList.forEach(f => dt.items.add(f));
    inputBukti.files = dt.files;
}
</script>
@endpush
