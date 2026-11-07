<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuditTrail extends Model
{
    public $timestamps = false;

    protected $table = 'audit_trails';

    protected $fillable = [
        'user_id',
        'aksi',
        'model_type',
        'model_id',
        'data_lama',
        'data_baru',
        'ip_address',
        'user_agent',
        'keterangan',
        'created_at',
    ];

    protected function casts(): array
    {
        return [
            'data_lama' => 'array',
            'data_baru' => 'array',
            'created_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function catat(
        string $aksi,
        ?int $userId = null,
        ?string $modelType = null,
        ?int $modelId = null,
        ?array $dataLama = null,
        ?array $dataBaru = null,
        ?string $keterangan = null
    ): self {
        return static::create([
            'user_id' => $userId ?? auth()->id(),
            'aksi' => $aksi,
            'model_type' => $modelType,
            'model_id' => $modelId,
            'data_lama' => $dataLama,
            'data_baru' => $dataBaru,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'keterangan' => $keterangan,
            'created_at' => now(),
        ]);
    }
}
