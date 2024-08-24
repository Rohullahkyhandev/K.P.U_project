<?php

use App\Exports\TeacherInScholarship;
use App\Exports\TeachersExport;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PDC\TeacherInCommitController;
use App\Http\Controllers\PDC\TeacherInSchalarshipController;
use App\Http\Controllers\postgraduated\BoardMemberController;
use App\Http\Controllers\postgraduated\CommitteeMemberController;
use App\Http\Controllers\postgraduated\studentController;
use App\Http\Controllers\postgraduated\StudentResearchController;
use App\Http\Controllers\researchDepartment\TeacherResearchController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherReportController;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Teacher;
use Barryvdh\DomPDF\Facade\Pdf;
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



// test generate pdf file
Route::get('/test/pdf', function () {
    $pdf = Pdf::loadView('reports.teacher_personal_details');
    return $pdf->download('test.pdf');
});

Route::get('/teacher/info', [TeacherReportController::class, 'generateTeacherInformationReport']);

// teacher route

// teacher report
// Route::get("/teacher/report/{type?}", [TeacherReportController::class, 'generateReport']);
Route::get("/teacher/report", [TeacherReportController::class, 'test']);

// pdc all report route*
Route::get('/pdc/report/teacher_in_commit/{type?}/{report_data?}', [TeacherInCommitController::class, 'generateReport']);
Route::get('/pdc/report/teacher_in_scholarship/{format_type?}/{year?}', [TeacherInSchalarshipController::class, 'generateReport']);

// post graduated report*
Route::get('/student/report/{type?}/{report_data?}/{status?}', [studentController::class, 'generateStudentReport']);
Route::get('/postgraduated/report/board_member/{type?}/{report_data?}', [BoardMemberController::class, 'generate_report_board_members']);
Route::get('/postgraduated/report/commit_member/{type?}/{report_data?}', [CommitteeMemberController::class, 'generate_report_commit_member']);
Route::get('/research/report/{type?}/{faculty_id?}/{department_id?}', [TeacherResearchController::class, 'generateReport']);
