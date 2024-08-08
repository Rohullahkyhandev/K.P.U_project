import { createRouter, createWebHistory } from "vue-router";

import Dashboard from "../components/Dashboard.vue";
import AppLayout from "../components/AppLayout.vue";
import Login from "../components/Login.vue";
import NotFound from "../components/NotFound.vue";
import { useAuthStore } from "../stores/auth";

// user
import CreateUser from "../views/users/create.vue";
import UserList from "../views/users/index.vue";
import UserEdit from "../views/users/edit.vue";
import UserDelete from "../views/users/delete.vue";
import UserPermission from "../views/users/userPermission.vue";
import CreatePermission from "../views/users/createPermission.vue";

// pdc
// import PDC_Document from "../views/pdc/table.vue";

// documents
import farwardedDocumentList from "../views/documents/fawardedList.vue";
import DocumentCreate from "../views/documents/create.vue";
import DocumentList from "../views/documents/index.vue";

// pdc plan
import CreatePlan from "../views/pdc/plan/create.vue";
import ListPlan from "../views/pdc/plan/index.vue";
import EditPlan from "../views/pdc/plan/edit.vue";

// pdc commit
import createCommit from "../views/pdc/commit/create.vue";
import listCommit from "../views/pdc/commit/index.vue";
import editCommit from "../views/pdc/commit/edit.vue";
import CommitTabHeader from "../views/pdc/table.vue";

// pdc teacher in commit
import createTeacherInCommit from "../views/pdc/teacherInCommit/create.vue";
import listTeacherInCommit from "../views/pdc/teacherInCommit/index.vue";
import editTeacherInCommit from "../views/pdc/teacherInCommit/edit.vue";

// pdc workshops
import createWorkshop from "../views/pdc/workshop/create.vue";
import listWorkshop from "../views/pdc/workshop/index.vue";
import editWorkshop from "../views/pdc/workshop/edit.vue";

// pdc teacher in workshp
import createTeacherInWorkshop from "../views/pdc/teacherInworkshop/create.vue";
import listTeacherInWorkshop from "../views/pdc/teacherInworkshop/index.vue";
import editTeacherInWorkshop from "../views/pdc/teacherInworkshop/edit.vue";

// pdc teacher in scholarships
import createTeacherInScholarship from "../views/pdc/teacher_in_scholarship/create.vue";
import listTeacherInScholarship from "../views/pdc/teacher_in_scholarship/index.vue";
import editTeacherInScholarship from "../views/pdc/teacher_in_scholarship/edit.vue";

// pdc archive
import CreateArchive from "../views/pdc/pdcArchives/create.vue";
import ListArchive from "../views/pdc/pdcArchives/index.vue";
import EditArchive from "../views/pdc/pdcArchives/edit.vue";

// quality assurance
import createCriteria from "../views/quality_assurance/create.vue";
import qualityArchiveList from "../views/quality_assurance/qualityList.vue";
import qualityArchiveEdit from "../views/quality_assurance/edit.vue";

// post graduated program
import postGraduatedProgramTabs from "../views/postgraduatedProgram/table.vue";
import CreatePG from "../views/postgraduatedProgram/programs/cerate.vue";
import listProgram from "../views/postgraduatedProgram/programs/index.vue";
import selectPG from "../views/postgraduatedProgram/programs/selectProgram.vue";

// post graduated program teacher
import postTeacherCreate from "../views/postgraduatedProgram/teacher/create.vue";

// post graduated program student
import postStudentCreate from "../views/postgraduatedProgram/student/create.vue";
import postStudentList from "../views/postgraduatedProgram/student/index.vue";
import postStudentEdit from "../views/postgraduatedProgram/student/edit.vue";

// post committee
import postCommitCreate from "../views/postgraduatedProgram/commit/create.vue";
import postCommitList from "../views/postgraduatedProgram/commit/idnex.vue";
import postCommitEdit from "../views/postgraduatedProgram/commit/edit.vue";

// post labs
import postLabelList from "../views/postgraduatedProgram/labs/index.vue";
import postEditLab from "../views/postgraduatedProgram/labs/edit.vue";

// POST LAB EQUIPMENT
import postToolsEdit from "../views/postgraduatedProgram/lab_tools/edit.vue";

// POST CLASS ROOMS
import postClassRoomList from "../views/postgraduatedProgram/class/index.vue";
import postEditClassRoom from "../views/postgraduatedProgram/class/edit.vue";

