<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index(Request $request)
{
    // Ambil nilai search dari input GET
    $search = $request->input('search');

    // Query utama
    $warga = User::where('approved', 1)
                ->where('role', 'warga')
                ->when($search, function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%")
                          ->orWhere('nik', 'like', "%{$search}%")
                          ->orWhere('no_kk', 'like', "%{$search}%");
                    });
                })
                ->get();

    return view('data-warga', compact('warga', 'search'));
}


    public function detail($id)
    {
        $warga = User::findOrFail($id);
        return view('data-warga-detail', compact('warga'));
    }

    public function edit($id)
    {
        $warga = User::findOrFail($id);
        return view('data-warga-edit', compact('warga'));
    }

    public function update(Request $request, $id)
    {
        $warga = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'nik' => 'required',
            'no_kk' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
        ]);

        $warga->update($request->all());

        return redirect('/data-warga')->with('success', 'Data warga berhasil diperbarui!');
    }

    public function destroy($id)
    {
        User::destroy($id);

        return redirect('/data-warga')->with('success', 'Data warga berhasil dihapus!');
    }
}
