<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class BuktiPelaporan extends Model
{
    protected $table = 'bukti_pelaporans';

    protected $fillable = [
        'pelaporan_id',
        'file_path',
        'file_name',
        'mime_type',
        'file_size',
        'keterangan',
        'urutan',
    ];

    protected function casts(): array
    {
        return [
            'file_size' => 'integer',
            'urutan' => 'integer',
        ];
    }

    public function pelaporan(): BelongsTo
    {
        return $this->belongsTo(Pelaporan::class, 'pelaporan_id');
    }

    public function getUrlAttribute(): string
    {
        return Storage::url($this->file_path);
    }

    public function isGambar(): bool
    {
        return str_starts_with($this->mime_type ?? '', 'image/');
    }

    public function getUkuranFormattedAttribute(): string
    {
        $bytes = $this->file_size ?? 0;
        if ($bytes >= 1_048_576) {
            return round($bytes / 1_048_576, 1).' MB';
        }

        return round($bytes / 1024, 1).' KB';
    }
}
