<template>
    <div class="min-w-full mt-6">
        <div class="m-4">
            <h1 class="text-3xl font-bold mb-7 text-gray-700">
                داشبورد آمریت پی.دی.سی
            </h1>
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
        <!-- <Combobox /> -->
        <!-- PDC DASHBOARD COMPONENT  -->
        <PDCDashboard />
        <!-- chart -->
        <PDCChart />
        <!-- TEACHER DEPARTMENT DASHBOARD -->
        <!-- POSTGRADUATED DEPARTMENT DASHBOARD -->

        <!-- RESEARCH DEPARTMENT DASHBOARD -->
    </div>
</template>
<script setup>
// dashboards
import PDCDashboard from "../views/dashboards/PDCDashboard.vue";
import PDCChart from "../views/dashboards/chart.vue";

import Message from "./Message.vue";

const msg_success = ref("Hello, how are you man");
const msg_wrang = ref("Hello, how are you man");

import Combobox from "./Combox.vue";

import { computed, onMounted, ref } from "vue";
import { useAuthStore } from "../stores/auth";
import { useUserStore } from "../stores/user/userStore";

const authStore = useAuthStore();
const userStore = useUserStore();
const admin = computed(() => userStore.permission_current.admin);

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

const isOpen = ref(false);
const url = ref("./path/pdf/name.pdf");
function openPDF() {
    isOpen.value = true;
}
</script>
