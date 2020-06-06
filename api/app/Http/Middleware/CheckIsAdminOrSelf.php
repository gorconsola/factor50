<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIsAdminOrSelf
{
    public function handle($request, Closure $next)
    {
        $requestedUserId = $request->route()->parameter('id');

        if (! $this->isAdminOrSelf($requestedUserId)) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        return $next($request);
    }


    private function isAdminOrSelf ($requestedUserId)
    {
        return Auth::user()->userRole->slug === 'admin' ||
            Auth::user()->id == $requestedUserId;
    }
}
