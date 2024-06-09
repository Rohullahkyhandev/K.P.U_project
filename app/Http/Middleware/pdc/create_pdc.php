<?php

namespace App\Http\Middleware\pdc;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class create_pdc
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request);
    }
}
