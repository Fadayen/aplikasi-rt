<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agenda;
use App\Models\Surat;
use App\Models\Keuangan;
use App\Models\Inventaris;
use App\Models\Payment;
use App\Models\Tagihan;


class DashboardControllerAdmin extends Controller
{
    public function index()
{
    return view('dashboard.admin', [

        // approval warga
        'pendingWarga' => User::where('approved', 0)->get(),

        // surat pending
        'pendingSurat' => Surat::where('status', 'pending')->get(),

        // agenda
        'agenda' => Agenda::latest()->get(),

        // keuangan
        'totalMasuk'  => Keuangan::where('jenis', 'pemasukan')->sum('jumlah'),
        'totalKeluar' => Keuangan::where('jenis', 'pengeluaran')->sum('jumlah'),


        // inventaris
        'inventaris' => Inventaris::all(),

        // warga
        'wargas' => User::where('role', 'warga')->get(),

        // ✅ TAGIHAN + RELASI PAYMENT & USER
        'tagihans' => Tagihan::with(['payment', 'user'])->get(),
    ]);
}

    public function approve($id)
    {
        $user = User::findOrFail($id);
        $user->approved = 1;
        $user->save();

        return redirect()->back()->with('success', 'User berhasil di-approve!');
    }

    public function decline($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'Warga berhasil di-decline!');
    }

    // Upload file surat
    public function uploadFile(Request $request, $id)
    {
        $request->validate([
            'file_surat' => 'required|mimes:pdf|max:2048'
        ]);

        $surat = Surat::findOrFail($id);

        $file = $request->file('file_surat');
        $fileName = 'surat_' . $id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('surat', $fileName, 'public');

        $surat->update([
            'file_surat' => $fileName,
            'status' => 'selesai'
        ]);

        return back()->with('success', 'File berhasil diupload!');
    }

    // ⭐ ADMIN VERIFIKASI PEMBAYARAN
    public function verify($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update(['status' => 'verified']);

        // Ubah status tagihan menjadi lunas
        $payment->tagihan->update(['status' => 'lunas']);

        return back()->with('success', 'Pembayaran diverifikasi!');
    }

    // ⭐ ADMIN REJECT PEMBAYARAN
    public function reject(Request $request, $id)
    {
        Payment::findOrFail($id)->update([
            'status' => 'rejected',
            'catatan' => $request->catatan
        ]);

        return back()->with('success', 'Pembayaran ditolak!');
    }
}
