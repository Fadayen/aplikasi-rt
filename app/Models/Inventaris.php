<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $fillable = [
        'nama_barang',
        'tipe',
        'jumlah',
        'lokasi',
        'tanggal_masuk',
        'kondisi',
        'keterangan'
    ];
}
