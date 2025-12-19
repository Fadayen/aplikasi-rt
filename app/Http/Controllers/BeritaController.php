<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Komentar;
use Carbon\Carbon;

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

    // =====================
    // SIMPAN BERITA BARU
    // =====================
    public function store(Request $r)
    {
        $r->validate([
            'judul'   => 'required',
            'isi'     => 'required',
            'penulis' => 'required',
            'gambar'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gambar = null;

        if ($r->hasFile('gambar')) {
            $gambar = $r->file('gambar')->store('berita', 'public');
        }

        Berita::create([
            'judul'   => $r->judul,
            'isi'     => $r->isi,
            'penulis' => $r->penulis,
            'tanggal' => Carbon::now()->toDateString(), // 🔥 TANGGAL OTOMATIS
            'gambar'  => $gambar,
        ]);

        return redirect()->route('berita.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    // =====================
    // FORM EDIT
    // =====================
    public function edit($id)
    {
        $data = Berita::findOrFail($id);
        return view('berita.edit', compact('data'));
    }

    // =====================
    // UPDATE BERITA
    // =====================
    public function update(Request $request, $id)
    {
        $data = Berita::findOrFail($id);

        $request->validate([
            'judul'   => 'required',
            'penulis' => 'required',
            'isi'     => 'required',
            'gambar'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Jika upload gambar baru
        if ($request->hasFile('gambar')) {

            // Hapus gambar lama
            if ($data->gambar && file_exists(storage_path('app/public/' . $data->gambar))) {
                unlink(storage_path('app/public/' . $data->gambar));
            }

            $data->gambar = $request->file('gambar')->store('berita', 'public');
        }

        $data->update([
            'judul'   => $request->judul,
            'penulis' => $request->penulis,
            'isi'     => $request->isi,
        ]);

        return redirect()->route('berita.index')
            ->with('success', 'Berita berhasil diperbarui');
    }

    // =====================
    // HAPUS BERITA
    // =====================
    public function destroy($id)
    {
        $data = Berita::findOrFail($id);

        if ($data->gambar && file_exists(storage_path('app/public/' . $data->gambar))) {
            unlink(storage_path('app/public/' . $data->gambar));
        }

        $data->delete();

        return redirect()->route('berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }

    // =====================
    // DETAIL BERITA
    // =====================
    public function show($id)
    {
        $data = Berita::findOrFail($id);

        $komentar = Komentar::where('berita_id', $id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('berita.show', compact('data', 'komentar'));
    }

    // =====================
    // KOMENTAR
    // =====================
    public function komentar(Request $r, $id)
    {
        $r->validate([
            'isi' => 'required',
        ]);

        Komentar::create([
            'berita_id' => $id,
            'isi'       => $r->isi,
            'nama'      => auth()->user()->name ?? 'Anonim',
        ]);

        return back()->with('success', 'Komentar berhasil dikirim!');
    }
}
