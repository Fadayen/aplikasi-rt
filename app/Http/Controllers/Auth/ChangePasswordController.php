<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function show()
    {
        return view('auth.change-password');
    }

    public function update(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        $user = auth()->user();

        $user->update([
            'password' => Hash::make($request->password),
            'force_password_change' => 0, // ✅ reset flag
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Password berhasil diganti.');
    }
}
