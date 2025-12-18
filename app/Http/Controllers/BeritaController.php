<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Komentar;

class BeritaController extends Controller
{
    public function index()
    {
        $data = Berita::latest()->get();
        return view('berita.index', compact('data'));
    }

    public function create()
    {
        return view('berita.create');
    }

    public function store(Request $r)
{
    $r->validate([
        'judul'   => 'required',
        'isi'     => 'required',
        'penulis' => 'required',
        'gambar'  => 'nullable|image|max:2048'
    ]);

    $namaGambar = null;

    if ($r->hasFile('gambar')) {
        // Simpan ke storage/app/public/berita
        $namaGambar = $r->file('gambar')->store('berita', 'public');
    }

    Berita::create([
        'judul'   => $r->judul,
        'isi'     => $r->isi,
        'penulis' => $r->penulis,
        'gambar'  => $namaGambar
    ]);

    return redirect('/berita')->with('success', 'Berita berhasil ditambahkan!');
}


    public function edit($id)
    {
        $data = Berita::findOrFail($id);
        return view('berita.edit', compact('data'));
    }

    public function update(Request $request, $id)
{
    $data = Berita::findOrFail($id);

    $request->validate([
        'judul' => 'required',
        'penulis' => 'required',
        'isi' => 'required',
        'gambar' => 'image|mimes:jpg,jpeg,png,gif|max:2048'
    ]);

    // Update gambar jika ada file baru
    if ($request->hasFile('gambar')) {

        // Hapus file lama
        if ($data->gambar && file_exists(storage_path('app/public/' . $data->gambar))) {
            unlink(storage_path('app/public/' . $data->gambar));
        }

        // Simpan file baru
        $data->gambar = $request->file('gambar')->store('berita', 'public');
    }

    // Update data lain
    $data->update([
        'judul' => $request->judul,
        'penulis' => $request->penulis,
        'isi' => $request->isi,
    ]);

    return redirect()->route('berita.index')->with('success', 'Berita berhasil diperbarui');
}


    public function destroy($id)
    {
        Berita::destroy($id);
        return redirect('/berita')->with('success', 'Berita berhasil dihapus!');
    }

    public function show($id)
{
    $data = Berita::findOrFail($id);

    $komentar = Komentar::where('berita_id', $id)
                ->orderBy('created_at', 'asc')
                ->get();

    return view('berita.show', compact('data', 'komentar'));
}



    // ===========================
    // TAMBAHAN: Function Komentar
    // ===========================
   public function komentar(Request $r, $id)
{
    $r->validate([
        'isi' => 'required'
    ]);

    Komentar::create([
        'berita_id' => $id,
        'isi'       => $r->isi,   // sesuai name di form
        'nama'      => auth()->user()->name ?? 'Anonim'
    ]);

    return redirect()->back()->with('success', 'Komentar berhasil dikirim!');
}

}
