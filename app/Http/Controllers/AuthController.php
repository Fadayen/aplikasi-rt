<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginProcess(Request $r)
    {
        $credentials = $r->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $r->session()->regenerate();
            $user = Auth::user();

            // LOGIN ADMIN
            if ($user->role === 'admin') {
                return redirect()->route('dashboard.admin');
            }

            // LOGIN WARGA
            if ($user->role === 'warga') {

                if ($user->approved != 1) {
                    Auth::logout();
                    return back()->with('error', 'Akun anda belum di-approve oleh admin.');
                }

                return redirect()->route('dashboard.warga');
            }

            // ROLE UNKNOWN
            Auth::logout();
            return redirect('/login')->with('error', 'Role tidak dikenali.');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    public function register()
    {
        return view('register');
    }

    public function registerProcess(Request $r)
    {
        // 🔒 VALIDASI (opsional, sangat disarankan)
        $r->validate([
            'username'          => 'required',
            'email'             => 'required|email|unique:users,email',
            'password'          => 'required|confirmed',
            'no_kk'             => 'required',
            'nik'               => 'required',
            'nama_lengkap'      => 'required',
            'tempat_lahir'      => 'required',
            'tanggal_lahir'     => 'required',
            'agama'             => 'required',
            'jenis_kelamin'     => 'required',
            'no_hp'             => 'required',
            'alamat'            => 'required',
        ]);

        User::create([
            'username'       => $r->username,
            'name'           => $r->nama_lengkap,
            'email'          => $r->email,
            'password'       => Hash::make($r->password),

            // 🔥 DATA PERSONAL
            'no_kk'          => $r->no_kk,
            'nik'            => $r->nik,
            'alamat'         => $r->alamat,
            'master_tagihan_id' => $r->master_tagihan_id,
            'no_hp'          => $r->no_hp,
            'tempat_lahir'   => $r->tempat_lahir,
            'tanggal_lahir'  => $r->tanggal_lahir,
            'agama'          => $r->agama,
            'jenis_kelamin'  => $r->jenis_kelamin,

            // DEFAULT ROLE
            'role'           => 'warga',
            'approved'       => 0,
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat. Tunggu persetujuan admin.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
