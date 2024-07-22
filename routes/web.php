<?php

use App\Exports\TeacherInScholarship;
use App\Exports\TeachersExport;
use App\Http\Controllers\PDC\TeacherInCommitController;
use App\Http\Controllers\PDC\TeacherInSchalarshipController;
use App\Http\Controllers\postgraduated\StudentResearchController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherReportController;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\FlareClient\View;
use Symfony\Component\CssSelector\Node\FunctionNode;
use Symfony\Component\Routing\Route as RoutingRoute;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get("/report", [TeacherController::class, 'downloadTeacher']);

// pdc all report route
Route::get('/pdc/report/teacher_in_commit/{type?}/{report_data?}', [TeacherInCommitController::class, 'generateReport']);
Route::get('/pdc/report/teacher_in_scholarship/{format_type?}/{year?}', [TeacherInSchalarshipController::class, 'generateReport']);

// test teacher report
Route::get('teacher/report', [TeacherReportController::class, 'generateReport']);
Route::get('post/teacher/{id}', [StudentResearchController::class, 'getTeacherData']);
// pdc testing
Route::get('/pdc/testing/{year}', [TeacherInSchalarshipController::class, 'getTeacherInScholarship']);
