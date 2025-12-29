<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTagihan extends Model
{
    use HasFactory;

    protected $table = 'master_tagihans';

    protected $fillable = [
        'nama_tagihan',
        'nominal_biasa',
        'nominal_vip',
        'aktif',
    ];

    public function tagihans()
    {
        return $this->hasMany(Tagihan::class, 'master_id');
    }
}
