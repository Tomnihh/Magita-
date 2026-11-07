<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\AuditTrail;
use App\Models\BuktiPelaporan;
use App\Models\MasterDesa;
use App\Models\Pelaporan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PelaporanController extends Controller
{
    /**
     * Form buat laporan baru.
     */
    public function create(): View
    {
        $desas = MasterDesa::where('is_active', true)
            ->orderBy('kecamatan')
            ->orderBy('nama_desa')
            ->get(['id', 'nama_desa', 'kecamatan']);

        return view('warga.laporan.create', compact('desas'));
    }

    /**
     * Simpan laporan baru beserta multi foto bukti.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'desa_id' => ['required', 'exists:master_desas,id'],
            'judul_laporan' => ['required', 'string', 'max:255', 'min:10'],
            'isi_laporan' => ['required', 'string', 'min:50'],
            'kategori' => ['required', 'in:GRATIFIKASI,KORUPSI,PENYALAHGUNAAN,MARK_UP,LAINNYA'],
            'is_anonim' => ['boolean'],
            // Multi file bukti — maks 5 file, tiap file maks 5MB
            'bukti' => ['nullable', 'array', 'max:5'],
            'bukti.*' => ['file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'keterangan_bukti' => ['nullable', 'array'],
            'keterangan_bukti.*' => ['nullable', 'string', 'max:255'],
        ], [
            'desa_id.required' => 'Pilih desa yang dilaporkan.',
            'judul_laporan.required' => 'Judul laporan wajib diisi.',
            'judul_laporan.min' => 'Judul laporan minimal 10 karakter.',
            'isi_laporan.required' => 'Isi laporan wajib diisi.',
            'isi_laporan.min' => 'Isi laporan minimal 50 karakter.',
            'kategori.required' => 'Pilih kategori laporan.',
            'bukti.max' => 'Maksimal 5 file bukti.',
            'bukti.*.mimes' => 'Setiap file bukti harus JPG, PNG, atau PDF.',
            'bukti.*.max' => 'Ukuran tiap file bukti maksimal 5MB.',
        ]);

        $isAnonim = $request->boolean('is_anonim');
        $user = Auth::user();

        $pelaporan = Pelaporan::create([
            'desa_id' => $request->input('desa_id'),
            'pelapor_id' => $isAnonim ? null : $user->id,
            'is_anonim' => $isAnonim,
            'judul_laporan' => $request->input('judul_laporan'),
            'isi_laporan' => $request->input('isi_laporan'),
            'kategori' => $request->input('kategori'),
            'status' => 'BARU',
            'kanal' => 'WEB',
        ]);

        // Simpan setiap file bukti
        if ($request->hasFile('bukti')) {
            foreach ($request->file('bukti') as $urutan => $file) {
                $path = $file->store('bukti-laporan', 'public');

                BuktiPelaporan::create([
                    'pelaporan_id' => $pelaporan->id,
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                    'keterangan' => $request->input("keterangan_bukti.{$urutan}"),
                    'urutan' => $urutan + 1,
                ]);
            }
        }

        AuditTrail::catat(
            'BUAT_LAPORAN',
            $isAnonim ? null : $user->id,
            Pelaporan::class,
            $pelaporan->id,
            null,
            null,
            "Laporan {$pelaporan->kode_laporan} dibuat."
        );

        return redirect()->route('warga.laporan.sukses', ['kode' => $pelaporan->kode_laporan]);
    }

    /**
     * Halaman sukses setelah laporan berhasil dikirim.
     */
    public function sukses(string $kode): View
    {
        $pelaporan = Pelaporan::where('kode_laporan', $kode)
            ->with(['desa', 'buktis'])
            ->firstOrFail();

        if (! $pelaporan->is_anonim && $pelaporan->pelapor_id !== Auth::id()) {
            abort(403);
        }

        return view('warga.laporan.sukses', compact('pelaporan'));
    }

    /**
     * Detail laporan milik warga.
     */
    public function show(Pelaporan $pelaporan): View
    {
        if ($pelaporan->is_anonim || $pelaporan->pelapor_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke laporan ini.');
        }

        $pelaporan->load(['desa', 'buktis']);

        return view('warga.laporan.show', compact('pelaporan'));
    }
}
