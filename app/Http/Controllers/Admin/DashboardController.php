<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterDesa;
use App\Models\Pelaporan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard utama admin inspektorat.
     * Status risiko desa ditentukan dari jumlah laporan masuk:
     *   MERAH  = ≥ 5 laporan
     *   KUNING = 2–4 laporan
     *   HIJAU  = 0–1 laporan
     */
    public function index(): View
    {
        // Hitung laporan per desa dan update status_risiko secara dinamis
        $laporanPerDesa = DB::table('pelaporans')
            ->select('desa_id', DB::raw('count(*) as total'))
            ->groupBy('desa_id')
            ->pluck('total', 'desa_id');

        // Update status risiko tiap desa berdasarkan jumlah laporan
        MasterDesa::all()->each(function (MasterDesa $desa) use ($laporanPerDesa): void {
            $jml = $laporanPerDesa[$desa->id] ?? 0;
            $risiko = match (true) {
                $jml >= 5 => 'MERAH',
                $jml >= 2 => 'KUNING',
                default => 'HIJAU',
            };
            if ($desa->status_risiko !== $risiko) {
                $desa->updateQuietly(['status_risiko' => $risiko]);
            }
        });

        $stats = [
            'total_desa' => MasterDesa::where('is_active', true)->count(),
            'desa_risiko_merah' => MasterDesa::where('status_risiko', 'MERAH')->count(),
            'desa_risiko_kuning' => MasterDesa::where('status_risiko', 'KUNING')->count(),
            'desa_risiko_hijau' => MasterDesa::where('status_risiko', 'HIJAU')->count(),
            'total_laporan' => Pelaporan::count(),
            'laporan_baru' => Pelaporan::where('status', 'BARU')->count(),
            'laporan_diproses' => Pelaporan::where('status', 'DIPROSES')->count(),
            'laporan_selesai' => Pelaporan::where('status', 'SELESAI')->count(),
            'total_pengguna' => User::count(),
            'akun_pending' => User::where('status_akun', 'PENDING')->count(),
        ];

        // Desa dengan laporan terbanyak (merah/kuning)
        $desaRisiko = MasterDesa::withCount('pelaporans')
            ->whereIn('status_risiko', ['MERAH', 'KUNING'])
            ->orderByDesc('pelaporans_count')
            ->limit(10)
            ->get();

        $desaMapData = MasterDesa::withCount('pelaporans')
            ->where('is_active', true)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get(['id', 'nama_desa', 'kecamatan', 'latitude', 'longitude', 'status_risiko']);

        return view('admin.dashboard', compact('stats', 'desaRisiko', 'desaMapData'));
    }
}
