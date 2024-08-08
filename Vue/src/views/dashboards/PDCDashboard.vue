<template>
    <div class="container mx-auto mb-3">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
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

            <!-- total teacher in Scholarships -->
            <div
                class="bg-gradient-to-r from-gray-300 to-white text-black shadow-xl rounded-lg p-6 flex items-center space-x-6 gap-6 transform transition hover:scale-105"
            >
                <div class="flex-shrink-0">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-20 h-20 bg-gray-200 text-blue-500 rounded-full p-3"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"
                        />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold">تعداد استادان در بورسیه</div>
                    <div class="text-2xl font-bold">
                        {{ total_teacher_in_scholarships }}
                    </div>
                </div>
            </div>

            <!-- number of commit -->
            <div
                class="bg-gradient-to-r from-gray-100 to-white text-black shadow-xl rounded-lg p-6 flex items-center gap-6 space-x-4 transform transition hover:scale-105"
            >
                <div class="flex-shrink-0">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-20 h-20 bg-gray-200 text-orange-500 rounded-full p-3"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"
                        />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold">تعداد کمته ها</div>
                    <div class="text-2xl font-bold">
                        {{ total_commits }}
                    </div>
                </div>
            </div>

            <!-- number of data and attachment in archive -->
            <div
                class="bg-gradient-to-r from-gray-100 to-white text-black shadow-xl rounded-lg p-6 flex items-center gap-6 space-x-4 transform transition hover:scale-105"
            >
                <div class="flex-shrink-0">
                    <svg
                        class="w-20 h-20 bg-gray-200 text-blue-500 rounded-full p-3"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M7 8h10M7 12h4m1 8H6a2 2 0 01-2-2V6a2 2 0 012-2h7l5 5v9a2 2 0 01-2 2z"
                        />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold">تعداد فایل ها در آرشیف</div>
                    <div class="text-2xl font-bold">
                        {{ total_file_in_archvie }}
                    </div>
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
        </div>
    </div>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import axiosClient from "../../axios";
// import usePdcDashboadStore from "../../stores/pdc/dashboard/pdcDashboardStore";
// const pdcDashboardStore = usePdcDashboadStore();

let total_teacher_in_scholarships = ref();
let total_file_in_archvie = ref();
let total_send_docs = ref();
let total_rec_docs = ref();
let total_commits = ref();
let total_employees = ref();

const getTotalData = async () => {
    try {
        const response = await axiosClient.get("/pdc/report/total");
        total_teacher_in_scholarships.value = response.data.total_teacher;
        total_file_in_archvie.value = response.data.total_file;
        total_send_docs.value = response.data.total_send_docs;
        total_rec_docs.value = response.data.total_rec_docs;
        total_commits.value = response.data.total_committee;
        total_employees.value = response.data.total_employees;
    } catch (err) {
        console.log("errr" + err);
    }
};

onMounted(() => {
    getTotalData();
});
</script>
