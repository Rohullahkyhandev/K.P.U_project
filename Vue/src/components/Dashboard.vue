<template>
    <div class="min-w-full mt-4">
        <div class="m-2">
            <h1 class="text-3xl font-bold mb-4 text-gray-700">داشبورد</h1>
        </div>
        <div
            v-if="msg_welcome"
            class="min-w-96 items-center m-4 bg-indigo-300 rounded-lg shadow-lg flex justify-between gap-4 mb-4 font-bold py-10 px-8"
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
            <div></div>
        </div>
        <PDCDashboard v-if="view_pdc == true" />
        <!-- PDC DASHBOARD COMPONENT  -->
        <!-- chart -->
        <PDCChart v-if="view_pdc == true" />
        <!-- TEACHER DEPARTMENT DASHBOARD -->
        <TableView v-if="view_pdc == true" />
        <!-- POSTGRADUATED DEPARTMENT DASHBOARD -->

        <!-- RESEARCH DEPARTMENT DASHBOARD -->
    </div>
</template>
<script setup>
// dashboards
import PDCDashboard from "../views/dashboards/PDCDashboard.vue";
import PDCChart from "../views/dashboards/chart.vue";
import TableView from "../views/dashboards/table.vue";

import { computed, onMounted, ref } from "vue";
import { useAuthStore } from "../stores/auth";
import { useUserStore } from "../stores/user/userStore";

const authStore = useAuthStore();
const userStore = useUserStore();
const admin = computed(() => userStore.permission_current.administrator);
const view_pdc = computed(() => userStore.permission_current.view_pdc);

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
