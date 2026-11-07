<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditTrail;
use App\Models\MasterDesa;
use App\Models\Pelaporan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class LaporanController extends Controller
{
    /**
     * Daftar semua laporan.
     */
    public function index(Request $request): View
    {
        $query = Pelaporan::with(['desa', 'pelapor']);

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->input('kategori'));
        }

        if ($request->filled('kecamatan')) {
            $query->whereHas('desa', fn ($q) => $q->where('kecamatan', $request->input('kecamatan')));
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request): void {
                $q->where('kode_laporan', 'like', '%'.$request->input('search').'%')
                    ->orWhere('judul_laporan', 'like', '%'.$request->input('search').'%');
            });
        }

        $pelaporans = $query->latest()->paginate(15)->withQueryString();
        $kecamatans = MasterDesa::distinct()->orderBy('kecamatan')->pluck('kecamatan');

        return view('admin.laporan.index', compact('pelaporans', 'kecamatans'));
    }

    /**
     * Detail laporan.
     */
    public function show(Pelaporan $pelaporan): View
    {
        $pelaporan->load('desa', 'pelapor');

        return view('admin.laporan.show', compact('pelaporan'));
    }

    /**
     * Update status tindak lanjut laporan.
     */
    public function tindakLanjut(Request $request, Pelaporan $pelaporan): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:DIPROSES,SELESAI,DITOLAK'],
            'tindak_lanjut' => ['required', 'string', 'min:20'],
        ], [
            'tindak_lanjut.required' => 'Uraian tindak lanjut wajib diisi.',
            'tindak_lanjut.min' => 'Tindak lanjut minimal 20 karakter.',
        ]);

        $statusLama = $pelaporan->status;

        $pelaporan->update([
            'status' => $request->input('status'),
            'tindak_lanjut' => $request->input('tindak_lanjut'),
        ]);

        AuditTrail::catat(
            'UPDATE_LAPORAN',
            auth()->id(),
            Pelaporan::class,
            $pelaporan->id,
            ['status' => $statusLama],
            ['status' => $request->input('status')],
            "Laporan {$pelaporan->kode_laporan} diperbarui."
        );

        return redirect()->route('admin.laporan.show', $pelaporan)
            ->with('success', 'Tindak lanjut laporan berhasil disimpan.');
    }

    /**
     * Download PDF semua laporan (dengan filter opsional).
     */
    public function exportPdf(Request $request): Response
    {
        $query = Pelaporan::with(['desa', 'pelapor'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('kecamatan')) {
            $query->whereHas('desa', fn ($q) => $q->where('kecamatan', $request->input('kecamatan')));
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->input('kategori'));
        }

        if ($request->filled('tanggal_dari')) {
            $query->whereDate('created_at', '>=', $request->input('tanggal_dari'));
        }

        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('created_at', '<=', $request->input('tanggal_sampai'));
        }

        $pelaporans = $query->get();
        $filterInfo = $this->buildFilterInfo($request);

        AuditTrail::catat(
            'EXPORT_PDF_LAPORAN',
            auth()->id(),
            null,
            null,
            null,
            null,
            'Export PDF laporan. Filter: '.$filterInfo
        );

        $pdf = Pdf::loadView('admin.laporan.pdf', [
            'pelaporans' => $pelaporans,
            'filterInfo' => $filterInfo,
            'generatedAt' => now(),
            'generatedBy' => auth()->user()->nama_lengkap,
        ])->setPaper('a4', 'landscape');

        $filename = 'laporan-sadewa-'.now()->format('Ymd-His').'.pdf';

        return $pdf->download($filename);
    }

    private function buildFilterInfo(Request $request): string
    {
        $parts = [];
        if ($request->filled('status')) {
            $parts[] = 'Status: '.$request->input('status');
        }
        if ($request->filled('kecamatan')) {
            $parts[] = 'Kecamatan: '.$request->input('kecamatan');
        }
        if ($request->filled('kategori')) {
            $parts[] = 'Kategori: '.$request->input('kategori');
        }
        if ($request->filled('tanggal_dari')) {
            $parts[] = 'Dari: '.$request->input('tanggal_dari');
        }
        if ($request->filled('tanggal_sampai')) {
            $parts[] = 'Sampai: '.$request->input('tanggal_sampai');
        }

        return empty($parts) ? 'Semua laporan' : implode(', ', $parts);
    }
}
