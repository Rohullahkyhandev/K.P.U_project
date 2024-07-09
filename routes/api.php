<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\criteria\CriteriaController;
use App\Http\Controllers\criteria\SubCriteriaController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\NotificationController;
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
use App\Http\Controllers\postgraduated\EmployeeController;
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
use App\Http\Controllers\postgraduated\graduatedStudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TeacherPromotionController;
use App\Http\Controllers\TeacherReportController;
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
    // user permissions
    Route::get('/permission', [UserController::class, 'user_permission_list']);
    Route::post('/permission/store', [UserController::class, 'storePermission']);
    // user  just the admin can do the crud operation on the user model
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/get_chance_department', [UserController::class, 'getChanceDepartment']);
    Route::get('/permission/list/{id}', [UserController::class, 'get_user_permission']);
    Route::get('/user/current/permission', [AuthController::class, 'getCurrentPermission']);

    Route::middleware(['auth:sanctum', 'adminsterator'])->group(function () {
        Route::post('/user/create', [UserController::class, 'store']);
        Route::get('/user/edit/{id}', [UserController::class, 'edit']);
        Route::post('/user/update', [UserController::class, 'update']);
        Route::get('/user/delete/{id}', [UserController::class, 'delete_user']);
        Route::get('/permission/delete/{id}', [UserController::class, 'deletePermission']);
    });

    // });


    // documents view routes
    Route::middleware(['auth:sanctum', 'view_document'])->group(function () {
        Route::get('/document', [DocumentController::class, 'index']);
        Route::get('/farwarded_document', [DocumentController::class, 'farwardParts']);
        Route::get('/notifications', [NotificationController::class, 'notify']);
        Route::get('/count_notification', [NotificationController::class, 'countNotification']);
    });
    // document create routes
    Route::middleware(['auth:sanctum', 'create_document'])->group(function () {
        Route::post('/document/create', [DocumentController::class, 'store']);
        Route::get('/update_notification/{id}', [NotificationController::class, 'updateNotification']);
    });



    // get all the department
    Route::get('/get_all_departments', [DepartmentController::class, 'getAllDepartments']);

    // pdc all route
    Route::middleware(['auth:sanctum', 'view_pdc'])->group(function () {
        Route::get('/plan', [PlanController::class, 'index']);
        Route::get('/archive', [ArchiveController::class, 'index']);
        Route::get('pdc/commit', [CommitController::class, 'index']);
        Route::get('pdc/teacher_in_commit', [TeacherInCommitController::class, 'index']);
        Route::get('/pdc/get_teachers/{id}', [TeacherInCommitController::class, 'getTeacher']);
        Route::get('/pdc/get_commits', [TeacherInCommitController::class, 'getCommit']);
        Route::get('pdc/teacher_in_scholarship', [TeacherInSchalarshipController::class, 'index']);
        Route::get('pdc/workshop', [WorkshopController::class, 'index']);
        Route::get('/teacher_in_workshop', [TeacherInWorkshopController::class, 'index']);
        Route::get('/get_workshop', [TeacherInWorkshopController::class, 'getAllWorkshops']);
    });

    //    create routes
    Route::middleware(['auth:sanctum', 'create_pdc'])->group(function () {
        Route::post('/pdc/plan/create', [PlanController::class, 'store']);
        Route::post('/pdc/archive/create', [ArchiveController::class, 'store']);
        Route::post('/pdc/commit/create', [CommitController::class, 'store']);
        Route::post('/pdc/teacher_in_commit/create', [TeacherInCommitController::class, 'store']);
        Route::post('/pdc/teacher_in_scholarship/create', [TeacherInSchalarshipController::class, 'store']);
        Route::post('/pdc/workshop/create', [WorkshopController::class, 'store']);
        Route::post('/pdc/teacher_in_workshop/create', [TeacherInWorkshopController::class, 'store']);
    });

    // edit and update routes
    Route::middleware([
        'auth:sanctum', 'edit_pdc'
    ])->group(function () {
        // update and edit plan
        Route::get('/pdc/plan/edit/{id}', [PlanController::class, 'edit']);
        Route::post('/pdc/plan/update', [PlanController::class, 'update']);
        // update and edit archive
        Route::get('/pdc/archive/edit/{id}', [ArchiveController::class, 'edit']);
        Route::post('/pdc/archive/update', [ArchiveController::class, 'update']);
        // pdc commites
        Route::get('/pdc/commit/edit/{id}', [CommitController::class, 'edit']);
        Route::post('/pdc/commit/update', [CommitController::class, 'update']);

        // update and edit teacher in commit
        Route::get('/pdc/teacher_in_commit/edit/{id}', [TeacherInCommitController::class, 'edit']);
        Route::post('/pdc/teacher_in_commit/update', [TeacherInCommitController::class, 'update']);
        // update and edit teacher in scholaship
        Route::get('/pdc/teacher_in_scholarship/edit/{id}', [TeacherInSchalarshipController::class, 'edit']);
        Route::post('/pdc/teacher_in_scholarship/update', [TeacherInSchalarshipController::class, 'update']);
        // update and route workshops
        Route::get('/pdc/workshop/edit/{id}', [WorkshopController::class, 'edit']);
        Route::post('/pdc/workshop/update', [WorkshopController::class, 'update']);
        // update and edit teacher in workshop
        Route::get('/pdc/teacher_in_workshop/edit/{id}', [TeacherInWorkshopController::class, 'edit']);
        Route::post('/pdc/teacher_in_workshop/update', [TeacherInWorkshopController::class, 'update']);
    });

    // delete routes pdc
    Route::middleware(['auth:sanctum', 'delete_pdc'])->group(function () {
        Route::get('/pdc/plan/delete/{id}', [PlanController::class, 'destroy']);
        Route::get('/pdc/archive/delete/{id}', [ArchiveController::class, 'destroy']);
        Route::get('/pdc/commit/delete/{id}', [CommitController::class, 'destroy']);
        Route::get('/pdc/teacher_in_commit/delete/{id}', [TeacherInCommitController::class, 'destroy']);
        Route::get('/pdc/teacher_in_scholarship/delete/{id}', [TeacherInSchalarshipController::class, 'destroy']);
        Route::get('/pdc/workshop/delete/{id}', [WorkshopController::class, 'destroy']);
        Route::get('/pdc/teacher_in_workshop/delete/{id}', [TeacherInWorkshopController::class, 'destroy']);
    });


    // all the common route should be accessible entire the system
    Route::get('/faculty/details/{id}', [FacultyController::class, 'getFaculty']);
    Route::get('/get_all_faculty', [FacultyController::class, 'getFaculties']);
    Route::get('/faculty/edit/{id}', [FacultyController::class, 'getFaculty']);
    Route::get('/get_departments_with_out_facilities', [DepartmentController::class, 'departmentHasOutFaculties']);
    Route::get(
        '/department',
        [DepartmentController::class, 'getFacultyDepartment']
    );
    Route::get('/get/departments/{id}', [DepartmentController::class, 'getDepartments']);
    Route::get('/get/departments', [DepartmentController::class, 'getDepartments']);
    Route::get('/get_all/departments', [DepartmentController::class, 'getAllDepartment']);
    Route::get('/get/faculties', [FacultyController::class, 'getFaculties']);
    Route::get('/faculty/department/get', [TeacherController::class, 'getFacultyDepartment']);
    Route::get('/department/teacher/{id}', [TeacherController::class, 'getDepartmentTeacher']);
    //   view routes in teacher department
    Route::middleware(['auth:sanctum', 'view_teacher'])->group(function () {
        //faculty routes
        Route::get('/faculty', [FacultyController::class, 'index']);
        // teacher create  routes
        Route::get('/teacher', [TeacherController::class, 'index']);
        Route::get('/teacher/promotion/{id}', [TeacherPromotionController::class, 'index']);
        Route::get('/teacher/qualification', [TeacherController::class, 'getQualify']);
        Route::get('/teacher/article', [TeacherController::class, 'getArticle']);
        Route::get('/teacher/document', [TeacherController::class, 'getDocument']);
        Route::get('/teacher/details/{id}', [TeacherController::class, 'getTeacher']);
        Route::get('/teacher/literature', [TeacherController::class, 'getLiterature']);
    });

    // create routes in teacher department
    Route::middleware(['auth:sanctum', 'create_teacher'])->group(function () {
        Route::post('/faculty/create', [FacultyController::class, 'store']);
        Route::post('/department/create', [DepartmentController::class, 'store']);
        // teacher create routes
        Route::post('/teacher/create', [TeacherController::class, 'store']);
        Route::post('/teacher/qualification/create/{id}', [TeacherController::class, 'storeQualification']);
        Route::post('/teacher/document/create/{id}', [TeacherController::class, 'storeDocument']);
        Route::post('/teacher/article/create/{id}', [TeacherController::class, 'storeArticle']);
        Route::post('/teacher/promotion/create', [TeacherPromotionController::class, 'store']);
        Route::post('/teacher/literature/create/{id}', [TeacherController::class, 'storeLiterature']);
    });

    // update and edit routes teacher department
    Route::middleware(['auth:sanctum', 'create_teacher'])->group(function () {

        // faculty and department update edit routes
        Route::post('/faculty/update', [FacultyController::class, 'update']);
        Route::get('/department/edit/{id}', [DepartmentController::class, 'edit']);
        Route::post('/department/update', [DepartmentController::class, 'update']);

        // teacher update and edit routes
        Route::get('/teacher/edit/{id}', [TeacherController::class, 'edit']);
        Route::post('/teacher/update', [TeacherController::class, 'update']);
        // qualification
        Route::get('/teacher/qualification/edit/{id}', [TeacherController::class, 'editQualification']);
        Route::post('/teacher/qualification/update/{id}', [TeacherController::class, 'updateQualification']);
        // documents
        Route::get('/teacher/document/edit/{id}', [TeacherController::class, 'editDocument']);
        Route::post('/teacher/document/update/{id}', [TeacherController::class, 'updateDocument']);
        // article
        Route::get('/teacher/article/edit/{id}', [TeacherController::class, 'editArticle']);
        Route::post('/teacher/article/update/{id}', [TeacherController::class, 'updateArticle']);
        // literatures
        Route::get('/teacher/literature/edit/{id}', [TeacherController::class, 'editLiterature']);
        Route::post('/teacher/literature/update/{id}', [TeacherController::class, 'updateLiterature']);
        //  current teacher Promotions routes
        Route::get('/teacher/promotion/edit/{id}', [TeacherPromotionController::class, 'edit']);
        Route::post('/teacher/promotion/update/{id}', [TeacherPromotionController::class, 'update']);
    });

    // delete route in teacher department
    Route::middleware(['auth:sanctum', 'delete_teacher'])->group(function () {
        Route::get('/faculty/delete/{id}', [FacultyController::class, 'destroy']);
        // teacher delete routes
        Route::get('/teacher/delete/{id}', [TeacherController::class, 'destroy']);
        Route::get('/teacher/qualification/delete/{id}', [TeacherController::class, 'destroyQualification']);
        Route::get('/teacher/document/delete/{id}', [TeacherController::class, 'destroyDocument']);
        Route::get('/teacher/article/delete/{id}', [
            TeacherController::class, 'destroyArticle'
        ]);
        Route::get('/teacher/literature/delete/{id}', [TeacherController::class, 'destroyLiterature']);
        Route::get('/teacher/promotion/delete/{id}', [TeacherPromotionController::class, 'destory']);
        Route::get('/department/delete/{id}', [DepartmentController::class, 'destory']);
    });

    // quality assurance view routes
    Route::middleware(['auth:sanctum', 'view_quality'])->group(function () {
        // main criteria
        Route::get('/criteria', [CriteriaController::class, 'index']);
        Route::get('/get_criteria/{id}', [CriteriaController::class, 'getCriteria']);
        Route::get('/get_sub_criteria', [SubCriteriaController::class, 'getAllSubCriteria']);
        // sub criteria
        Route::get('/sub_criteria', [SubCriteriaController::class, 'index']);
    });
    // quality assurance create routes
    Route::middleware([
        'auth:sanctum', 'create_quality'
    ])->group(function () {
        Route::post('/criteria/create', [CriteriaController::class, 'store']);
        Route::post('/sub_criteria/create', [SubCriteriaController::class, 'store']);
    });
    // quality assurance edit and update routes
    Route::middleware(['auth:sanctum', 'edit_quality'])->group(function () {
        // main criteria update and edit routes
        Route::get('/criteria/edit/{id}', [CriteriaController::class, 'edit']);
        Route::post('/criteria/update', [CriteriaController::class, 'update']);
        // sub criteria update and edit routes
        Route::get('/sub_criteria/edit/{id}', [SubCriteriaController::class, 'edit']);
        Route::post('/sub_criteria/update', [SubCriteriaController::class, 'update']);
    });

    // quality  assurance delete  routes
    Route::middleware(['auth:sanctum', 'delete_quality'])->group(function () {
        // Route::get('/get_criteria', [CriteriaController::class, 'getAllCriteria']);
        Route::get('/criteria/delete/{id}', [CriteriaController::class, 'destroy']);
        Route::get('/sub_criteria/delete/{id}', [SubCriteriaController::class, 'destroy']);
    });

    // post graduated view routes
    Route::middleware(['auth:sanctum', 'view_post_graduated'])->group(function () {
        Route::get('/get_all_program', [ProgramsController::class, 'getAllProgram']);
        Route::get('/program', [ProgramsController::class, 'index']);
        Route::get('post/teacher', [TeacherController::class, 'index']);
        Route::get('/studnet/{id}', [studentController::class, 'index']);
        Route::get('/graduated_student/{id}', [graduatedStudentController::class, 'index']);
        Route::get('/student_research', [StudentResearchController::class, 'index']);
        Route::get('/post_committee', [PostCommitteeController::class, 'index']);
        Route::get('/get_all_committees', [CommitteeMemberController::class, 'getAllCommittees']);
        Route::get('/post_committee_member', [CommitteeMemberController::class, 'index']);
        Route::get('/get_all_board_member', [BoardMemberController::class, 'getAllMembers']);
        Route::get('/board', [BoradController::class, 'index']);
        Route::get('/board_member', [BoardMemberController::class, 'index']);
        Route::get('/lab', [LabController::class, 'index']);
        // lab equipments routes
        Route::get('/get_all_lab', [LabEquipmentController::class, 'getAllLab']);
        Route::get('/lab_equipment', [LabEquipmentController::class, 'index']);
        // class rooms
        Route::get('/class_room', [ClassRoomController::class, 'index']);
        // post graduated employees
        Route::get('/employee', [EmployeeController::class, 'index']);
    });

    // post graduated create routes
    Route::middleware(['auth:sanctum', 'create_post_graduated'])->group(function () {
        Route::post('/program/create', [ProgramsController::class, 'store']);
        Route::post('post/teacher/create', [TeacherController::class, 'store']);
        Route::post('/studnet/create', [studentController::class, 'store']);
        Route::post('/graduated_student/create', [graduatedStudentController::class, 'store']);
        Route::post('/student_research/create', [StudentResearchController::class, 'store']);
        Route::post('/post_committee/create', [PostCommitteeController::class, 'store']);
        Route::post('/post_committee_member/create', [CommitteeMemberController::class, 'store']);
        Route::post('/board/create', [BoradController::class, 'store']);
        Route::post('/lab/create', [LabController::class, 'store']);
        Route::post('/board_member/create', [BoardMemberController::class, 'store']);
        Route::post('/class_room/create', [ClassRoomController::class, 'store']);
        Route::post('/employee/create', [EmployeeController::class, 'store']);
        Route::post('/lab_equipment/create', [LabEquipmentController::class, 'store']);
    });

    // post graduated edit and update routes
    Route::middleware(['auth:sanctum', 'edit_post_graduated'])->group(function () {
        Route::get('/program/edit/{id}', [ProgramsController::class, 'edit']);
        Route::post('/program/update', [ProgramsController::class, 'update']);
        // post graduated teacher
        Route::get('post/edit/{id}', [TeacherController::class, 'edit']);
        Route::post('post/update/{id}', [TeacherController::class, 'edit']);
        // students routes
        Route::get('/studnet/edit/{id}', [studentController::class, 'edit']);
        Route::post('/studnet/update', [studentController::class, 'update']);
        // graduated students
        Route::get('/graduated_student/edit/{id}', [graduatedStudentController::class, 'edit']);
        Route::post('/graduated_student/update', [graduatedStudentController::class, 'update']);
        // student research routes
        Route::get('/student_research/edit/{id}', [StudentResearchController::class, 'edit']);
        Route::post('/student_research/update', [StudentResearchController::class, 'update']);
        // post committee
        Route::get('/post_committee/edit/{id}', [PostCommitteeController::class, 'edit']);
        Route::post('/post_committee/update', [PostCommitteeController::class, 'update']);
        // committee members routes
        Route::get('/post_committee_member/edit/{id}', [CommitteeMemberController::class, 'edit']);
        Route::post('/post_committee_member/update', [CommitteeMemberController::class, 'update']);
        // board routes
        Route::get('/board/edit/{id}', [BoradController::class, 'edit']);
        Route::post('/board/update', [BoradController::class, 'update']);
        // board Members
        Route::get('/board_member/edit/{id}', [BoardMemberController::class, 'edit']);
        Route::post('/board_member/update', [BoardMemberController::class, 'update']);
        // labs routes
        Route::get('/lab/edit/{id}', [LabController::class, 'edit']);
        Route::post('/lab/update', [LabController::class, 'update']);
        // lab equipment routes
        Route::get('/lab_equipment/edit/{id}', [LabEquipmentController::class, 'edit']);
        Route::post('/lab_equipment/update', [LabEquipmentController::class, 'update']);
        // class room routes
        Route::get('/class_room/edit/{id}', [ClassRoomController::class, 'edit']);
        Route::post('/class_room/update', [ClassRoomController::class, 'update']);
        // employee update and edit routes
        Route::get('/employee/edit/{id}', [EmployeeController::class, 'edit']);
        Route::post('/employee/update', [EmployeeController::class, 'update']);
    });
    // post graduated delete routes
    Route::middleware(['auth:sanctum', 'delete_post_graduated'])->group(function () {
        Route::get('/program/delete/{id}', [ProgramsController::class, 'destroy']);
        Route::get('post/delete/{id}', [TeacherController::class, 'destroy']);
        Route::get('/studnet/delete/{id}', [studentController::class, 'destroy']);
        Route::get('/graduated_student/delete/{id}', [graduatedStudentController::class, 'destroy']);
        Route::get('/student_research/delete/{id}', [StudentResearchController::class, 'destroy']);
        Route::get('/post_committee/delete/{id}', [PostCommitteeController::class, 'destroy']);
        Route::get('/post_committee_member/delete/{id}', [CommitteeMemberController::class, 'destroy']);
        Route::get('/board/delete/{id}', [BoradController::class, 'destroy']);
        Route::get('/board_member/delete/{id}', [BoardMemberController::class, 'destroy']);
        Route::get('/lab/delete/{id}', [LabController::class, 'destroy']);
        Route::get('/lab_equipment/delete/{id}', [LabEquipmentController::class, 'destroy']);
        Route::get('/class_room/delete/{id}', [ClassRoomController::class, 'destroy']);
        Route::get('/employee/delete/{id}', [EmployeeController::class, 'destroy']);
    });

    // research department view routes
    Route::middleware([
        'auth:sanctum', 'view_research_department'
    ])->group(function () {
        Route::get('/international_publisher', [InternatinalPublishmentController::class, 'index']);
        Route::get('/teacher_research', [TeacherResearchController::class, 'index']);
        Route::get('/curriculum', [CurriculumController::class, 'index']);
        Route::get('/curriculum/department', [CurriculumController::class, 'getAllDepartments']);
        Route::get('/research_lab', [LabController::class, 'index']);
        Route::get('/research_project', [ResearchProjectController::class, 'index']);
        Route::get('/experiment_detail', [ExperimentDetailController::class, 'index']);
        Route::get('/specialist_area', [SpecailistAreaController::class, 'index']);
    });

    // research department create routes
    Route::middleware(['auth::sanctum', 'create_research_department'])->group(function () {
        Route::post('/international_publisher/create', [InternatinalPublishmentController::class, 'create']);
        Route::post('/teacher_research/create', [TeacherResearchController::class, 'create']);
        Route::post('/curriculum/create', [CurriculumController::class, 'store']);
        Route::post('/research_lab/create', [LabController::class, 'create']);
        Route::post('/research_project/create', [ResearchProjectController::class, 'create']);
        Route::post('/specialist_area/create', [SpecailistAreaController::class, 'create']);
        Route::post('/experiment_detail/create', [ExperimentDetailController::class, 'create']);
    });


    // research department  edit and update routes
    Route::middleware(['auth:sanctum', 'edit_research_department'])->group(function () {
        //  internaital publisher
        Route::get('/international_publisher/edit/{id}', [InternatinalPublishmentController::class, 'edit']);
        Route::post('/international_publisher/update', [InternatinalPublishmentController::class, 'update']);
        // teacher research
        Route::get('/teacher_research/edit/{id}', [TeacherResearchController::class, 'edit']);
        Route::post('/teacher_research/update', [TeacherResearchController::class, 'update']);
        // curriculum
        Route::get('/curriculum/edit/{id}', [CurriculumController::class, 'edit']);
        Route::post('/curriculum/update', [CurriculumController::class, 'update']);
        // research labs
        Route::get('/research_lab/edit/{id}', [LabController::class, 'edit']);
        Route::post('/research_lab/update', [LabController::class, 'update']);
        // research project
        Route::get('/research_project/edit/{id}', [ResearchProjectController::class, 'edit']);
        Route::post('/research_project/update', [ResearchProjectController::class, 'update']);
        // specialist area
        Route::get('/specialist_area/edit/{id}', [SpecailistAreaController::class, 'edit']);
        Route::post('/specialist_area/update', [SpecailistAreaController::class, 'update']);
        // experimental details
        Route::get('/experiment_detail/edit/{id}', [ExperimentDetailController::class, 'edit']);
        Route::post('/experiment_detail/update', [ExperimentDetailController::class, 'update']);
    });

    // research department delete routes
    Route::middleware(['auth:sanctum', 'delete_research_department'])->group(function () {
        Route::get('/international_publisher/delete/{id}', [InternatinalPublishmentController::class, 'destroy']);
        Route::get('/teacher_research/delete/{id}', [TeacherResearchController::class, 'destroy']);
        Route::get('/curriculum/delete/{id}', [CurriculumController::class, 'destroy']);
        Route::get('/research_lab/delete/{id}', [LabController::class, 'destroy']);
        Route::get('/research_project/delete/{id}', [ResearchProjectController::class, 'destroy']);
        Route::get('/specialist_area/delete/{id}', [SpecailistAreaController::class, 'destroy']);
        Route::get('/experiment_detail/delete/{id}', [ExperimentDetailController::class, 'destroy']);
    });


    // test teacher report
    Route::get('teacher/report', [TeacherReportController::class, 'generateReport']);

    // Route::middleware(['auth:sanctum', 'edit_teacher'])->group(function () {
    //     Route::post('/teacher/update', [TeacherController::class, 'update']);
    // });
    // Route::middleware(['auth:sanctum', 'delete_teacher'])->group(function () {
    //     Route::post('/teacher/delete/{id}', [TeacherController::class, 'destroy']);
    // });
});


Route::post('/login', [AuthController::class, 'login']);
