<?php

use App\Exports\TeachersExport;
use App\Http\Controllers\TeacherController;
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


Route::get("/foo", function () {
    $faculties = Faculty::all()->count();
    $departments = Department::all()->count();
    $all_man = [];
    $all_women = [];
    $all_master_women = [];
    $all_master_man = [];
    $all_bachelor = [];
    $all_doctor = [];
    for ($i = 0; $i < $faculties; $i++) {
        for ($i = 0; $i < $departments; $i++) {
            $all_master_man =   Teacher::query()
                ->join('faculties', 'teachers.faculty_id', 'faculties.id')
                ->rightJoin('departments', 'teachers.department_id', 'departments.id')
                ->rightJoin('teacher_qualifications', 'teachers.id', 'teacher_qualifications.teacher_id')
                ->select('departments.name as department_name',  'faculties.name as facility_name', 'teachers.name as name', 'teacher_qualifications.education_ as education_degree')
                ->where('teachers.gender', '=', 'مرد')
                ->where('teacher_qualifications.education_', '=', 'ماستر')
                ->get();


            $all_master_women =  Teacher::query()
                ->join('faculties', 'teachers.faculty_id', 'faculties.id')
                ->rightJoin('departments', 'teachers.department_id', 'departments.id')
                ->rightJoin('teacher_qualifications', 'teachers.id', 'teacher_qualifications.teacher_id')
                ->select('departments.name as department_name',  'faculties.name as facility_name', 'teachers.name as name', 'teacher_qualifications.education_ as education_degree')
                ->where('teachers.gender', '=', 'زن')
                ->where('teacher_qualifications.education_', '=', 'ماستر')
                ->get();



            // $all_master  =   Department::query()
            // ->join('faculties', 'teachers.faculty_id', 'faculties.id')
            // ->rightJoin('departments', 'teachers.department_id', 'teachers.department_id')
            // ->rightJoin('teacher_qualifications', 'teachers.teacher_id', 'teacher_qualifications.department_id')
            // ->select('departments.name as department_name',  'faculties.name as facility_name', 'teachers.name as name','teacher_qualifications.education_degree as education_degree')
            // ->where('teachers.gender', '=', 'مرد')
            // ->get()->count();


            // $all_doctor  =   Department::query()
            //     ->join('faculties', 'departments.faculty_id', 'faculties.id')
            //     ->rightJoin('teachers', 'departments.id', 'teachers.department_id')
            //     ->select('departments.name as department_name',  'faculties.name as facility_name', 'teachers.name as name')
            //     ->where('teachers_qualifications.education_degree', '=', 'داکتر')
            //     ->where('teachers.gender', '=', 'زن')
            //     ->get()->count();

            // $all_bachelor  =   Department::query()
            //     ->join('faculties', 'departments.faculty_id', 'faculties.id')
            //     ->rightJoin('teachers', 'departments.id', 'teachers.department_id')
            //     ->select('departments.name as department_name',  'faculties.name as facility_name', 'teachers.name as name')
            //     ->where('teachers_qualifications.education_degree', '=', 'لیسانس')
            //     ->where('teachers.gender', '=', 'مرد')
            //     ->get()->count();
        }
    }

    // return  "man === " . $all_master_man;


    return $all_master_man . "   مرد---- " . $all_master_women;
});
