<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'komentar'; // atau "komentars" jika tabelnya jamak

    protected $fillable = [
        'berita_id',
        'nama',
        'isi'
    ];

    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }
}
