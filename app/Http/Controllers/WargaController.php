<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MasterTagihan;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $warga = User::where('approved', 1)
            ->where('role', 'warga')
            ->when($search, function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('no_kk', 'like', "%{$search}%");
            })
            ->get();

        // ✅ MASTER TAGIHAN KAS BULANAN
        $kasBulanan = MasterTagihan::where('nama_tagihan', 'Kas Bulanan')->first();

        return view('data-warga', compact(
            'warga',
            'search',
            'kasBulanan'
        ));
    }

    public function detail($id)
    {
        $warga = User::findOrFail($id);
        return view('data-warga-detail', compact('warga'));
    }

    public function edit($id)
    {
        $warga = User::findOrFail($id);

        // ✅ kirim master tagihan ke form edit
        $kasBulanan = MasterTagihan::where('nama_tagihan', 'Kas Bulanan')->first();

        return view('data-warga-edit', compact('warga', 'kasBulanan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nik'            => 'required',
            'name'           => 'required',
            'no_kk'          => 'required',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required',
            'no_hp'          => 'required',
            'jenis_tagihan'  => 'required|in:biasa,vip',
        ]);

        $warga = User::findOrFail($id);

        $warga->update([
            'nik'           => $request->nik,
            'name'          => $request->name,
            'no_kk'         => $request->no_kk,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_hp'         => $request->no_hp,
            'jenis_tagihan' => $request->jenis_tagihan,
        ]);

        return redirect('/data-warga')
            ->with('success', 'Data warga berhasil diperbarui');
    }

    public function destroy($id)
    {
        User::destroy($id);

        return redirect('/data-warga')
            ->with('success', 'Data warga berhasil dihapus');
    }
}
