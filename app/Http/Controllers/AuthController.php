<?php

namespace App\Http\Controllers;

use App\Models\AuditTrail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login / gerbang sesi.
     */
    public function showLogin(): View
    {
        return view('auth.login');
    }

    /**
     * Proses login manual menggunakan NIK atau Email.
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'identifier' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'identifier.required' => 'NIK atau Email wajib diisi.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $identifier = $request->input('identifier');
        $isNik = ctype_digit($identifier) && strlen($identifier) === 16;

        $field = $isNik ? 'nik' : 'email';

        $user = User::where($field, $identifier)->first();

        if (! $user || ! Hash::check($request->input('password'), $user->password)) {
            AuditTrail::catat('LOGIN_GAGAL', null, null, null, null, null, "Percobaan login dengan: {$identifier}");

            return back()->withErrors([
                'identifier' => 'NIK/Email atau kata sandi tidak valid.',
            ])->withInput($request->only('identifier'));
        }

        if ($user->status_akun === 'PENDING') {
            return back()->withErrors([
                'identifier' => 'Akun Anda masih menunggu verifikasi administrator.',
            ])->withInput($request->only('identifier'));
        }

        if ($user->status_akun === 'DITOLAK') {
            return back()->withErrors([
                'identifier' => 'Akun Anda ditolak. Silakan hubungi administrator.',
            ])->withInput($request->only('identifier'));
        }

        if ($user->status_akun === 'VERIFIED') {
            $user->update(['status_akun' => 'AKTIF']);
        }

        Auth::login($user, $request->boolean('remember'));

        AuditTrail::catat('LOGIN_BERHASIL', $user->id, null, null, null, null, 'Login berhasil.');

        $request->session()->regenerate();

        return $this->redirectAfterLogin($user);
    }

    /**
     * Tampilkan halaman registrasi warga.
     */
    public function showRegister(): View
    {
        return view('auth.register');
    }

    /**
     * Proses registrasi warga baru dengan unggah KTP.
     */
    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'nik' => [
                'required',
                'digits:16',
                'unique:users,nik',
                // NIK Indonesia: 6 digit kode wilayah + 6 digit tgl lahir + 4 digit urut
                // Kode wilayah dimulai dari 11 (Aceh) s.d. 92 (Papua Barat Daya)
                'regex:/^[1-9][0-9]{5}(0[1-9]|[12][0-9]|3[01]|4[1-9]|5[0-9]|6[01])(0[1-9]|1[0-2])\d{2}\d{4}$/',
            ],
            'nama_lengkap' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[\pL\s\.\'\-]+$/u'],
            'email' => ['nullable', 'email:rfc,dns', 'unique:users,email', 'max:255'],
            'no_whatsapp' => [
                'required',
                // Format: 08xx atau +628xx, panjang 10-15 digit
                'regex:/^(\+62|62|0)8[1-9][0-9]{7,11}$/',
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'foto_ktp' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus tepat 16 digit angka.',
            'nik.unique' => 'NIK ini sudah terdaftar di sistem.',
            'nik.regex' => 'Format NIK tidak valid. Pastikan NIK sesuai dengan KTP Anda.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.min' => 'Nama lengkap minimal 3 karakter.',
            'nama_lengkap.regex' => 'Nama lengkap hanya boleh berisi huruf, spasi, titik, atau tanda hubung.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'no_whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'no_whatsapp.regex' => 'Nomor WhatsApp tidak valid. Gunakan format: 08xx, +628xx, atau 628xx (10–15 digit).',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'foto_ktp.required' => 'Foto KTP wajib diunggah.',
            'foto_ktp.image' => 'File harus berupa gambar.',
            'foto_ktp.mimes' => 'Format foto harus JPG atau PNG.',
            'foto_ktp.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        // Normalisasi nomor WA → simpan dalam format 08xx
        $noWa = $request->input('no_whatsapp');
        $noWa = preg_replace('/^\+62/', '0', $noWa);
        $noWa = preg_replace('/^62/', '0', $noWa);

        $fotoPath = $request->file('foto_ktp')->store('ktp', 'public');

        $user = User::create([
            'nik' => $request->input('nik'),
            'nama_lengkap' => $request->input('nama_lengkap'),
            'email' => $request->input('email'),
            'no_whatsapp' => $noWa,
            'password' => $request->input('password'),
            'foto_ktp_url' => $fotoPath,
            'role' => 'WARGA',
            'status_akun' => 'PENDING',
        ]);

        AuditTrail::catat('REGISTRASI', $user->id, User::class, $user->id, null, null, 'Registrasi warga baru.');

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Akun Anda sedang menunggu verifikasi administrator.');
    }

    /**
     * Proses logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        AuditTrail::catat('LOGOUT', auth()->id(), null, null, null, null, 'Logout berhasil.');

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    private function redirectAfterLogin(User $user): RedirectResponse
    {
        return match ($user->role) {
            'ADMIN_INSPEKTORAT' => redirect()->route('admin.dashboard'),
            default             => redirect()->route('warga.dashboard'),
        };
    }
}
