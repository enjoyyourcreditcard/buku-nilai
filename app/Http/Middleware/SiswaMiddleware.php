<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SiswaMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('siswa_id')) {
            return redirect('/siswa/login');
        }

        return $next($request);
    }
}