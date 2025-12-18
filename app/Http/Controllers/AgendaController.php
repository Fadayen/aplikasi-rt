<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;

class AgendaController extends Controller
{
    public function index()
    {
        $agenda = Agenda::all();
        return view('agenda.index', compact('agenda'));
    }

    public function create()
    {
        return view('agenda.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'tanggal' => 'required|date',
        ]);

        Agenda::create([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
        ]);

        return redirect('/dashboard/admin')->with('success', 'Agenda berhasil ditambahkan');
    }

    public function edit($id)
    {
        $agenda = Agenda::findOrFail($id);
        return view('agenda.edit', compact('agenda'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'tanggal' => 'required|date',
        ]);

        $agenda = Agenda::findOrFail($id);

        $agenda->update([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
        ]);

        return redirect('/dashboard/admin')->with('success', 'Agenda berhasil diperbarui');
    }

    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->delete();

        return redirect('/dashboard/admin')->with('success', 'Agenda berhasil dihapus');
    }
}
