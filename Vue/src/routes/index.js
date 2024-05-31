import { createRouter, createWebHistory } from "vue-router";

import DashboardChart from "../views/liner.vue";
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
import PDC_Document from "../views/pdc/table.vue";

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

// post graduated program
import postGraduatedProgramTabs from "../views/postgraduatedProgram/table.vue";
import CreatePG from "../views/postgraduatedProgram/programs/cerate.vue";
import listProgram from "../views/postgraduatedProgram/programs/index.vue";
import selectPG from "../views/postgraduatedProgram/programs/selectProgram.vue";

// post graduated program teacher
import postTeacherCreate from "../views/postgraduatedProgram/teacher/create.vue";

// import ListPG from "../views/post_graduated_program/index.vue";
// import EditPG from "../views/post_graduated_program/edit.vue";
// import DetailsPG from "../views/post_graduated_program/details.vue";

// scholarship

// faculty
import CreateFaculty from "../views/faculties/create.vue";
import ListFaculty from "../views/faculties/index.vue";
import detailsFaculty from "../views/faculties/details.vue";
import EditFaculty from "../views/faculties/edit.vue";

// department
import CreateDepartment from "../views/department/create.vue";

// teacher
import CreateTeacher from "../views/teachers/create.vue";
import ListTeacher from "../views/teachers/index.vue";
import detailsTeacher from "../views/teachers/details.vue";
import editTeacher from "../views/teachers/edit.vue";

import createQualification from "../views/teachers/qualification.vue";
import editQualification from "../views/teachers/editQualification.vue";

// teacher document
import createDocument from "../views/teachers/document.vue";
import editDocument from "../views/teachers/editDocument.vue";
// teacher literature
import createLiterature from "../views/teachers/literature.vue";
import editLiterature from "../views/teachers/editliterature.vue";
// teacher articles
import createArticle from "../views/teachers/article.vue";
import editArticle from "../views/teachers/editArticle.vue";

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
                path: "chart",
                name: "app.chart",
                component: DashboardChart,
            },
            // chart
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
                ],
            },

            // {
            //     path: "teacher_in_workshop/list",
            //     name: "app.pdc.teacher_in_workshop.list",
            //     component: listTeacherInWorkshop,
            // },

            // {
            //     path: "teacher_in_workshop/edit/:id",
            //     name: "app.pdc.teacher_in_workshop.edit",
            //     component: editTeacherInWorkshop,
            // },

            // {
            //     path: "teacher_in_commit/list",
            //     name: "app.pdc.teacher_in_commit.list",
            //     component: listTeacherInCommit,
            // },
            // {
            //     path: "teacher_in_commit/edit/:id",
            //     name: "app.pdc.teacher_in_commit.edit",
            //     component: editTeacherCommit,
            // },

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
                path: "faculty/department/create/:id",
                name: "app.faculty.department.create",
                component: CreateDepartment,
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
        ],
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
