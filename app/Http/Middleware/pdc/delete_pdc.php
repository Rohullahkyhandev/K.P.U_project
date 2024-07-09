<?php

namespace App\Http\Middleware\pdc;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class delete_pdc
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        foreach (Auth::user()->permissions as $permission) {
            if ($permission->permission_name == 'delete_pdc') {
                return $next($request);
            }
        }
        return response([
            'message' => 'شما صلاحیت کامل برای انجام این کار را ندارید'
        ], 403);
    }
}
