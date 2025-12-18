<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agenda;
use App\Models\Tagihan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
{
    // total warga
    $totalWarga = User::where('role', 'warga')->count();

    // agenda bulan ini
    $agendaBulanIni = Agenda::whereMonth('tanggal', now()->month)
        ->whereYear('tanggal', now()->year)
        ->count();

    // ============================
    // TAGIHAN TERTUNGGAK
    // ============================

    if (Auth::user()->role === 'admin') {

        // ADMIN: semua tagihan yang belum lunas / ditolak
        $tagihanTertunggak = Tagihan::where(function ($q) {
            $q->whereDoesntHave('payment')
              ->orWhereHas('payment', function ($p) {
                  $p->where('status', 'rejected');
              });
        })->count();

    } else {

        // WARGA: hanya tagihan milik sendiri
        $tagihanTertunggak = Tagihan::where('user_id', auth()->id())
            ->where(function ($q) {
                $q->whereDoesntHave('payment')
                  ->orWhereHas('payment', function ($p) {
                      $p->where('status', 'rejected');
                  });
            })->count();
    }

    return view('dashboard', compact(
        'totalWarga',
        'agendaBulanIni',
        'tagihanTertunggak'
    ));
}


    public function warga()
    {
        // dashboard khusus warga (kalau mau beda view nanti)
        return $this->index();
    }
}
