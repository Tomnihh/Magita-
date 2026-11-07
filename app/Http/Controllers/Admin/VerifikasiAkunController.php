<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditTrail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VerifikasiAkunController extends Controller
{
    /**
     * Tampilkan daftar akun yang menunggu verifikasi.
     */
    public function index(): View
    {
        $akunPending = User::where('status_akun', 'PENDING')
            ->latest()
            ->paginate(15);

        $akunDiverifikasi = User::whereIn('status_akun', ['AKTIF', 'DITOLAK'])
            ->whereNotNull('verified_by')
            ->latest('verified_at')
            ->paginate(10);

        return view('admin.verifikasi.index', compact('akunPending', 'akunDiverifikasi'));
    }

    /**
     * Detail akun untuk diverifikasi.
     */
    public function show(User $user): View
    {
        return view('admin.verifikasi.show', compact('user'));
    }

    /**
     * Setujui pendaftaran akun.
     */
    public function setujui(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'role' => ['required', 'in:WARGA'],
            'catatan' => ['nullable', 'string', 'max:500'],
        ]);

        $user->update([
            'status_akun' => 'AKTIF',
            'role' => $request->input('role'),
            'catatan_verifikasi' => $request->input('catatan'),
            'verified_by' => auth()->id(),
            'verified_at' => now(),
        ]);

        AuditTrail::catat(
            'VERIFIKASI_SETUJU',
            auth()->id(),
            User::class,
            $user->id,
            ['status_akun' => 'PENDING'],
            ['status_akun' => 'AKTIF', 'role' => $request->input('role')],
            "Akun {$user->nama_lengkap} disetujui."
        );

        return redirect()->route('admin.verifikasi.index')
            ->with('success', "Akun {$user->nama_lengkap} berhasil disetujui.");
    }

    /**
     * Tolak pendaftaran akun.
     */
    public function tolak(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'catatan' => ['required', 'string', 'max:500'],
        ], [
            'catatan.required' => 'Alasan penolakan wajib diisi.',
        ]);

        $user->update([
            'status_akun' => 'DITOLAK',
            'catatan_verifikasi' => $request->input('catatan'),
            'verified_by' => auth()->id(),
            'verified_at' => now(),
        ]);

        AuditTrail::catat(
            'VERIFIKASI_TOLAK',
            auth()->id(),
            User::class,
            $user->id,
            ['status_akun' => 'PENDING'],
            ['status_akun' => 'DITOLAK'],
            "Akun {$user->nama_lengkap} ditolak. Alasan: {$request->input('catatan')}"
        );

        return redirect()->route('admin.verifikasi.index')
            ->with('danger', "Akun {$user->nama_lengkap} telah ditolak.");
    }
}
