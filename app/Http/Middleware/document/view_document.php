<?php

namespace App\Http\Middleware\document;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class view_document
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
