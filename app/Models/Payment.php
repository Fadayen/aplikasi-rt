<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tagihan;

class Payment extends Model
{
    protected $fillable = [
        'tagihan_id',
        'user_id',
        'bukti_bayar',
        'status',
        'catatan'
    ];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'tagihan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
