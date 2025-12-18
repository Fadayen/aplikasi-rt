<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Menampilkan daftar pendaftar yang masih pending
     */
    public function pendaftar()
    {
        $users = User::where('status', 'pending')->get();

        return view('admin.pendaftar', compact('users'));
    }

    /**
     * Approve warga
     */
    public function approve($id)
{
    $user = User::findOrFail($id);
    $user->status = 'approved';
    $user->save();

    return back()->with('success', 'Warga berhasil di-approve!');
}

    /**
     * Optional: Tolak warga
     */
    public function decline($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return back()->with('success', 'Warga berhasil di-decline!');
}
}
