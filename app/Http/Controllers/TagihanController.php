<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\User;

class TagihanController extends Controller
{
    public function create($user_id)
    {
        $warga = User::findOrFail($user_id);
        return view('tagihan.create', compact('warga'));
    }

    public function store(Request $req)
    {
        Tagihan::create([
            'user_id'      => $req->warga_id,
            'nama_tagihan' => $req->nama_tagihan,
            'nominal'      => $req->nominal,
            'jatuh_tempo'  => $req->jatuh_tempo,
            'status'       => 'belum_lunas',
        ]);

        return redirect()
            ->route('tagihan.index')
            ->with('success', 'Tagihan berhasil dikirim');
    }

    public function destroy($id)
{
    $tagihan = Tagihan::findOrFail($id);

    // Jika ingin menghapus juga record payment terkait:
    if ($tagihan->payment) {
        $tagihan->payment->delete();
    }

    $tagihan->delete();

    return back()->with('success', 'Tagihan berhasil dihapus');
}

}
