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
use App\Http\Controllers\postgraduated\BoardMemberController;
use App\Http\Controllers\postgraduated\BoradController;
use App\Http\Controllers\postgraduated\ClassRoomController;
use App\Http\Controllers\postgraduated\CommitteeMemberController;
use App\Http\Controllers\postgraduated\LabController;
use App\Http\Controllers\postgraduated\LabEquipmentController;
use App\Http\Controllers\postgraduated\PostCommitteeController;
use App\Http\Controllers\postgraduated\ProgramsController;
use App\Http\Controllers\postgraduated\studentController;
use App\Http\Controllers\postgraduated\StudentResearchController;
use App\Http\Controllers\researchDepartment\CurriculumController;
use App\Http\Controllers\researchDepartment\ExperimentDetailController;
use App\Http\Controllers\researchDepartment\InternatinalPublishmentController;
use App\Http\Controllers\researchDepartment\LabController as ResearchDepartmentLabController;
use App\Http\Controllers\researchDepartment\ResearchProjectController;
use App\Http\Controllers\researchDepartment\SpecailistAreaController;
use App\Http\Controllers\researchDepartment\TeacherResearchController;
use App\Http\Controllers\student\GraduatedStudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherPromotionController;
use App\Http\Controllers\UserController;
use Illuminate\Auth\Middleware\Authenticate;
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
    Route::middleware(['auth:sanctum'])->group(function () {
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

        //  current teacher Promotions routes
        Route::get('/teacher/promotion/{id}', [TeacherPromotionController::class, 'index']);
        Route::post('/teacher/promotion/create', [TeacherPromotionController::class, 'store']);
        Route::get('/teacher/promotion/edit/{id}', [TeacherPromotionController::class, 'edit']);
        Route::post('/teacher/promotion/update/{id}', [TeacherPromotionController::class, 'update']);
        Route::get('/teacher/promotion/delete/{id}', [TeacherPromotionController::class, 'destory']);
    });


    // quality assurance routes
    Route::middleware(['auth:sanctum'])->group(function () {
        // main criteria
        Route::get('/criteria', [CriteriaController::class, 'index']);
        // Route::get('/get_criteria', [CriteriaController::class, 'getAllCriteria']);
        Route::get('/get_criteria/{id}', [CriteriaController::class, 'getCriteria']);
        Route::post('/criteria/create', [CriteriaController::class, 'store']);
        Route::get('/criteria/edit/{id}', [CriteriaController::class, 'edit']);
        Route::post('/criteria/update', [CriteriaController::class, 'update']);
        Route::get('/criteria/delete/{id}', [CriteriaController::class, 'destroy']);
        // sub criteria
        Route::get('/sub_criteria', [SubCriteriaController::class, 'index']);
        Route::get('/get_sub_criteria', [SubCriteriaController::class, 'getAllSubCriteria']);
        Route::post('/sub_criteria/create', [SubCriteriaController::class, 'store']);
        Route::get('/sub_criteria/edit/{id}', [SubCriteriaController::class, 'edit']);
        Route::post('/sub_criteria/update', [SubCriteriaController::class, 'update']);
        Route::get('/sub_criteria/delete/{id}', [SubCriteriaController::class, 'destroy']);
    });


    // post graduated

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/get_all_program', [ProgramsController::class, 'getAllProgram']);
        Route::get('/program', [ProgramsController::class, 'index']);
        Route::post('/program/create', [ProgramsController::class, 'store']);
        Route::get('/program/edit/{id}', [ProgramsController::class, 'edit']);
        Route::post('/program/update', [ProgramsController::class, 'update']);
        Route::get('/program/delete/{id}', [ProgramsController::class, 'destroy']);


        // students routes
        Route::get('/studnet/{id}', [studentController::class, 'index']);
        Route::post('/studnet/create', [studentController::class, 'store']);
        Route::get('/studnet/edit/{id}', [studentController::class, 'edit']);
        Route::post('/studnet/update', [studentController::class, 'update']);
        Route::get('/studnet/delete/{id}', [studentController::class, 'destroy']);


        // graduated students
        Route::get('/graduated_student', [GraduatedStudentController::class, 'index']);
        Route::post('/graduated_student/create', [GraduatedStudentController::class, 'store']);
        Route::get('/graduated_student/edit/{id}', [GraduatedStudentController::class, 'edit']);
        Route::post('/graduated_student/update', [GraduatedStudentController::class, 'update']);
        Route::get('/graduated_student/delete/{id}', [GraduatedStudentController::class, 'destroy']);


        // student research routes
        Route::get('/student_research', [StudentResearchController::class, 'index']);
        Route::post('/student_research/create', [StudentResearchController::class, 'store']);
        Route::get('/student_research/edit/{id}', [StudentResearchController::class, 'edit']);
        Route::post('/student_research/update', [StudentResearchController::class, 'update']);
        Route::get('/student_research/delete/{id}', [StudentResearchController::class, 'destroy']);

        // post committee
        Route::get('/post_committee', [PostCommitteeController::class, 'index']);
        Route::post('/post_committee/create', [PostCommitteeController::class, 'store']);
        Route::get('/post_committee/edit/{id}', [PostCommitteeController::class, 'edit']);
        Route::post('/post_committee/update', [PostCommitteeController::class, 'update']);
        Route::get('/post_committee/delete/{id}', [PostCommitteeController::class, 'destroy']);

        // committee members routes
        Route::get('/get_all_committees', [CommitteeMemberController::class, 'getAllCommittees']);
        Route::get('/post_committee_member', [CommitteeMemberController::class, 'index']);
        Route::post('/post_committee_member/create', [CommitteeMemberController::class, 'store']);
        Route::get('/post_committee_member/edit/{id}', [CommitteeMemberController::class, 'edit']);
        Route::post('/post_committee_member/update', [CommitteeMemberController::class, 'update']);
        Route::get('/post_committee_member/delete/{id}', [CommitteeMemberController::class, 'destroy']);

        // board routes
        Route::get('/board', [BoradController::class, 'index']);
        Route::post('/board/create', [BoradController::class, 'store']);
        Route::get('/board/edit/{id}', [BoradController::class, 'edit']);
        Route::post('/board/update', [BoradController::class, 'update']);
        Route::get('/board/delete/{id}', [BoradController::class, 'destroy']);


        // board Members
        Route::get('/all_boar_member', [BoardMemberController::class, 'getAllMembers']);
        Route::get('/boar_member', [BoardMemberController::class, 'index']);
        Route::post('/boar_member/create', [BoardMemberController::class, 'store']);
        Route::get('/boar_member/edit/{id}', [BoardMemberController::class, 'edit']);
        Route::post('/boar_member/update', [BoardMemberController::class, 'update']);
        Route::get('/boar_member/delete/{id}', [BoardMemberController::class, 'destroy']);


        // labs routes
        Route::get('/lab', [LabController::class, 'index']);
        Route::post('/lab/create', [LabController::class, 'store']);
        Route::get('/lab/edit/{id}', [LabController::class, 'edit']);
        Route::post('/lab/update', [LabController::class, 'update']);
        Route::get('/lab/delete/{id}', [LabController::class, 'destroy']);

        // lab equipments routes
        Route::get('/get_all_lab', [LabEquipmentController::class, 'getAllLab']);
        Route::get('/equipment_lab', [LabEquipmentController::class, 'index']);
        Route::post('/equipment_lab/create', [LabEquipmentController::class, 'store']);
        Route::get('/equipment_lab/edit/{id}', [LabEquipmentController::class, 'edit']);
        Route::post('/equipment_lab/update', [LabEquipmentController::class, 'update']);
        Route::get('/equipment_lab/delete/{id}', [LabEquipmentController::class, 'destroy']);

        // class rooms
        Route::get('/class_room', [ClassRoomController::class, 'index']);
        Route::post('/class_room/create', [ClassRoomController::class, 'store']);
        Route::get('/class_room/edit/{id}', [ClassRoomController::class, 'edit']);
        Route::post('/class_room/update', [ClassRoomController::class, 'update']);
        Route::get('/class_room/delete/{id}', [ClassRoomController::class, 'destroy']);
    });


    Route::middleware(['auth:sanctum'], function () {
        //  internaital publisher
        Route::get('/international_publisher', [InternatinalPublishmentController::class, 'index']);
        Route::post('/international_publisher/create', [InternatinalPublishmentController::class, 'create']);
        Route::get('/international_publisher/edit/{id}', [InternatinalPublishmentController::class, 'edit']);
        Route::post('/international_publisher/update', [InternatinalPublishmentController::class, 'update']);
        Route::get('/international_publisher/delete/{id}', [InternatinalPublishmentController::class, 'destroy']);

        // teacher research
        Route::get('/teacher_research', [TeacherResearchController::class, 'index']);
        Route::post('/teacher_research/create', [TeacherResearchController::class, 'create']);
        Route::get('/teacher_research/edit/{id}', [TeacherResearchController::class, 'edit']);
        Route::post('/teacher_research/update', [TeacherResearchController::class, 'update']);
        Route::get('/teacher_research/delete/{id}', [TeacherResearchController::class, 'destroy']);

        // curriculum
        Route::get('/curriculum', [CurriculumController::class, 'index']);
        Route::post('/curriculum/create', [CurriculumController::class, 'create']);
        Route::get('/curriculum/edit/{id}', [CurriculumController::class, 'edit']);
        Route::post('/curriculum/update', [CurriculumController::class, 'update']);
        Route::get('/curriculum/delete/{id}', [CurriculumController::class, 'destroy']);

        // research labs
        Route::get('/research_lab', [LabController::class, 'index']);
        Route::post('/research_lab/create', [LabController::class, 'create']);
        Route::get('/research_lab/edit/{id}', [LabController::class, 'edit']);
        Route::post('/research_lab/update', [LabController::class, 'update']);
        Route::get('/research_lab/delete/{id}', [LabController::class, 'destroy']);

        // research project
        Route::get('/research_project', [ResearchProjectController::class, 'index']);
        Route::post('/research_project/create', [ResearchProjectController::class, 'create']);
        Route::get('/research_project/edit/{id}', [ResearchProjectController::class, 'edit']);
        Route::post('/research_project/update', [ResearchProjectController::class, 'update']);
        Route::get('/research_project/delete/{id}', [ResearchProjectController::class, 'destroy']);

        // specialist area
        Route::get('/specialist_area', [SpecailistAreaController::class, 'index']);
        Route::post('/specialist_area/create', [SpecailistAreaController::class, 'create']);
        Route::get('/specialist_area/edit/{id}', [SpecailistAreaController::class, 'edit']);
        Route::post('/specialist_area/update', [SpecailistAreaController::class, 'update']);
        Route::get('/specialist_area/delete/{id}', [SpecailistAreaController::class, 'destroy']);

        // experimental details
        Route::get('/experiment_detail', [ExperimentDetailController::class, 'index']);
        Route::post('/experiment_detail/create', [ExperimentDetailController::class, 'create']);
        Route::get('/experiment_detail/edit/{id}', [ExperimentDetailController::class, 'edit']);
        Route::post('/experiment_detail/update', [ExperimentDetailController::class, 'update']);
        Route::get('/experiment_detail/delete/{id}', [ExperimentDetailController::class, 'destroy']);
    });

    Route::middleware(['auth:sanctum', 'edit_teacher'])->group(function () {
        Route::post('/teacher/update', [TeacherController::class, 'update']);
    });
    Route::middleware(['auth:sanctum', 'delete_teacher'])->group(function () {
        Route::post('/teacher/delete/{id}', [TeacherController::class, 'destroy']);
    });
});


Route::post('/login', [AuthController::class, 'login']);
