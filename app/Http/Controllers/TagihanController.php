<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\User;
use App\Models\MasterTagihan;

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

public function kirimMassal(Request $request)
{
    $request->validate([
        'master_id'     => 'required',
        'jenis_tagihan' => 'required|in:all,biasa,vip',
        'jatuh_tempo'   => 'required|date',
    ]);

    $master = MasterTagihan::findOrFail($request->master_id);

    // QUERY DASAR
    $query = User::where('role', 'warga')
                 ->where('approved', 1);

    // 🔥 FILTER TARGET
    if ($request->jenis_tagihan !== 'all') {
        $query->where('jenis_tagihan', $request->jenis_tagihan);
    }

    $users = $query->get();

    foreach ($users as $user) {

        // Ambil nominal sesuai jenis tagihan
        $nominal = $user->jenis_tagihan === 'vip'
            ? $master->nominal_vip
            : $master->nominal_biasa;

        Tagihan::create([
            'user_id'      => $user->id,
            'nama_tagihan' => $master->nama_tagihan,
            'nominal'      => $nominal,
            'jatuh_tempo'  => $request->jatuh_tempo,
            'status'       => 'belum_lunas',
        ]);
    }

    return back()->with(
        'success',
        'Tagihan berhasil dikirim ke ' . $users->count() . ' warga'
    );
}



}
