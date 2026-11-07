<?php

namespace App\Http\Controllers;

use App\Models\Pelaporan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CekLaporanController extends Controller
{
    /**
     * Halaman publik form pencarian laporan berdasarkan kode.
     */
    public function index(): View
    {
        return view('publik.cek-laporan');
    }

    /**
     * Proses pencarian dan tampilkan status laporan.
     */
    public function cek(Request $request): View
    {
        $request->validate([
            'kode_laporan' => ['required', 'string', 'max:50'],
        ], [
            'kode_laporan.required' => 'Kode laporan wajib diisi.',
        ]);

        $kode = strtoupper(trim($request->input('kode_laporan')));

        $pelaporan = Pelaporan::where('kode_laporan', $kode)
            ->with('desa')
            ->first();

        return view('publik.cek-laporan', compact('pelaporan', 'kode'));
    }
}
