<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditTrail;
use App\Models\MasterDesa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MasterDesaController extends Controller
{
    /**
     * Daftar semua desa beserta filter.
     */
    public function index(Request $request): View
    {
        $query = MasterDesa::query();

        if ($request->filled('kecamatan')) {
            $query->where('kecamatan', $request->input('kecamatan'));
        }

        if ($request->filled('status_risiko')) {
            $query->where('status_risiko', $request->input('status_risiko'));
        }

        if ($request->filled('search')) {
            $query->where('nama_desa', 'like', '%'.$request->input('search').'%');
        }

        $desas = $query->orderBy('kecamatan')->orderBy('nama_desa')->paginate(20)->withQueryString();

        // Ambil dari DB agar otomatis mencerminkan data seeder
        $kecamatans = MasterDesa::distinct()->orderBy('kecamatan')->pluck('kecamatan');

        return view('admin.master-desa.index', compact('desas', 'kecamatans'));
    }

    /**
     * Detail desa.
     */
    public function show(MasterDesa $masterDesa): View
    {
        $masterDesa->load(['pelaporans' => fn ($q) => $q->latest()->limit(5)]);

        return view('admin.master-desa.show', compact('masterDesa'));
    }

    /**
     * Form edit data anggaran & risiko desa.
     */
    public function edit(MasterDesa $masterDesa): View
    {
        return view('admin.master-desa.edit', compact('masterDesa'));
    }

    /**
     * Simpan perubahan data anggaran & risiko desa.
     */
    public function update(Request $request, MasterDesa $masterDesa): RedirectResponse
    {
        $data = $request->validate([
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'status_risiko' => ['required', 'in:HIJAU,KUNING,MERAH'],
            'pagu_anggaran' => ['required', 'numeric', 'min:0'],
            'realisasi_anggaran' => ['nullable', 'numeric', 'min:0'],
            'tahun_anggaran' => ['required', 'digits:4'],
            'keterangan' => ['nullable', 'string', 'max:1000'],
        ]);

        $dataLama = $masterDesa->only(['status_risiko', 'pagu_anggaran', 'realisasi_anggaran', 'tahun_anggaran', 'latitude', 'longitude']);

        $masterDesa->update($data);

        AuditTrail::catat(
            'UPDATE_DESA',
            auth()->id(),
            MasterDesa::class,
            $masterDesa->id,
            $dataLama,
            $masterDesa->fresh()->only(['status_risiko', 'pagu_anggaran', 'realisasi_anggaran', 'tahun_anggaran', 'latitude', 'longitude']),
            "Desa {$masterDesa->nama_desa} diperbarui."
        );

        return redirect()->route('admin.master-desa.index')
            ->with('success', "Data desa {$masterDesa->nama_desa} berhasil diperbarui.");
    }
}
