<?php

namespace Database\Seeders;

use App\Models\MasterDesa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     * 157 desa resmi Kabupaten Sumbawa (tanpa Operator Desa).
     * Data pelaporan kosong — diisi real oleh warga.
     */
    public function run(): void
    {
        // Admin Inspektorat
        User::create([
            'nik'          => '5208010101010001',
            'nama_lengkap' => 'Admin Inspektorat Sumbawa',
            'email'        => 'admin@inspektorat-sumbawa.go.id',
            'password'     => Hash::make('password'),
            'no_whatsapp'  => '081234567890',
            'role'         => 'ADMIN_INSPEKTORAT',
            'status_akun'  => 'AKTIF',
        ]);

        // Warga contoh
        User::create([
            'nik'          => '5208010101010003',
            'nama_lengkap' => 'Warga Contoh',
            'email'        => 'warga@example.com',
            'password'     => Hash::make('password'),
            'no_whatsapp'  => '081234567892',
            'role'         => 'WARGA',
            'status_akun'  => 'AKTIF',
        ]);

        $this->seedMasterDesa();
    }

    private function seedMasterDesa(): void
    {
        // Format: [kecamatan, nama_desa, lat, lng]
        $desas = [
            // ── ALAS (8) ──────────────────────────────────────────────────────
            ['Alas', 'Kalimango',    -8.650, 116.970],
            ['Alas', 'Baru',         -8.635, 116.952],
            ['Alas', 'Dalam',        -8.625, 116.942],
            ['Alas', 'Juranalas',    -8.642, 116.960],
            ['Alas', 'Luar',         -8.612, 116.945],
            ['Alas', 'Marente',      -8.655, 116.980],
            ['Alas', 'Pulau Bungin', -8.595, 116.910],
            ['Alas', 'Mapin Rea',    -8.640, 116.858],

            // ── ALAS BARAT (8) ────────────────────────────────────────────────
            ['Alas Barat', 'Gontar',        -8.628, 116.940],
            ['Alas Barat', 'Gontar Baru',   -8.620, 116.935],
            ['Alas Barat', 'Mapin Baru',    -8.660, 116.880],
            ['Alas Barat', 'Mapin Beru',    -8.655, 116.875],
            ['Alas Barat', 'Mapin Kebak',   -8.668, 116.870],
            ['Alas Barat', 'Mapin Loka',    -8.672, 116.862],
            ['Alas Barat', 'Labuhan Mapin', -8.645, 116.865],
            ['Alas Barat', 'Usar Mapin',    -8.678, 116.895],

            // ── BATU LANTEH (6) ───────────────────────────────────────────────
            ['Batu Lanteh', 'Bao Desa',      -8.820, 117.200],
            ['Batu Lanteh', 'Batudulang',    -8.835, 117.215],
            ['Batu Lanteh', 'Baturotok',     -8.810, 117.190],
            ['Batu Lanteh', 'Kelungkung',    -8.845, 117.225],
            ['Batu Lanteh', 'Tangkan Pulit', -8.855, 117.235],
            ['Batu Lanteh', 'Tepal',         -8.800, 117.180],

            // ── BUER (6) ──────────────────────────────────────────────────────
            ['Buer', 'Kalabeso',       -8.390, 117.280],
            ['Buer', 'Jurumapin',      -8.370, 117.255],
            ['Buer', 'Labuhan Burung', -8.360, 117.245],
            ['Buer', 'Buin Baru',      -8.380, 117.270],
            ['Buer', 'Pulau Kaung',    -8.355, 117.235],
            ['Buer', 'Tarusa',         -8.400, 117.290],

            // ── EMPANG (10) ───────────────────────────────────────────────────
            ['Empang', 'Empang Atas',  -8.860, 117.665],
            ['Empang', 'Empang Bawah', -8.880, 117.695],
            ['Empang', 'Jotang',       -8.895, 117.710],
            ['Empang', 'Jotang Beru',  -8.905, 117.720],
            ['Empang', 'Lamusung',     -8.855, 117.660],
            ['Empang', 'Ongko',        -8.910, 117.730],
            ['Empang', 'Pamanto',      -8.920, 117.740],
            ['Empang', 'Gapit',        -8.845, 117.650],
            ['Empang', 'Pedanka',      -8.835, 117.640],
            ['Empang', 'Bunga Eja',    -8.870, 117.680],

            // ── LABANGKA (5) ──────────────────────────────────────────────────
            ['Labangka', 'Labangka',   -8.265, 117.855],
            ['Labangka', 'Labangka 1', -8.255, 117.845],
            ['Labangka', 'Labangka 2', -8.275, 117.865],
            ['Labangka', 'Labangka 3', -8.245, 117.835],
            ['Labangka', 'Labangka 4', -8.285, 117.875],

            // ── LABUHAN BADAS (7) ─────────────────────────────────────────────
            ['Labuhan Badas', 'Karang Dima',     -8.520, 117.470],
            ['Labuhan Badas', 'Labuhan Sumbawa', -8.505, 117.455],
            ['Labuhan Badas', 'Bajak',           -8.515, 117.465],
            ['Labuhan Badas', 'Badas',           -8.525, 117.475],
            ['Labuhan Badas', 'Labuhan Aji',     -8.510, 117.460],
            ['Labuhan Badas', 'Sebotok',         -8.560, 117.510],
            ['Labuhan Badas', 'Bugis Medang',    -8.540, 117.490],

            // ── LANTUNG (4) ───────────────────────────────────────────────────
            ['Lantung', 'Lantung',          -8.740, 117.310],
            ['Lantung', 'Lantung Ai Mual',  -8.750, 117.320],
            ['Lantung', 'Sepukur',          -8.730, 117.300],
            ['Lantung', 'Padang Seloka',    -8.760, 117.330],

            // ── LAPE (4) ──────────────────────────────────────────────────────
            ['Lape', 'Lape',          -8.550, 117.690],
            ['Lape', 'Dete',          -8.540, 117.680],
            ['Lape', 'Labuhan Kuris', -8.520, 117.660],
            ['Lape', 'Ngali',         -8.530, 117.670],

            // ── LENANGGUAR (4) ────────────────────────────────────────────────
            ['Lenangguar', 'Lenangguar', -8.780, 117.450],
            ['Lenangguar', 'Tatebal',    -8.800, 117.470],
            ['Lenangguar', 'Ledang',     -8.790, 117.460],
            ['Lenangguar', 'Telaga',     -8.770, 117.440],

            // ── LOPOK (7) ─────────────────────────────────────────────────────
            ['Lopok', 'Lopok',      -8.610, 117.570],
            ['Lopok', 'Lopok Beru', -8.620, 117.580],
            ['Lopok', 'Langam',     -8.590, 117.550],
            ['Lopok', 'Mama',       -8.580, 117.540],
            ['Lopok', 'Pungkit',    -8.630, 117.590],
            ['Lopok', 'Berora',     -8.600, 117.560],
            ['Lopok', 'Tatede',     -8.570, 117.530],

            // ── LUNYUK (7) ────────────────────────────────────────────────────
            ['Lunyuk', 'Lunyuk Rea',      -9.055, 117.355],
            ['Lunyuk', 'Lunyuk Ode',      -9.045, 117.345],
            ['Lunyuk', 'Perung',          -9.070, 117.370],
            ['Lunyuk', 'Padas',           -9.080, 117.380],
            ['Lunyuk', 'Jamu',            -9.060, 117.360],
            ['Lunyuk', 'Sukamaju',        -9.035, 117.335],
            ['Lunyuk', 'Emang Lestari',   -9.090, 117.390],

            // ── MARONGE (4) ───────────────────────────────────────────────────
            ['Maronge', 'Maronge',         -8.720, 117.720],
            ['Maronge', 'Labuhan Sangoro', -8.710, 117.710],
            ['Maronge', 'Pemasar',         -8.730, 117.730],
            ['Maronge', 'Simu',            -8.700, 117.700],

            // ── MOYO HILIR (10) ───────────────────────────────────────────────
            ['Moyo Hilir', 'Kakiang',       -8.565, 117.525],
            ['Moyo Hilir', 'Moyo',          -8.575, 117.535],
            ['Moyo Hilir', 'Berare',        -8.555, 117.515],
            ['Moyo Hilir', 'Batu Tering',   -8.545, 117.505],
            ['Moyo Hilir', 'Ngeru',         -8.535, 117.495],
            ['Moyo Hilir', 'Olat Marang',   -8.595, 117.555],
            ['Moyo Hilir', 'Poto',          -8.525, 117.485],
            ['Moyo Hilir', 'Serading',      -8.605, 117.565],
            ['Moyo Hilir', 'Serading Baru', -8.615, 117.575],
            ['Moyo Hilir', 'Labuhan Ijuk',  -8.515, 117.475],

            // ── MOYO HULU (12) ────────────────────────────────────────────────
            ['Moyo Hulu', 'Marga Karya', -8.680, 117.460],
            ['Moyo Hulu', 'Mokong',      -8.610, 117.390],
            ['Moyo Hulu', 'Lito',        -8.620, 117.400],
            ['Moyo Hulu', 'Leseng',      -8.660, 117.440],
            ['Moyo Hulu', 'Sebasang',    -8.700, 117.480],
            ['Moyo Hulu', 'Semamung',    -8.600, 117.380],
            ['Moyo Hulu', 'Berang Rea',  -8.630, 117.410],
            ['Moyo Hulu', 'Pernek',      -8.640, 117.420],
            ['Moyo Hulu', 'Batu Bulan',  -8.650, 117.430],
            ['Moyo Hulu', 'Sempe',       -8.670, 117.450],
            ['Moyo Hulu', 'Brang Belo',  -8.690, 117.470],
            ['Moyo Hulu', 'Liang',       -8.710, 117.490],

            // ── MOYO UTARA (6) ────────────────────────────────────────────────
            ['Moyo Utara', 'Baru Tahan', -8.450, 117.490],
            ['Moyo Utara', 'Kukin',      -8.440, 117.480],
            ['Moyo Utara', 'Pungkit',    -8.430, 117.470],
            ['Moyo Utara', 'Sebewe',     -8.470, 117.510],
            ['Moyo Utara', 'Songkar',    -8.420, 117.460],
            ['Moyo Utara', 'Penyaring',  -8.460, 117.500],

            // ── ORONG TELU (4) ────────────────────────────────────────────────
            ['Orong Telu', 'Kelawis',  -8.760, 117.150],
            ['Orong Telu', 'Sebeok',   -8.750, 117.140],
            ['Orong Telu', 'Senawang', -8.770, 117.160],
            ['Orong Telu', 'Muchir',   -8.780, 117.170],

            // ── PLAMPANG (11) ─────────────────────────────────────────────────
            ['Plampang', 'Plampang',       -8.260, 117.740],
            ['Plampang', 'Sepakat',        -8.300, 117.780],
            ['Plampang', 'Selante',        -8.290, 117.770],
            ['Plampang', 'Usar',           -8.230, 117.710],
            ['Plampang', 'Brang Kolong',   -8.270, 117.750],
            ['Plampang', 'Muer',           -8.280, 117.760],
            ['Plampang', 'SP I Plampang',  -8.310, 117.790],
            ['Plampang', 'SP II Plampang', -8.320, 117.800],
            ['Plampang', 'SP III Plampang',-8.240, 117.720],
            ['Plampang', 'Teluk Santong',  -8.330, 117.810],
            ['Plampang', 'Marga Mulya',    -8.250, 117.730],

            // ── RHEE (4) ──────────────────────────────────────────────────────
            ['Rhee', 'Rhee',      -8.710, 117.250],
            ['Rhee', 'Rhee Baru', -8.720, 117.260],
            ['Rhee', 'Luk',       -8.700, 117.240],
            ['Rhee', 'Sampe',     -8.690, 117.230],

            // ── ROPANG (4) ────────────────────────────────────────────────────
            ['Ropang', 'Ropang',    -8.790, 117.090],
            ['Ropang', 'Lawin',     -8.800, 117.100],
            ['Ropang', 'Lebangkar', -8.810, 117.110],
            ['Ropang', 'Ranan',     -8.820, 117.120],

            // ── TARANO (6) ────────────────────────────────────────────────────
            ['Tarano', 'Labuhan Bontong', -8.890, 117.830],
            ['Tarano', 'Bantulanteh',     -8.900, 117.840],
            ['Tarano', 'Labuhan Jontal',  -8.910, 117.850],
            ['Tarano', 'Labuhan Kanar',   -8.920, 117.860],
            ['Tarano', 'Mata',            -8.870, 117.810],
            ['Tarano', 'Labuhan Bajo',    -8.930, 117.870],

            // ── UNTER IWES (8) ────────────────────────────────────────────────
            ['Unter Iwes', 'Kerato',       -8.450, 117.370],
            ['Unter Iwes', 'Kerekeh',      -8.470, 117.390],
            ['Unter Iwes', 'Boak',         -8.460, 117.380],
            ['Unter Iwes', 'Nijang',       -8.440, 117.360],
            ['Unter Iwes', 'Pelat',        -8.480, 117.400],
            ['Unter Iwes', 'Uma Beringin', -8.490, 117.410],
            ['Unter Iwes', 'Pungka',       -8.430, 117.350],
            ['Unter Iwes', 'Jorok',        -8.420, 117.340],

            // ── UTAN (9) ──────────────────────────────────────────────────────
            ['Utan', 'Dalam',        -8.540, 117.040],
            ['Utan', 'Jorok',        -8.550, 117.050],
            ['Utan', 'Motong',       -8.580, 117.080],
            ['Utan', 'Bale Brang',   -8.560, 117.060],
            ['Utan', 'Pukat',        -8.590, 117.090],
            ['Utan', 'Sabedo',       -8.520, 117.020],
            ['Utan', 'Stowe Brang',  -8.600, 117.100],
            ['Utan', 'Labuhan Bajo', -8.530, 117.030],
            ['Utan', 'Orong Ramas',  -8.570, 117.070],
        ];

        foreach ($desas as [$kecamatan, $nama, $lat, $lng]) {
            MasterDesa::create([
                'nama_desa'          => $nama,
                'kecamatan'          => $kecamatan,
                'latitude'           => $lat,
                'longitude'          => $lng,
                'status_risiko'      => 'HIJAU',
                'pagu_anggaran'      => 0,
                'realisasi_anggaran' => 0,
                'tahun_anggaran'     => 2026,
                'is_active'          => true,
            ]);
        }
    }
}