// BOARD LIST
import postBoardList from "../views/postgraduatedProgram/board/index.vue";
import postBoardEdit from "../views/postgraduatedProgram/board/edit.vue";

// BOARD MEMBER
import postBoardMemberList from "../views/postgraduatedProgram/boardMember/index.vue";
import postBoardMemberEdit from "../views/postgraduatedProgram/boardMember/edit.vue";

// faculty
import CreateFaculty from "../views/faculties/create.vue";
import ListFaculty from "../views/faculties/index.vue";
import detailsFaculty from "../views/faculties/details.vue";
import EditFaculty from "../views/faculties/edit.vue";

// department
import CreateDepartment from "../views/department/create.vue";
import DepartmentList from "../views/department/index.vue";
import editDepartment from "../views/department/edit.vue";

// teacher
import CreateTeacher from "../views/teachers/create.vue";
import ListTeacher from "../views/teachers/list.vue";
import detailsTeacher from "../views/teachers/details.vue";
import editTeacher from "../views/teachers/edit.vue";

// teacher report
import teacherReport from "../views/teachers/report.vue";

import createQualification from "../views/teachers/qualification.vue";
import editQualification from "../views/teachers/editQualification.vue";

// teacher document
// import createDocument from "../views/teachers/document.vue"
import createDocument from "../views/teachers/document.vue";
import editDocument from "../views/teachers/editDocument.vue";
// teacher literature
import createLiterature from "../views/teachers/literature.vue";
import editLiterature from "../views/teachers/editliterature.vue";
// teacher articles
import createArticle from "../views/teachers/article.vue";
import editArticle from "../views/teachers/editArticle.vue";

// research department
// curriculum
import listCurriculum from "../views/researchDepartment/curriculum/index.vue";
import editCurriculum from "../views/researchDepartment/curriculum/edit.vue";

// reports routes
import pdcTeacherInCommitReport from "../views/reports/pdc_teacher_in_commit.vue";
import pdcTeacherInScholarshipReport from "../views/reports/pdc_teacher_in_scholarship.vue";

// employee
import createEmployee from "../views/employee/create.vue";
import listEmployee from "../views/employee/index.vue";
import editEmployee from "../views/employee/edit.vue";

// student research
import createStudentResearch from "../views/postgraduatedProgram/studentResearch/create.vue";
import editStudentResearch from "../views/postgraduatedProgram/studentResearch/edit.vue";

// import editCurriculum from "../views/researchDepartment/curriculum/edit.vue";

//internationl publishment
import listinterpublishment from "../views/researchDepartment/interpublishment/index.vue";
import editInterpublishment from "../views/researchDepartment/interpublishment/edit.vue";

//labaratory
import listLabaratory from "../views/researchDepartment/labs/index.vue";
import editLabaratory from "../views/researchDepartment/labs/edit.vue";

//teacher research
import listTeacherResearch from "../views/researchDepartment/teacherResearch/index.vue";
import editTeacherResearch from "../views/researchDepartment/teacherResearch/edit.vue";

// tab bar
import tabHeader from "../views/researchDepartment/table.vue";

//research projects
import listResearchProject from "../views/researchDepartment/resproject/index.vue";
import editResearchProject from "../views/researchDepartment/resproject/edit.vue";

//experiment details
import listExpDetails from "../views/researchDepartment/expdetails/index.vue";
import editExpDetails from "../views/researchDepartment/expdetails/edit.vue";

//special area
import listSpecialArea from "../views/researchDepartment/specialarea/index.vue";
import editSpecialArea from "../views/researchDepartment/specialarea/edit.vue";

// post student report route
import studentReport from "../views/reports/student_report.vue";
import boardReport from "../views/reports/boardMember.vue";
import commitMember from "../views/reports/commitMember.vue";
import teacherResearchReport from "../views/reports/teacher_research.vue";

