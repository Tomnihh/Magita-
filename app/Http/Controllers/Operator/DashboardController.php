<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\MasterDesa;
use App\Models\Pelaporan;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard operator desa.
     */
    public function index(): View
    {
        $user = Auth::user();

        $desaIds = $user->kewenanganDesas()
            ->with('desa')
            ->get()
            ->pluck('desa_id')
            ->toArray();

        $desas = MasterDesa::whereIn('id', $desaIds)->get();

        $stats = [
            'total_desa' => count($desaIds),
            'total_laporan' => Pelaporan::whereIn('desa_id', $desaIds)->count(),
            'laporan_baru' => Pelaporan::whereIn('desa_id', $desaIds)->where('status', 'BARU')->count(),
        ];

        $laporanTerbaru = Pelaporan::whereIn('desa_id', $desaIds)
            ->with('desa')
            ->latest()
            ->limit(5)
            ->get();

        return view('operator.dashboard', compact('desas', 'stats', 'laporanTerbaru'));
    }
}
