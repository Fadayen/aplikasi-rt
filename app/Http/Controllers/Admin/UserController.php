<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Services\WhatsappService;

class UserController extends Controller
{
    public function resetPassword(Request $request, User $user)
    {
        // ✅ VALIDASI
        $request->validate([
            'admin_password' => 'required',
        ]);

        // ✅ CEK PASSWORD ADMIN
        if (!Hash::check($request->admin_password, auth()->user()->password)) {
            return back()->with('error', 'Password admin salah.');
        }

        // 🔐 Generate password baru
        $newPassword = Str::random(8);

        // 🔒 Simpan ke DB
        $user->update([
            'password' => Hash::make($newPassword),
            'force_password_change' => 1,
        ]);

        // 📲 KIRIM KE WA WARGA
        WhatsappService::send(
        $user->no_hp,
        "🔐 *RESET PASSWORD AKUN RT/RW*\n\n"
        ."Nama: {$user->name}\n"
        ."Password sementara: *{$newPassword}*\n\n"
        ."Silakan login, Anda akan diminta mengganti password."
    );

        return back()->with(
            'success',
            'Password berhasil direset dan dikirim ke WhatsApp warga.'
        );
    }
}

