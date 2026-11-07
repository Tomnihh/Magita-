<?php

namespace App\Models;

use Database\Factories\PelaporanFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelaporan extends Model
{
    /** @use HasFactory<PelaporanFactory> */
    use HasFactory;

    protected $table = 'pelaporans';

    protected $fillable = [
        'kode_laporan',
        'desa_id',
        'pelapor_id',
        'is_anonim',
        'nama_pelapor_terenkripsi',
        'no_wa_terenkripsi',
        'judul_laporan',
        'isi_laporan',
        'bukti_url',
        'kategori',
        'status',
        'tindak_lanjut',
        'kanal',
    ];

    protected $hidden = [
        'nama_pelapor_terenkripsi',
        'no_wa_terenkripsi',
    ];

    protected function casts(): array
    {
        return [
            'is_anonim' => 'boolean',
        ];
    }

    public function desa(): BelongsTo
    {
        return $this->belongsTo(MasterDesa::class, 'desa_id');
    }

    public function pelapor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pelapor_id');
    }

    public function buktis(): HasMany
    {
        return $this->hasMany(BuktiPelaporan::class, 'pelaporan_id')->orderBy('urutan');
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'BARU' => 'primary',
            'DIPROSES' => 'warning',
            'SELESAI' => 'success',
            'DITOLAK' => 'danger',
            default => 'secondary',
        };
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Pelaporan $model): void {
            if (empty($model->kode_laporan)) {
                $model->kode_laporan = 'LAP-'.strtoupper(uniqid());
            }
        });
    }
}
