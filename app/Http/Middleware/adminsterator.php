<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class adminsterator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        foreach (Auth::user()->permissions as $permission) {
            if ($permission->permission_name == 'administrator') {
                return $next($request);
            }
        }
        return response([
            'message' => 'شما صلاحیت کامل برای انجام این کار را نداید'
        ], 403);
    }
}
