<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApprovedOnly
{
    public function handle(Request $request, Closure $next)
    {
        // Jika belum login → lempar ke login
        if (!auth()->check()) {
            return redirect('/login');
        }

        // Jika user belum approved → lempar ke dashboard
        if (auth()->user()->approved != 1) {
            return redirect('/dashboard')->with('error', 'Akun anda belum di-approve oleh admin.');
        }

        return $next($request);
    }
}
