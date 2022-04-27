<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role != 3) {
            abort('404');
        }

        return $next($request);
    }
}
