<?php

namespace App\Models;

use Database\Factories\MasterDesaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterDesa extends Model
{
    /** @use HasFactory<MasterDesaFactory> */
    use HasFactory;

    protected $table = 'master_desas';

    protected $fillable = [
        'kode_desa',
        'nama_desa',
        'kecamatan',
        'latitude',
        'longitude',
        'status_risiko',
        'pagu_anggaran',
        'realisasi_anggaran',
        'tahun_anggaran',
        'keterangan',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'latitude' => 'float',
            'longitude' => 'float',
            'pagu_anggaran' => 'float',
            'realisasi_anggaran' => 'float',
            'is_active' => 'boolean',
        ];
    }

    public function kewenanganDesas(): HasMany
    {
        return $this->hasMany(KewenanganDesa::class, 'desa_id');
    }

    public function pelaporans(): HasMany
    {
        return $this->hasMany(Pelaporan::class, 'desa_id');
    }

    public function getRisikoColorAttribute(): string
    {
        return match ($this->status_risiko) {
            'HIJAU' => 'success',
            'KUNING' => 'warning',
            'MERAH' => 'danger',
            default => 'secondary',
        };
    }

    public function getRisikoMarkerColorAttribute(): string
    {
        return match ($this->status_risiko) {
            'HIJAU' => 'green',
            'KUNING' => 'orange',
            'MERAH' => 'red',
            default => 'gray',
        };
    }

    public function getPaguFormattedAttribute(): string
    {
        return 'Rp '.number_format($this->pagu_anggaran, 0, ',', '.');
    }

    public function getRealisasiFormattedAttribute(): string
    {
        return 'Rp '.number_format($this->realisasi_anggaran, 0, ',', '.');
    }

    public function getPersentaseRealisasiAttribute(): float
    {
        if ($this->pagu_anggaran <= 0) {
            return 0;
        }

        return round(($this->realisasi_anggaran / $this->pagu_anggaran) * 100, 2);
    }

    /**
     * Jumlah laporan masuk untuk desa ini.
     */
    public function getJumlahLaporanAttribute(): int
    {
        return $this->pelaporans()->count();
    }
}
