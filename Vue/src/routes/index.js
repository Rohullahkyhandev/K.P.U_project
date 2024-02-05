import { createRouter, createWebHistory } from 'vue-router'


import DashboardChart from '../views/liner.vue'
import Dashboard from '../components/Dashboard.vue'
import AppLayout from '../components/AppLayout.vue'
import Login from '../components/Login.vue'
import NotFound from '../components/NotFound.vue'
import { useAuthStore } from '../stores/auth'


// user
import CreateUser from '../views/users/create.vue'
import UserList from '../views/users/index.vue'
import UserEdit from '../views/users/edit.vue'
import UserDelete from '../views/users/delete.vue'
import UserPermission from '../views/users/userPermission.vue'
import CreatePermission from '../views/users/createPermission.vue'

// pdc
import PDC_Document from '../views/pdc/table.vue'
// send document
import SendDocument from '../views/pdc/sendDocument/index.vue'
import CreateSendDocument from '../views/pdc/sendDocument/create.vue'
import EditSendDocument from '../views/pdc/sendDocument/edit.vue'

// received document
import ReceivedDocument from '../views/pdc/receivedDocument/index.vue'
import CreateReceivedDocument from '../views/pdc/receivedDocument/create.vue'
import EditReceivedDocument from '../views/pdc/receivedDocument/edit.vue'

// pdc plan
import CreatePlan from '../views/pdc/plan/create.vue'
import ListPlan from '../views/pdc/plan/index.vue'
import EditPlan from '../views/pdc/plan/edit.vue'

// pdc archive
import CreateArchive from '../views/pdc/pdcArchives/create.vue'
import ListArchive from '../views/pdc/pdcArchives/index.vue'
import EditArchive from '../views/pdc/pdcArchives/edit.vue'

// faculty
import CreateFaculty from '../views/faculties/create.vue'
import ListFaculty from '../views/faculties/index.vue'
import detailsFaculty from '../views/faculties/details.vue'
import EditFaculty from '../views/faculties/edit.vue'

// department
import CreateDepartment from '../views/department/create.vue'

// teacher
import CreateTeacher from '../views/teachers/create.vue'
import ListTeacher from '../views/teachers/index.vue'
import detailsTeacher from '../views/teachers/details.vue'
import editTeacher from '../views/teachers/edit.vue'
import createQualification from '../views/teachers/qualification.vue'

// teacher document
import createDocument from '../views/teachers/document.vue'
import editDocument from '../views/teachers/edit_document.vue'
// teacher literature
import createLiterature from '../views/teachers/literature.vue'

const routes = [

    {
        path: '/',
        redirect: '/app'
    },

    {
        path: '/app',
        name: 'app',
        redirect: '/app/dashboard',
        component: AppLayout,
        meta: {
            requiresAuth: true,
        },
        children: [
            {
                path: 'chart',
                name: 'app.chart',
                component: DashboardChart
            },
            // chart
            {
                path: 'dashboard',
                name: 'app.dashboard',
                component: Dashboard
            },

            // users
            {
                path: 'user/create',
                name: 'app.user.create',
                component: CreateUser
            },
            {
                path: 'user/edit/:id',
                name: 'app.user.edit',
                component: UserEdit
            },

            {
                path: 'user/permission/:id',
                name: 'app.user.permission',
                component: UserPermission
            },

            {
                path: 'user/create/permission/:id',
                name: 'app.user.permission_create',
                component: CreatePermission
            },

            {
                path: 'user/list',
                name: 'app.user.list',
                component: UserList
            },

            // pdc
            {
                path: '/pdc/documents',
                name: 'app.pdc.documents',
                redirect: '/pdc/documents/received',
                component: PDC_Document,
                children: [
                    // send documents route
                    {
                        path: 'send',
                        name: 'app.pdc.send_document',
                        component: SendDocument,
                    },
                    // received document
                    {
                        path: 'received',
                        name: 'app.pdc.received_document',
                        component: ReceivedDocument,
                    },
                ],

            },


            {
                path: 'documents/received/create',
                name: 'app.pdc.received_document_create',
                component: CreateReceivedDocument,
            },
            {
                path: 'documents/received/edit/:id',
                name: 'app.pdc.received_document.edit',
                component: EditReceivedDocument,
            },

            //send document
            {
                path: 'documents/send/create',
                name: 'app.pdc.send_document_create',
                component: CreateSendDocument,
            },
            {
                path: 'documents/send/edit/:id',
                name: 'app.pdc.send_document.edit',
                component: EditSendDocument,
            },

            //plan
            {
                path: 'plan/create',
                name: 'app.pdc.plan.create',
                component: CreatePlan
            },
            {
                path: 'plan/list',
                name: 'app.pdc.plan.list',
                component: ListPlan
            },
            {
                path: 'plan/edit/:id',
                name: 'app.pdc.plan.edit',
                component: EditPlan
            },

            // archive
            {
                path: 'archive/create',
                name: 'app.pdc.archive.create',
                component: CreateArchive
            },
            {
                path: 'archive/list',
                name: 'app.pdc.archive.list',
                component: ListArchive
            },
            {
                path: 'archive/edit/:id',
                name: 'app.pdc.archive.edit',
                component: EditArchive
            },

            // faculties
            {
                path: 'faculty/create',
                name: 'app.faculty.create',
                component: CreateFaculty
            },
            {
                path: 'faculty/list',
                name: 'app.faculty.list',
                component: ListFaculty
            },
            {
                path: 'faculty/details/:id',
                name: 'app.faculty.details',
                component: detailsFaculty
            },

            {
                path: 'faculty/edit/:id',
                name: 'app.faculty.edit',
                component: EditFaculty
            },

            // departments
            {
                path: 'faculty/department/create/:id',
                name: 'app.faculty.department.create',
                component: CreateDepartment
            },

            // teacher
            {
                path: 'faculty/teacher/create',
                name: 'app.teacher.create',
                component: CreateTeacher
            },
            {
                path: 'teacher/list',
                name: 'app.teacher.list',
                component: ListTeacher
            },
            {
                path: 'teacher/details/:id',
                name: 'app.teacher.details',
                component: detailsTeacher
            },
            {
                path: 'teacher/edit/:id',
                name: 'app.teacher.edit',
                component: editTeacher
            },

            {
                path: 'qualification/create/:id',
                name: 'app.qualification.create',
                component: createQualification
            },

            {
                path: 'document/create/:id',
                name: 'app.document.create',
                component: createDocument
            },

            {
                path: 'document/edit/:id',
                name: 'app.document.edit',
                component: editDocument
            },

            {
                path: 'literature/create/:id',
                name: 'app.literature.create',
                component: createLiterature
            },


        ]
    },

    {
        path: '/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/:pathMatch(.*)',
        name: 'notfound',
        component: NotFound
    },

]



const router = createRouter({
    history: createWebHistory(),
    routes
})


router.beforeEach((to, from, next) => {
    const authStore = useAuthStore();
    if (to.meta.requiresAuth && !authStore.user.token) {
        next({ name: 'login' })
    } else if (authStore.user.token && to.meta.requiresGuest) {
        next({ name: 'app.dashboard' })
    }
    else {
        next();
    }
})

export default router;
