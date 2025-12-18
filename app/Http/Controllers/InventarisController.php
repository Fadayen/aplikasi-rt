<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventaris;

class InventarisController extends Controller
{
    public function index()
    {
        $data = Inventaris::latest()->get();
        return view('inventaris.index', compact('data'));
    }

    public function create()
    {
        return view('inventaris.create');
    }

    public function store(Request $r)
    {
        $r->validate([
            'nama_barang' => 'required',
            'jumlah' => 'required|numeric',
            'lokasi' => 'required',
            'tanggal_masuk' => 'required|date',
            'kondisi' => 'required'
        ]);

        Inventaris::create($r->all());

        return redirect('/inventaris')->with('success', 'Data inventaris berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $item = Inventaris::findOrFail($id);
        return view('inventaris.edit', compact('item'));
    }

     public function update(Request $request, $id)
    {
        $item = Inventaris::findOrFail($id);

        $request->validate([
            'nama_barang' => 'required',
            'tipe' => 'nullable|string',
            'jumlah' => 'required|integer',
            'lokasi' => 'nullable|string',
            'tanggal_masuk' => 'required|date',
            'kondisi' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);

        $item->update($request->all());

        return redirect('/inventaris')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = Inventaris::findOrFail($id);
        $item->delete();

        return redirect('/inventaris')->with('success', 'Data berhasil dihapus.');
    }

    public function show($id)
    {
        $item = Inventaris::findOrFail($id);
        return view('inventaris.show', compact('item'));
    }

}
