<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    protected $table = 'warga';    // pastikan nama tabel sesuai
    protected $primaryKey = 'id';  // ganti jika primary key bukan 'id'

    protected $fillable = [
        'no_kk',
        'nik',
        'name',
        'tanggal_lahir',
        'jenis_kelamin',
        'tempat_lahir',
        'agama',
        'alamat',
        'no_hp',
    ];
}
