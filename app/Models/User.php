<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'no_kk',
        'nik',
        'alamat',
        'no_hp',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'jenis_kelamin',
        'jenis_tagihan',
        'role',
        'approved',
        'force_password_change',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function masterTagihan()
{
    return $this->belongsTo(MasterTagihan::class, 'master_tagihan_id');
}

public function getNominalTagihanAttribute()
{
    if (!$this->masterTagihan) return 0;

    return $this->tipe_rumah === 'vip'
        ? $this->masterTagihan->nominal_vip
        : $this->masterTagihan->nominal_biasa;
}



}

