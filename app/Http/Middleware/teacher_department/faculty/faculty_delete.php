<?php

namespace App\Http\Middleware\teacher_department\faculty;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class faculty_delete
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