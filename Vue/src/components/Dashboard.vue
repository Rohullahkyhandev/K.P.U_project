<template>
    <div class="min-w-full mt-4 px-8">
        <div class="m-2">
            <h1 class="text-3xl font-bold mb-4 text-gray-700">داشبورد</h1>
        </div>
        <div
            v-if="msg_welcome"
            class="min-w-96 items-center bg-blue-800 text-white rounded-sm shadow-lg flex justify-between gap-4 mb-4 font-bold py-10 px-8"
        >
            <div>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    @click="msg_welcome = false"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="currentColor"
                    class="w-8 h-8 cursor-pointer hover:bg-gray-100 rounded-full"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 18 18 6M6 6l12 12"
                    />
                </svg>
            </div>
            <div>
                <h1 class="text-3xl">
                    به سیستم خوش آمدید {{ authStore.user.data.name }}
                </h1>
            </div>
            <div class="text-2xl">🙌</div>
        </div>
        <div
            v-if="
                (view_pdc &&
                    view_post_graduated &&
                    view_research_department &&
                    view_teacher_department &&
                    view_quality_assurance) ||
                administrator
            "
        >
            <DashboardTabs />
        </div>
        <div v-if="view_pdc == true">
            <!-- PDC DASHBOARD COMPONENT  -->
            <PDCDashboard />
            <br />
            <PDCChart />
            <br />
            <TableView />
        </div>
        <!-- TEACHER DEPARTMENT DASHBOARD -->
        <div>
            <TeacherDashboard v-if="teacher_department_view == true" />
        </div>
        <!-- POSTGRADUATED DEPARTMENT DASHBOARD -->
        <div v-if="view_post_graduated">
            <PostDashboard />
        </div>
        <!-- RESEARCH DEPARTMENT DASHBOARD -->
        <div v-if="view_research_department">
            <ResearchDashboard />
        </div>

        <!-- RESEARCH DEPARTMENT DASHBOARD -->
        <div v-if="view_research_department">
            <ResearchDashboard />
        </div>

        <!-- faculty -->
        <div
            class="mb-3"
            v-if="
                authStore.user.data.user_type == 'faculty_user'
            "
        >
            <facultyDashboard />
        </div>

        <!-- departments  -->

        <div
            class="mb-3"
        >
            <QualityInhancment v-if="view_quality_assurance" />
        </div>
    </div>
</template>
<script setup>
// dashboards
import PDCDashboard from "../views/dashboards/PDCDashboard.vue";
import PDCChart from "../views/dashboards/chart.vue";
import TableView from "../views/dashboards/table.vue";
import PostDashboard from "../views/dashboards/PostGraduatedDashboard.vue";
import ResearchDashboard from "../views/dashboards/ResearchDepartmentDashboard.vue";
import DashboardTabs from "../views/dashboards/DashboardTabs.vue";
import facultyDashboard from "../views/dashboards/facultyDashboard.vue";
import departmentDashboard from "../views/dashboards/departmentDashboard.vue";
import QualityInhancment from "../views/dashboards/QualityInhancment.vue";

// teacher Dashboard
import TeacherDashboard from "../views/dashboards/TeacherDashboard.vue";

import { computed, onMounted, ref } from "vue";
import { useAuthStore } from "../stores/auth";
import { useUserStore } from "../stores/user/userStore";

const authStore = useAuthStore();
const userStore = useUserStore();
const admin = computed(() => userStore.permission_current.administrator);
const view_pdc = computed(() => userStore.permission_current.view_pdc);
const view_teacher_department = computed(
    () => userStore.permission_current.view_teacher_department
);
const view_post_graduated = computed(
    () => userStore.permission_current.view_post_graduated
);
const view_quality_assurance = computed(
    () => userStore.permission_current.view_quality_assurance
);

const view_research_department = computed(
    () => userStore.permission_current.view_research_department
);

const administrator = computed(
    () => userStore.permission_current.administrator
);

onMounted(() => {
    getUser();
    getCurrentPermission();
});

function getUser() {
    authStore.getUser();
}

function getCurrentPermission() {
    userStore.getCurrentPermission();
}

let msg_welcome = ref(true);
</script>
