<?php

namespace App\Models;

use Database\Factories\KewenanganDesaFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KewenanganDesa extends Model
{
    /** @use HasFactory<KewenanganDesaFactory> */
    use HasFactory;

    protected $table = 'kewenangan_desas';

    protected $fillable = [
        'user_id',
        'desa_id',
        'level_akses',
        'berlaku_mulai',
        'berlaku_sampai',
        'assigned_by',
    ];

    protected function casts(): array
    {
        return [
            'berlaku_mulai' => 'datetime',
            'berlaku_sampai' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function desa(): BelongsTo
    {
        return $this->belongsTo(MasterDesa::class, 'desa_id');
    }

    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function isMasihBerlaku(): bool
    {
        if ($this->berlaku_sampai === null) {
            return true;
        }

        return $this->berlaku_sampai->isFuture();
    }
}
