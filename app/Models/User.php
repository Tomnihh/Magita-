<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nik',
        'nama_lengkap',
        'email',
        'password',
        'no_whatsapp',
        'foto_ktp_url',
        'role',
        'status_akun',
        'catatan_verifikasi',
        'verified_by',
        'verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdminInspektorat(): bool
    {
        return $this->role === 'ADMIN_INSPEKTORAT';
    }

    public function isWarga(): bool
    {
        return $this->role === 'WARGA';
    }

    public function isAktif(): bool
    {
        return $this->status_akun === 'AKTIF';
    }

    public function isPending(): bool
    {
        return $this->status_akun === 'PENDING';
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function kewenanganDesas(): HasMany
    {
        return $this->hasMany(KewenanganDesa::class, 'user_id');
    }

    public function pelaporans(): HasMany
    {
        return $this->hasMany(Pelaporan::class, 'pelapor_id');
    }

    public function auditTrails(): HasMany
    {
        return $this->hasMany(AuditTrail::class, 'user_id');
    }
}
