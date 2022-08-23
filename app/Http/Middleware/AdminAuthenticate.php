<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            if (Auth::guard('admin')->check()) {
                return $next($request);
            } else {
                return redirect('/')->withSuccess('are not allowed to access');
            }
        } catch (Exception $e) {
            return redirect('/')->withSuccess('are not allowed to access');
        }
    }
}
