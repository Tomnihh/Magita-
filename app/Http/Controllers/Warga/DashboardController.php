<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\Pelaporan;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard warga — tanpa peta.
     */
    public function index(): View
    {
        $user = Auth::user();

        $laporanSaya = Pelaporan::where('pelapor_id', $user->id)
            ->withCount('buktis')
            ->with('desa')
            ->latest()
            ->paginate(10);

        return view('warga.dashboard', compact('laporanSaya'));
    }
}