const routes = [
    {
        path: "/",
        redirect: "/app",
    },

    {
        path: "/app",
        name: "app",
        redirect: "/app/dashboard",
        component: AppLayout,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                path: "dashboard",
                name: "app.dashboard",
                component: Dashboard,
            },

            // users
            {
                path: "user/create",
                name: "app.user.create",
                component: CreateUser,
            },
            {
                path: "user/edit/:id",
                name: "app.user.edit",
                component: UserEdit,
            },

            {
                path: "user/permission/:id",
                name: "app.user.permission",
                component: UserPermission,
            },

            {
                path: "user/create/permission/:id",
                name: "app.user.permission_create",
                component: CreatePermission,
            },

            {
                path: "user/list",
                name: "app.user.list",
                component: UserList,
            },

            //documents
            {
                path: "farwarded/list",
                name: "app.document.farwarded.list",
                component: farwardedDocumentList,
            },
            {
                path: "document/create",
                name: "app.document.create",
                component: DocumentCreate,
            },

            {
                path: "document/list ",
                name: "app.document.list",
                component: DocumentList,
            },

            //plan
            {
                path: "plan/create",
                name: "app.pdc.plan.create",
                component: CreatePlan,
            },
            {
                path: "plan/list",
                name: "app.pdc.plan.list",
                component: ListPlan,
            },
            {
                path: "plan/edit/:id",
                name: "app.pdc.plan.edit",
                component: EditPlan,
            },

            //commits
            {
                path: "/app",
                name: "app.pdc.commit",
                component: CommitTabHeader,
                redirect: "/commit/list",
                children: [
                    {
                        path: "/commit/list",
                        name: "app.pdc.commit.list",
                        component: listCommit,
                    },
                    {
                        path: "/commit/create",
                        name: "app.pdc.commit.create",
                        component: createCommit,
                    },
                    {
                        path: "/commit/edit/:id",
                        name: "app.pdc.commit.edit",
                        component: editCommit,
                    },
                    // teacher in commits
                    {
                        path: "teacher_in_commit/create",
                        name: "app.pdc.teacher_in_commit.create",
                        component: createTeacherInCommit,
                    },
                    {
                        path: "teacher_in_commit/list",
                        name: "app.pdc.teacher_in_commit.list",
                        component: listTeacherInCommit,
                    },
                    {
                        path: "teacher_in_commit/edit/:id",
                        name: "app.pdc.teacher_in_commit.edit",
                        component: editTeacherInCommit,
                    },
                ],
            },

            // pdc workshops
            {
                path: "workshop/create",
                name: "app.pdc.workshop.create",
                component: createWorkshop,
            },

            {
                path: "workshop/list",
                name: "app.pdc.workshop.list",
                component: listWorkshop,
            },

            {
                path: "workshop/edit/:id",
                name: "app.pdc.workshop.edit",
                component: editWorkshop,
            },

            // pdc teacher in workshops
            {
                path: "teacher_in_workshop/create",
                name: "app.pdc.teacher_in_workshop.create",
                component: createTeacherInWorkshop,
            },

            {
                path: "teacher_in_workshop/list",
                name: "app.pdc.teacher_in_workshop.list",
                component: listTeacherInWorkshop,
            },

            {
                path: "teacher_in_workshop/edit/:id",
                name: "app.pdc.teacher_in_workshop.edit",
                component: editTeacherInWorkshop,
            },

            // teachers in scholarships

            {
                path: "teacher_in_scholarship/create",
                name: "app.pdc.teacher_in_scholarship.create",
                component: createTeacherInScholarship,
            },

            {
                path: "teacher_in_scholarship/list",
                name: "app.pdc.teacher_in_scholarship.list",
                component: listTeacherInScholarship,
            },

            {
                path: "teacher_in_scholarship/:id/edit/:f_id",
                name: "app.pdc.teacher_in_scholarship.edit",
                component: editTeacherInScholarship,
            },

            // quality assurance routes
            {
                path: "criteria/create",
                name: "app.criteria.create",
                component: createCriteria,
            },

            // quality assurance routes
            {
                path: "quality/list",
                name: "app.quality.list",
                component: qualityArchiveList,
            },
            {
                path: "quality/edit/:id",
                name: "app.quality.edit",
                component: qualityArchiveEdit,
            },

            // post graduated program

            {
                path: "post/create",
                name: "app.post.create",
                component: CreatePG,
            },

            {
                path: "post/list",
                name: "app.post.list",
                component: listProgram,
            },

            {
                path: "select_program",
                name: "app.post.select_program",
                component: selectPG,
            },

            {
                path: "post-graduated-program",
                name: "app.post-graduated-program",
                redirect: "/post-graduated-program/teacher/create",
                component: postGraduatedProgramTabs,
                children: [
                    {
                        path: "/post-graduated-program/teacher/create",
                        name: "app.post-graduated.teacher.create",
                        component: postTeacherCreate,
                    },

                    {
                        path: "student/create",
                        name: "app.post-graduated.student.create",
                        component: postStudentCreate,
                    },

                    {
                        path: "student/list",
                        name: "app.post-graduated.student.list",
                        component: postStudentList,
                    },

                    {
                        path: "student/edit/:id",
                        name: "app.post-graduated.student.edit",
                        component: postStudentEdit,
                    },

                    // labs
                    {
                        path: "lab/list",
                        name: "app.post-graduated.lab.list",
                        component: postLabelList,
                    },

                    {
                        path: "lab/edit/:id",
                        name: "app.post-graduated.lab.edit",
                        component: postEditLab,
                    },

                    {
                        path: "tools/edit/:id",
                        name: "app.post-graduated.tools.edit",
                        component: postToolsEdit,
                    },

                    // class rooms

                    {
                        path: "class_room/list",
                        name: "app.post-graduated.class_room.list",
                        component: postClassRoomList,
                    },

                    {
                        path: "class_room/edit:id",
                        name: "app.post-graduated.class_room.edit",
                        component: postEditClassRoom,
                    },

                    {
                        path: "student_research/create/:id",
                        name: "app.post-graduated.student_research.create",
                        component: createStudentResearch,
                    },

                    {
                        path: "student_research/edit/:id",
                        name: "app.post-graduated.student_research.edit",
                        component: editStudentResearch,
                    },
                ],
            },
            // post committees
            {
                path: "commit/create",
                name: "app.post-graduated.commit.create",
                component: postCommitCreate,
            },

            {
                path: "commit/list",
                name: "app.post-graduated.commit.list",
                component: postCommitList,
            },

            {
                path: "commit/edit/:id",
                name: "app.post-graduated.commit.edit",
                component: postCommitEdit,
            },

            // board list
            {
                path: "board/list",
                name: "app.post-graduated.board.list",
                component: postBoardList,
            },

            {
                path: "board/edit/:id",
                name: "app.post-graduated.board.edit",
                component: postBoardEdit,
            },

            // board Member

            {
                path: "board_member/list",
                name: "app.post-graduated.board_member.list",
                component: postBoardMemberList,
            },

            {
                path: "board_member/edit/:id",
                name: "app.post-graduated.board_member.edit",
                component: postBoardMemberEdit,
            },

            // archive
            {
                path: "archive/create",
                name: "app.pdc.archive.create",
                component: CreateArchive,
            },
            {
                path: "archive/list",
                name: "app.pdc.archive.list",
                component: ListArchive,
            },
            {
                path: "archive/edit/:id",
                name: "app.pdc.archive.edit",
                component: EditArchive,
            },

            // faculties
            {
                path: "faculty/create",
                name: "app.faculty.create",
                component: CreateFaculty,
            },
            {
                path: "faculty/list",
                name: "app.faculty.list",
                component: ListFaculty,
            },
            {
                path: "faculty/details/:id",
                name: "app.faculty.details",
                component: detailsFaculty,
            },

            {
                path: "faculty/edit/:id",
                name: "app.faculty.edit",
                component: EditFaculty,
            },

            // departments
            {
                path: "department/create",
                name: "app.department.create",
                component: CreateDepartment,
            },
            {
                path: "department/list",
                name: "app.department.list",
                component: DepartmentList,
            },

            {
                path: "department/edit/:id",
                name: "app.department.edit",
                component: editDepartment,
            },

            // teacher
            {
                path: "faculty/teacher/create",
                name: "app.teacher.create",
                component: CreateTeacher,
            },
            {
                path: "teacher/list",
                name: "app.teacher.list",
                component: ListTeacher,
            },
            {
                path: "teacher/details/:id",
                name: "app.teacher.details",
                component: detailsTeacher,
            },
            {
                path: "teacher/edit/:id",
                name: "app.teacher.edit",
                component: editTeacher,
            },

            {
                path: "qualification/create/:id",
                name: "app.teacher.qualification.create",
                component: createQualification,
            },

            {
                path: "qualification/:q_id/edit/:t_id",
                name: "app.teacher.qualification.edit",
                component: editQualification,
            },

            {
                path: "document/create/:id",
                name: "app.teacher.document.create",
                component: createDocument,
            },

            {
                path: "document/:d_id/edit/:t_id",
                name: "app.teacher.document.edit",
                component: editDocument,
            },

            {
                path: "literature/create/:id",
                name: "app.teacher.literature.create",
                component: createLiterature,
            },

            {
                path: "literature/:l_id/edit/:t_id",
                name: "app.teacher.literature.edit",
                component: editLiterature,
            },

            {
                path: "article/create/:id",
                name: "app.teacher.article.create",
                component: createArticle,
            },

            {
                path: "article/:a_id/edit/:t_id",
                name: "app.teacher.article.edit",
                component: editArticle,
            },

            // research department curriculum
            {
                path: "curriculum/list",
                name: "app.research.curriculum.list",
                component: listCurriculum,
            },

            {
                path: "curriculum/edit/:id",
                name: "app.research.curriculum.edit",
                component: editCurriculum,
            },

            // research department
            // curriculum
            {
                path: "curriculum/list",
                name: "app.research.curriculum.list",
                component: listCurriculum,
            },

            //international publishment
            {
                path: "interpub/list",
                name: "app.research.interpub.list",
                component: listinterpublishment,
            },
            {
                path: "interpub/edit/:id",
                name: "app.research.interpub.edit",
                component: editInterpublishment,
            },
            // labaratory
            {
                path: "lab/list",
                name: "app.research.lab.list",
                component: listLabaratory,
            },
            {
                path: "lab/edit/:id",
                name: "app.research.lab.edit",
                component: editLabaratory,
            },
            // teacher researchs
            {
                path: "tresearch/list",
                name: "app.research.tresearch.list",
                component: listTeacherResearch,
            },
            {
                path: "tresearch/edit/:id",
                name: "app.research.tresearch.edit",
                component: editTeacherResearch,
            },

            {
                path: "research",
                name: "app.research.tabs",
                component: tabHeader,
                redirect: "reseach/lab/list",
                children: [
                    {
                        path: "/research/lab/list",
                        name: "app.research.lab.list",
                        component: listLabaratory,
                    },

                    // research project
                    {
                        path: "resproject/list",
                        name: "app.research.resproject.list",
                        component: listResearchProject,
                    },
                    {
                        path: "resproject/edit/:id",
                        name: "app.research.resproject.edit",
                        component: editResearchProject,
                    },
                    // experiment details
                    {
                        path: "expdetails/list",
                        name: "app.research.expdetails.list",
                        component: listExpDetails,
                    },
                    {
                        path: "expdetails/edit/:id",
                        name: "app.research.expdetails.edit",
                        component: editExpDetails,
                    },
                    //special area
                    {
                        path: "specialarea/list",
                        name: "app.research.specialarea.list",
                        component: listSpecialArea,
                    },
                    {
                        path: "specialarea/edit/:id",
                        name: "app.research.specialarea.edit",
                        component: editSpecialArea,
                    },
                ],
            },

            // reports path
            {
                path: "pdc/report/teacher_in_commit",
                name: "app.pdc.report.teacher_in_commit",
                component: pdcTeacherInCommitReport,
            },
            {
                path: "pdc/report/teacher_in_scholarship",
                name: "app.pdc.report.teacher_in_scholarship",
                component: pdcTeacherInScholarshipReport,
            },

            // employee routes
            {
                path: "employee/list",
                name: "app.employee.list",
                component: listEmployee,
            },
            {
                path: "employee/create",
                name: "app.employee.create",
                component: createEmployee,
            },

            {
                path: "employee/edit/:id",
                name: "app.employee.edit",
                component: editEmployee,
            },

            // teacher report
            {
                path: "/student/report",
                name: "app.student.report",
                component: studentReport,
            },

            {
                path: "/board_member/report",
                name: "app.board.report",
                component: boardReport,
            },

            {
                path: "/post/commit_member/report",
                name: "app.post.commit_member.report",
                component: commitMember,
            },
            // teacher research reports
            {
                path: "/teacher_research/report",
                name: "app.teacher_research.report",
                component: teacherResearchReport,
            },
        ],
    },

    // teacher report
    {
        path: "/teacher/report",
        name: "teacher.report",
        component: teacherReport,
    },

    {
        path: "/login",
        name: "login",
        component: Login,
    },
    {
        path: "/:pathMatch(.*)",
        name: "notfound",
        component: NotFound,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const authStore = useAuthStore();
    if (to.meta.requiresAuth && !authStore.user.token) {
        next({ name: "login" });
    } else if (authStore.user.token && to.meta.requiresGuest) {
        next({ name: "app.dashboard" });
    } else {
        next();
    }
});

export default router;
