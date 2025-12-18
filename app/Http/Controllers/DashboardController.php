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
        // total warga (role warga)
        $totalWarga = User::where('role', 'warga')->count();

        // agenda bulan ini
        $agendaBulanIni = Agenda::whereMonth('tanggal', now()->month)
                                ->whereYear('tanggal', now()->year)
                                ->count();

        // tagihan tertunggak (default per user)
        $tagihanTertunggak = Tagihan::where('user_id', auth()->id())
                            ->where('status', 'belum_lunas')
                            ->count();


        // jika admin, lihat semua tagihan
        if (Auth::user()->role === 'admin') {
            $tagihanTertunggak = Tagihan::where('status', 'belum')->count();
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
