<?php

namespace App\Http\Middleware\pdc\plan;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class plan_delete
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
