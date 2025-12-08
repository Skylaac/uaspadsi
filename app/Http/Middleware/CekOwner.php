<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CekOwner
{
    public function handle($request, Closure $next)
    {

        if (!Auth::check() || Auth::user()->role !== 'owner') {
            return redirect('/dashboard')->with('error', 'Anda tidak punya akses!');
        }

        return $next($request);
    }
}
