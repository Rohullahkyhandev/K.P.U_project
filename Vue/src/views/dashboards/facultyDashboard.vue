<template>
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- number of departments -->
            <div
                class="bg-gradient-to-r from-gray-100 to-white text-black shadow-lg rounded-lg p-6 flex items-center gap-6 space-x-4 transform transition hover:scale-105"
            >
                <div class="flex-shrink-0">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6 w-20 h-20 bg-gray-200 text-purple-500 rounded-full p-3"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"
                        />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold">تعداد دیپارتمنت</div>
                    <div class="text-2xl font-bold">{{ total_department }}</div>
                </div>
            </div>

            <!-- number of employee in the pdc department -->
            <div
                class="bg-gradient-to-r from-gray-100 to-white text-black shadow-lg rounded-lg p-6 flex items-center gap-6 space-x-4 transform transition hover:scale-105"
            >
                <div class="flex-shrink-0">
                    <svg
                        class="size-6 w-20 h-20 bg-gray-200 text-purple-500 rounded-full p-3"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"
                        />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold">تعداد کارمندان</div>
                    <div class="text-2xl font-bold">{{ total_employees }}</div>
                </div>
            </div>

            <!-- Sent Documents Card -->
            <div
                class="bg-white text-black shadow-xl rounded-lg p-6 flex items-center gap-6 space-x-4 transform transition hover:scale-105"
            >
                <div class="flex-shrink-0">
                    <svg
                        xmlns="http:/www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-20 h-20 bg-gray-200 text-green-500 rounded-full p-3"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                        />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold">تعداد مکتوب های صادره</div>
                    <div class="text-2xl font-bold">
                        {{ total_send_docs }}
                    </div>
                </div>
            </div>

            <!-- Received Documents Card -->
            <div
                class="bg-gradient-to-r from-gray-200 to-white text-black shadow-xl rounded-lg p-6 flex items-center gap-6 space-x-4 transform transition hover:scale-105"
            >
                <div class="flex-shrink-0">
                    <svg
                        xmlns="http:/www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-20 h-20 bg-gray-200 text-red-500 rounded-full p-3"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                        />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold">تعداد مکتوب های وارده</div>
                    <div class="text-2xl font-bold">
                        {{ total_rec_docs }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import axiosClient from "../../axios";

let total_department = ref("");
let total_employees = ref("");
let total_send_docs = ref("");
let total_rec_docs = ref("");

const getTotalData = async () => {
    try {
        const response = await axiosClient.get("/faculty/report");
        total_department.value = response.data.total_departments;
        total_employees.value = response.data.total_employees;
        total_send_docs.value = response.data.total_send_docs;
        total_rec_docs.value = response.data.total_rec_docs;
    } catch (err) {
        console.log("errr" + err);
    }
};

onMounted(() => {
    getTotalData();
});
</script>
