<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIsAdmin
{
    public function handle($request, Closure $next)
    {
        if (! $this->isAdmin()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        return $next($request);
    }


    private function isAdmin ()
    {
        return Auth::user()->userRole->slug === 'admin';
    }
}