<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keuangan;

class KeuanganController extends Controller
{
    public function index()
    {
        $data = Keuangan::latest()->get();
        return view('keuangan.index', compact('data'));
    }

    public function create()
    {
        return view('keuangan.create');
    }

    public function store(Request $r)
    {
        $r->validate([
            'kegiatan' => 'required',
            'jumlah' => 'required|numeric',
            'jenis' => 'required',
            'tanggal' => 'required|date'
        ]);

        Keuangan::create($r->all());

        return redirect('/keuangan')->with('success', 'Data keuangan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = Keuangan::findOrFail($id);
        return view('keuangan.edit', compact('data'));
    }

    public function update(Request $r, $id)
    {
        $r->validate([
            'kegiatan' => 'required',
            'jumlah' => 'required|numeric',
            'jenis' => 'required',
            'tanggal' => 'required|date'
        ]);

        $data = Keuangan::findOrFail($id);
        $data->update($r->all());

        return redirect('/keuangan')->with('success', 'Data keuangan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Keuangan::destroy($id);
        return redirect('/keuangan')->with('success', 'Data berhasil dihapus!');
    }

    public function show($id)
    {
        $data = Keuangan::findOrFail($id);
        return view('keuangan.show', compact('data'));
    }
}
