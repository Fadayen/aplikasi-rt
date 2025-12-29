<?php

namespace App\Http\Controllers;

use App\Models\MasterTagihan;
use Illuminate\Http\Request;

class MasterTagihanController extends Controller
{
    public function update(Request $request)
{
    $request->validate([
        'id'            => 'required|exists:master_tagihans,id',
        'nominal_biasa' => 'required|numeric|min:0',
        'nominal_vip'   => 'required|numeric|min:0',
    ]);

    $tagihan = MasterTagihan::findOrFail($request->id);

    $tagihan->update([
        'nominal_biasa' => $request->nominal_biasa,
        'nominal_vip'   => $request->nominal_vip,
    ]);

    return back()->with('success', 'Nominal kas bulanan berhasil diperbarui');
}

}
