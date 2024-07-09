<?php

namespace App\Http\Middleware\teacherDepartment;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class edit_teacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        foreach (Auth::user()->permissions as $permission) {
            if ($permission->permission_name == 'edit_teacher_department') {
                return $next($request);
            }
        }
        return response([
            'message' => 'شما صلاحیت کامل برای انجام این کار را ندارید'
        ], 403);
    }
}
