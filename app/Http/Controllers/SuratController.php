<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use Illuminate\Support\Facades\Auth;


class SuratController extends Controller
{
    public function index(Request $request)
{
    $user = auth()->user();
    $query = Surat::query();

    // 🔐 Jika BUKAN admin, hanya lihat surat milik sendiri
    if ($user->role !== 'admin') {
        $query->where('user_id', $user->id);
    }

    // 🔎 Search
    if ($request->search) {
        $query->where(function ($q) use ($request) {
            $q->where('username', 'like', "%{$request->search}%")
              ->orWhere('no_surat', 'like', "%{$request->search}%");
        });
    }

    // 📌 Filter status
    if ($request->status) {
        $query->where('status', $request->status);
    }

    $surat = $query->get();

    return view('data-surat', compact('surat'));
}



    public function create()
    {
        return view('form-surat');
    }

    public function store(Request $r)
    {
        $r->validate([
            'no_surat' => 'required',
            'username' => 'required',
            'alamat' => 'required',
            'tanggal' => 'required|date',
            'status_kawin' => 'required',
            'pelayanan' => 'required',
            'pekerjaan' => 'required',
        ]);

        Surat::create([
            'user_id'  => Auth::id(),
            'no_surat' => $r->no_surat,
            'username' => $r->username,
            'alamat' => $r->alamat,
            'tanggal' => $r->tanggal,
            'status_kawin' => $r->status_kawin,
            'pelayanan' => $r->pelayanan,
            'pekerjaan' => $r->pekerjaan,
            'status' => 'pending',  // default
        ]);

        return redirect()->route('surat.index')->with('success', 'Data berhasil disimpan!');
    }

    public function edit($id)
    {
        $data = Surat::findOrFail($id);
        return view('edit-surat', compact('data'));
    }

    public function update(Request $r, $id)
    {
        $r->validate([
            'no_surat' => 'required',
            'username' => 'required',
            'alamat' => 'required',
            'tanggal' => 'required|date',
            'status_kawin' => 'required',
            'pelayanan' => 'required',
            'pekerjaan' => 'required',
            'status' => 'required'
        ]);

        $data = Surat::findOrFail($id);

        $data->update([
            'no_surat' => $r->no_surat,
            'username' => $r->username,
            'alamat' => $r->alamat,
            'tanggal' => $r->tanggal,
            'status_kawin' => $r->status_kawin,
            'pelayanan' => $r->pelayanan,
            'pekerjaan' => $r->pekerjaan,
            'status' => $r->status
        ]);

        return redirect()->route('surat.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = Surat::findOrFail($id);
        $data->delete();

        return redirect()->route('surat.index')->with('success', 'Data berhasil dihapus!');
    }

    // Fitur validasi status
    public function validasi($id)
    {
        $data = Surat::findOrFail($id);
        $data->update(['status' => 'validated']);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil divalidasi!');
    }

    // Download file
    public function download($id)
{
    $surat = Surat::findOrFail($id);

    $filePath = storage_path("app/public/surat/" . $surat->file_surat);

    if (!file_exists($filePath)) {
        return back()->with('error', 'File tidak ditemukan!');
    }

    return response()->download($filePath);
}



public function uploadFile(Request $request, $id)
{
    $request->validate([
        'file_surat' => 'required|mimes:pdf,jpg,jpeg,png|max:2048'
    ]);

    $surat = Surat::findOrFail($id);

    $filename = time() . '_' . $request->file('file_surat')->getClientOriginalName();
    $request->file('file_surat')->storeAs('surat', $filename, 'public');

    $surat->update([
        'file_surat' => $filename
    ]);

    return back()->with('success', 'Dokumen berhasil diupload!');
}




}
