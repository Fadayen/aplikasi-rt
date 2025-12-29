<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function resetPassword(Request $request, User $user)
    {
        // ✅ Validasi password admin
        $request->validate([
            'admin_password' => 'required',
        ]);

        // ✅ Cek password admin
        if (!Hash::check($request->admin_password, auth()->user()->password)) {
            return back()->with('error', 'Password admin salah.');
        }

        // ✅ Pastikan target adalah warga
        if ($user->role !== 'warga') {
            abort(403, 'Target bukan warga');
        }

        // 🔐 Password default
        $defaultPassword = '123456';

        // 🔒 Update password warga
        $user->update([
            'password' => Hash::make($defaultPassword),
            'force_password_change' => 1, // wajib ganti saat login
        ]);

        return back()->with(
            'success',
            'Password warga berhasil direset menjadi 123456.'
        );
    }
}
