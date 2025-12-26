<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\User;
use App\Models\MasterTagihan;
use App\Jobs\SendWhatsappJob;
use App\Models\Payment;


class TagihanController extends Controller
{
    public function create($user_id)
    {
        $warga = User::findOrFail($user_id);
        return view('tagihan.create', compact('warga'));
    }

    public function store(Request $req)
{
    $req->validate([
        'warga_id'     => 'required',
        'nama_tagihan' => 'required',
        'nominal'      => 'required|numeric',
        'jatuh_tempo'  => 'required|date',
    ]);

    $user = User::findOrFail($req->warga_id);

    // 1️⃣ SIMPAN TAGIHAN (LANGSUNG PENDING)
    $tagihan = Tagihan::create([
        'user_id'      => $user->id,
        'nama_tagihan' => $req->nama_tagihan,
        'nominal'      => $req->nominal,
        'jatuh_tempo'  => $req->jatuh_tempo,
        'status'       => 'pending', // ✅ penting
    ]);

    // 2️⃣ BUAT PAYMENT OTOMATIS
    Payment::create([
        'tagihan_id' => $tagihan->id,
        'user_id'    => $user->id,
        'status'     => 'pending',
    ]);

    // 3️⃣ KIRIM WA
    if ($user->no_hp) {

        $pesan =
"📢 *TAGIHAN RT/RW FONTANIA*

Yth. Bpk/Ibu *{$user->name}*

📄 Tagihan : {$tagihan->nama_tagihan}
💰 Nominal : Rp " . number_format($tagihan->nominal, 0, ',', '.') . "
📅 Jatuh Tempo : " . date('d-m-Y', strtotime($tagihan->jatuh_tempo)) . "

Status: ⏳ *Menunggu Verifikasi*
Terima kasih 🙏";

        SendWhatsappJob::dispatch(
            $user->no_hp,
            $pesan
        )->delay(now()->addSeconds(3));
    }

    return redirect()
        ->route('tagihan.index')
        ->with('success', 'Tagihan berhasil dikirim & menunggu verifikasi.');
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

    $query = User::where('role', 'warga')
                 ->where('approved', 1);

    if ($request->jenis_tagihan !== 'all') {
        $query->where('jenis_tagihan', $request->jenis_tagihan);
    }

    $users = $query->get();

    foreach ($users as $user) {

    $nominal = $user->jenis_tagihan === 'vip'
        ? $master->nominal_vip
        : $master->nominal_biasa;

    $tagihan = Tagihan::create([
        'user_id'      => $user->id,
        'nama_tagihan' => $master->nama_tagihan,
        'nominal'      => $nominal,
        'jatuh_tempo'  => $request->jatuh_tempo,
        'status'       => 'pending', // ✅
    ]);

    Payment::create([
        'tagihan_id' => $tagihan->id,
        'user_id'    => $user->id,
        'status'     => 'pending',
    ]);

    if ($user->no_hp) {

        $pesan =
"📢 *TAGIHAN RT/RW FONTANIA*

Yth. Bpk/Ibu *{$user->name}*

📄 Tagihan : {$master->nama_tagihan}
💰 Nominal : Rp " . number_format($nominal, 0, ',', '.') . "
📅 Jatuh Tempo : " . date('d-m-Y', strtotime($request->jatuh_tempo)) . "

Status: ⏳ *Menunggu Verifikasi*
Terima kasih 🙏";

        SendWhatsappJob::dispatch(
            $user->no_hp,
            $pesan
        )->delay(now()->addSeconds(3));
    }
}


    return back()->with(
        'success',
        'Tagihan berhasil dikirim. Notifikasi WA diproses di background.'
    );
}





}
