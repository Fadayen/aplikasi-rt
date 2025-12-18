<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $fillable = [
    'user_id',
    'no_surat',
    'username',
    'alamat',
    'tanggal',
    'status_kawin',
    'pelayanan',
    'pekerjaan',
    'status',
    'file_surat'
];

}
