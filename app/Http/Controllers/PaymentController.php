<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\Payment;

class PaymentController extends Controller
{
    // ===============================
    // WARGA - LIHAT DAFTAR TAGIHAN
    // ===============================
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $tagihan = Tagihan::with(['user', 'payment'])->latest()->get();
        } else {
            $tagihan = Tagihan::with('payment')
                ->where('user_id', auth()->id())
                ->latest()
                ->get();
        }

        return view('payment.tagihan', compact('tagihan'));
    }

    // ===============================
    // WARGA - FORM BAYAR
    // ===============================
    public function create($id)
    {
        $tagihan = Tagihan::where('id', $id)
                    ->where('user_id', auth()->id())
                    ->firstOrFail();

        return view('payment.create', compact('tagihan'));
    }

    // ===============================
    // WARGA - UPLOAD BUKTI BAYAR
    // ===============================
    public function upload(Request $request, $id)
    {
        $request->validate([
            'bukti_bayar' => 'required|image|max:2048'
        ]);

        $file = $request->file('bukti_bayar')->store('bukti', 'public');

        Payment::updateOrCreate(
            [
                'tagihan_id' => $id,
                'user_id' => auth()->id(),
            ],
            [
                'bukti_bayar' => $file,
                'status' => 'pending',
                'catatan' => null,
            ]
        );

        // SET STATUS TAGIHAN JADI PENDING
        Tagihan::where('id', $id)->update([
            'status' => 'pending'
        ]);

        return redirect()
            ->route('tagihan.index')
            ->with('success', 'Bukti pembayaran berhasil dikirim dan menunggu verifikasi.');
    }



    // ===========================================================================
    // ADMIN - VERIFIKASI PEMBAYARAN (APPROVE / REJECT)
    // ===========================================================================
     public function verifikasi(Request $request, $payment_id)
    {
        $payment = Payment::findOrFail($payment_id);
        $tagihan = Tagihan::findOrFail($payment->tagihan_id);

        if ($request->status === 'approve') {
            $payment->update([
                'status' => 'verified',   // FIX!
                'catatan' => $request->catatan
            ]);

            $tagihan->update(['status' => 'lunas']);
        }

        if ($request->status === 'reject') {
            $payment->update([
                'status' => 'rejected',
                'catatan' => $request->catatan
            ]);

            $tagihan->update(['status' => 'belum_lunas']);
        }

        return back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}
