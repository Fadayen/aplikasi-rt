<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
use App\Models\User;

class Tagihan extends Model
{
    protected $fillable = [
        'user_id','nama_tagihan','nominal','jatuh_tempo','status'
    ];

    // App\Models\Tagihan.php
public function payment()
{
    return $this->hasOne(Payment::class, 'tagihan_id');
}



    // FIX: relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
