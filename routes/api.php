<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\criteria\CriteriaController;
use App\Http\Controllers\criteria\SubCriteriaController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\PDC\ArchiveController;
use App\Http\Controllers\PDC\PlanController;
use App\Http\Controllers\PDC\CommitController;
use App\Http\Controllers\PDC\TeacherInCommitController;
use App\Http\Controllers\PDC\TeacherInSchalarshipController;
use App\Http\Controllers\PDC\TeacherInWorkshopController;
use App\Http\Controllers\PDC\WorkshopController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Models\Department;

use App\Models\Teacher;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum', 'admin'])->group(function () {

    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/current/user', [AuthController::class, 'getCurrentUser']);
    //Route::post('/current/permission', [AuthController::class, 'getCurrentPermission']);

    // user
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/get_chance_department', [UserController::class, 'getChanceDepartment']);
    Route::post('/user/create', [UserController::class, 'store']);
    Route::get('/user/edit/{id}', [UserController::class, 'edit']);
    Route::post('/user/update', [UserController::class, 'update']);
    Route::get('/user/delete/{id}', [UserController::class, 'delete_user']);


    Route::get('/permission/list/{id}', [UserController::class, 'get_user_permission']);
    Route::get('/permission', [UserController::class, 'user_permission_list']);
    Route::post('/permission/store', [UserController::class, 'storePermission']);
    Route::get('/permission/delete/{id}', [UserController::class, 'deletePermission']);
    Route::get('/user/current/permission', [AuthController::class, 'getCurrentPermission']);


    // get all the department
    Route::get('/get_all_departments', [DepartmentController::class, 'getAllDepartments']);


    // pdc plan
    Route::middleware(['auth:sanctum', 'create_plan'])->group(function () {
        Route::post('/pdc/plan/create', [PlanController::class, 'store']);
    });
    Route::middleware(['auth:sanctum', 'view_plan'])->group(function () {
        Route::get('/plan', [PlanController::class, 'index']);
    });
    Route::middleware(['auth:sanctum', 'edit_plan'])->group(function () {
        Route::get('/pdc/plan/edit/{id}', [PlanController::class, 'edit']);
        Route::post('/pdc/plan/update', [PlanController::class, 'update']);
    });
    Route::middleware(['auth:sanctum', 'delete_plan'])->group(function () {

        Route::get('/pdc/plan/delete/{id}', [PlanController::class, 'destroy']);
    });

    // pdc archive file
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/archive', [ArchiveController::class, 'index']);
        Route::post('/pdc/archive/create', [ArchiveController::class, 'store']);
        Route::get('/pdc/archive/edit/{id}', [ArchiveController::class, 'edit']);
        Route::post('/pdc/archive/update', [ArchiveController::class, 'update']);
        Route::get('/pdc/archive/delete/{id}', [ArchiveController::class, 'destroy']);


        // pdc commites
        Route::get('pdc/commit', [CommitController::class, 'index']);
        Route::post('/pdc/commit/create', [CommitController::class, 'store']);
        Route::get('/pdc/commit/edit/{id}', [CommitController::class, 'edit']);
        Route::post('/pdc/commit/update', [CommitController::class, 'update']);
        Route::get('/pdc/commit/delete/{id}', [CommitController::class, 'destroy']);


        // pdc teacher in commit
        Route::get('pdc/teacher_in_commit', [TeacherInCommitController::class, 'index']);
        Route::get('/pdc/get_teachers', [TeacherInCommitController::class, 'getTeacher']);
        Route::get('/pdc/get_commits', [TeacherInCommitController::class, 'getCommit']);
        Route::post('/pdc/teacher_in_commit/create', [TeacherInCommitController::class, 'store']);
        Route::get('/pdc/teacher_in_commit/edit/{id}', [TeacherInCommitController::class, 'edit']);
        Route::post('/pdc/teacher_in_commit/update', [TeacherInCommitController::class, 'update']);
        Route::get('/pdc/teacher_in_commit/delete/{id}', [TeacherInCommitController::class, 'destroy']);


        // pdc schalaship
        Route::get('pdc/teacher_in_scholarship', [TeacherInSchalarshipController::class, 'index']);
        Route::post('/pdc/teacher_in_scholarship/create', [TeacherInSchalarshipController::class, 'store']);
        Route::get('/pdc/teacher_in_scholarship/edit/{id}', [TeacherInSchalarshipController::class, 'edit']);
        Route::post('/pdc/teacher_in_scholarship/update', [TeacherInSchalarshipController::class, 'update']);
        Route::get('/pdc/teacher_in_scholarship/delete/{id}', [TeacherInSchalarshipController::class, 'destroy']);


        // pdc workshops
        Route::get('pdc/workshop', [WorkshopController::class, 'index']);
        Route::post('/pdc/workshop/create', [WorkshopController::class, 'store']);
        Route::get('/pdc/workshop/edit/{id}', [WorkshopController::class, 'edit']);
        Route::post('/pdc/workshop/update', [WorkshopController::class, 'update']);
        Route::get('/pdc/workshop/delete/{id}', [WorkshopController::class, 'destroy']);

        //pdc teacher in workshop
        Route::get('/teacher_in_workshop', [TeacherInWorkshopController::class, 'index']);
        Route::get('/get_workshop', [TeacherInWorkshopController::class, 'getAllWorkshops']);
        Route::post('/pdc/teacher_in_workshop/create', [TeacherInWorkshopController::class, 'store']);
        Route::get('/pdc/teacher_in_workshop/edit/{id}', [TeacherInWorkshopController::class, 'edit']);
        Route::post('/pdc/teacher_in_workshop/update', [TeacherInWorkshopController::class, 'update']);
        Route::get('/pdc/teacher_in_workshop/delete/{id}', [TeacherInWorkshopController::class, 'destroy']);
    });


    // faculty
    Route::middleware(['auth:sanctum'])->group(function () {

        Route::get('/faculty', [FacultyController::class, 'index']);
        Route::get('/faculty/details/{id}', [FacultyController::class, 'getFaculty']);
        Route::post('/faculty/create', [FacultyController::class, 'store']);
        Route::get('/faculty/edit/{id}', [
            FacultyController::class, 'getFaculty'
        ]);
        Route::post('/faculty/update', [FacultyController::class, 'update']);
        Route::get('/faculty/delete/{id}', [FacultyController::class, 'destroy']);
        Route::get('/get/faculties', [FacultyController::class, 'getFaculties']);

        // department
        Route::get('/faculty/department', [DepartmentController::class, 'getFacultyDepartment']);
        Route::post('/faculty/department/create/{id}', [DepartmentController::class, 'store']);
        Route::get('/get/departments/{id}', [DepartmentController::class, 'getDepartments']);
    });

    // teacher
    Route::middleware(['auth:sanctum', 'create_teacher'])->group(function () {
        Route::get('/teacher', [TeacherController::class, 'index']);
        Route::post('/teacher/create', [TeacherController::class, 'store']);
        Route::get('/teacher/edit/{id}', [TeacherController::class, 'edit']);
        Route::post('/teacher/update', [TeacherController::class, 'update']);
        Route::get('/teacher/delete/{id}', [TeacherController::class, 'destroy']);
        Route::get('/faculty/department/get', [TeacherController::class, 'getFacultyDepartment']);
        Route::get('/teacher/details/{id}', [TeacherController::class, 'getTeacher']);

        // qualification
        Route::post('/teacher/qualification/create/{id}', [TeacherController::class, 'storeQualification']);
        Route::get('/teacher/qualification', [TeacherController::class, 'getQualify']);
        Route::get('/teacher/qualification/edit/{id}', [TeacherController::class, 'editQualification']);
        Route::post('/teacher/qualification/update/{id}', [TeacherController::class, 'updateQualification']);
        Route::get('/teacher/qualification/delete/{id}', [TeacherController::class, 'destroyQualification']);
        // documents
        Route::post('/teacher/document/create/{id}', [TeacherController::class, 'storeDocument']);
        Route::get('/teacher/document', [TeacherController::class, 'getDocument']);
        Route::get('/teacher/document/edit/{id}', [TeacherController::class, 'editDocument']);
        Route::post('/teacher/document/update/{id}', [TeacherController::class, 'updateDocument']);
        Route::get('/teacher/document/delete/{id}', [TeacherController::class, 'destroyDocument']);
        // article
        Route::post('/teacher/article/create/{id}', [TeacherController::class, 'storeArticle']);
        Route::get('/teacher/article', [TeacherController::class, 'getArticle']);
        Route::get('/teacher/article/edit/{id}', [TeacherController::class, 'editArticle']);
        Route::post('/teacher/article/update/{id}', [TeacherController::class, 'updateArticle']);
        Route::get('/teacher/article/delete/{id}', [TeacherController::class, 'destroyArticle']);

        // literatures
        Route::post('/teacher/literature/create/{id}', [TeacherController::class, 'storeLiterature']);
        Route::get('/teacher/literature', [TeacherController::class, 'getLiterature']);
        Route::get('/teacher/literature/edit/{id}', [TeacherController::class, 'editLiterature']);
        Route::post('/teacher/literature/update/{id}', [TeacherController::class, 'updateLiterature']);
        Route::get('/teacher/literature/delete/{id}', [TeacherController::class, 'destroyLiterature']);
    });


    // quality assurance routes
    Route::middleware(['auth:sanctum'])->group(function () {
        // main criteria
        Route::get('/criteria', [CriteriaController::class, 'index']);
        Route::get('/get_criteria', [CriteriaController::class, 'getAllCriteria']);
        Route::post('/criteria/create', [CriteriaController::class, 'store']);
        Route::get('/criteria/edit/{id}', [CriteriaController::class, 'edit']);
        Route::post('/criteria/update', [CriteriaController::class, 'update']);
        Route::get('/criteria/delete/{id}', [CriteriaController::class, 'destroy']);
        // sub criteria
        Route::get('/sub_criteria', [SubCriteriaController::class, 'index']);
        Route::get('/get_criteria', [SubCriteriaController::class, 'getAllSubCriteria']);
        Route::post('/sub_criteria/create', [SubCriteriaController::class, 'store']);
        Route::get('/sub_criteria/edit/{id}', [SubCriteriaController::class, 'edit']);
        Route::post('/sub_criteria/update', [SubCriteriaController::class, 'update']);
        Route::get('/sub_criteria/delete/{id}', [SubCriteriaController::class, 'destroy']);
    });

    Route::middleware(['auth:sanctum', 'edit_teacher'])->group(function () {
        Route::post('/teacher/update', [TeacherController::class, 'update']);
    });
    Route::middleware(['auth:sanctum', 'delete_teacher'])->group(function () {
        Route::post('/teacher/delete/{id}', [TeacherController::class, 'destroy']);
    });
});


Route::post('/login', [AuthController::class, 'login']);
