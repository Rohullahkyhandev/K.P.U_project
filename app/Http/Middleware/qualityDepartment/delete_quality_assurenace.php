<?php

namespace App\Http\Middleware\qualityDepartment;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class delete_quality_assurenace
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
