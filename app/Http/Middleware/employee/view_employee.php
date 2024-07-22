<?php

namespace App\Http\Middleware\employee;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class view_employee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        foreach (Auth::user()->permissions  as $permission) {
            if ($permission->name == 'view_employee') {
                return $next($request);
            }
        }
        return response([
            'error' => 'شما صلاحیت برای انجام این کار ندارید'
        ], 304);
    }
}
