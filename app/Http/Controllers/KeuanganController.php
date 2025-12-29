<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keuangan;
use Carbon\Carbon;

class KeuanganController extends Controller
{
    public function index(Request $request)
{
    $request->validate([
        'start_date' => 'nullable|date',
        'end_date'   => 'nullable|date|after_or_equal:start_date',
    ]);

    $query = Keuangan::query();

    if ($request->start_date && $request->end_date) {

        $start = Carbon::parse($request->start_date)->startOfDay();
        $end   = Carbon::parse($request->end_date)->endOfDay();

        // 🔒 VALIDASI MAKSIMAL 1 BULAN
        if ($start->diffInDays($end) > 31) {
            return redirect()->back()
                ->withErrors(['range' => 'Rentang tanggal maksimal 1 bulan']);
        }

        $query->whereBetween('tanggal', [$start, $end]);
    }

    $data = $query->orderBy('tanggal', 'desc')->get();

    return view('keuangan.index', [
        'data' => $data,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date
    ]);
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
