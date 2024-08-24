<template>
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Sent Documents Card -->
            <div
                class="bg-white text-black shadow-xl rounded-lg p-6 flex items-center gap-6 space-x-4 transform transition hover:scale-105">
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 w-20 h-20 bg-gray-200 text-pink-800 rounded-full p-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
                    </svg>

                </div>
                <div>
                    <div class="text-lg font-bold">تعداد لابراتوار ها</div>
                    <div class="text-2xl font-bold">
                        {{ total_lab }}
                    </div>
                </div>
            </div>



            <!-- Received Documents Card -->
            <div
                class="bg-gradient-to-r from-gray-200 to-white text-black shadow-xl rounded-lg p-6 flex items-center gap-6 space-x-4 transform transition hover:scale-105">
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 w-20 h-20 bg-gray-200 text-pink-800 rounded-full p-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0 0 12 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 0 1-2.031.352 5.988 5.988 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971Zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 0 1-2.031.352 5.989 5.989 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971Z" />
                    </svg>

                </div>
                <div>
                    <div class="text-lg font-bold">تعداد تجهیزات لابراتوار </div>
                    <div class="text-2xl font-bold">
                        {{ total_equipment }}
                    </div>
                </div>
            </div>

            <!-- Received Documents Card -->
            <div
                class="bg-gradient-to-r from-gray-200 to-white text-black shadow-xl rounded-lg p-6 flex items-center gap-6 space-x-4 transform transition hover:scale-105">
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 w-20 h-20 bg-gray-200 text-blue-500 rounded-full p-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>

                </div>
                <div>
                    <div class="text-lg font-bold">تعداد برنامه ها</div>
                    <div class="text-2xl font-bold">
                        {{ total_programs }}
                    </div>
                </div>
            </div>

            <!-- total teacher in Scholarships -->
            <div
                class="bg-gradient-to-r from-gray-300 to-white text-black shadow-xl rounded-lg p-6 flex items-center space-x-6 gap-6 transform transition hover:scale-105">
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 w-20 h-20 bg-gray-200 text-blue-500 rounded-full p-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold">تعداد استادان</div>
                    <div class="text-2xl font-bold">
                        {{ total_teachers }}
                    </div>
                </div>
            </div>

            <!-- number of commit -->
            <div
                class="bg-gradient-to-r from-gray-100 to-white text-black shadow-xl rounded-lg p-6 flex items-center gap-6 space-x-4 transform transition hover:scale-105">
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-20 h-20 bg-gray-200 text-orange-500 rounded-full p-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold">تعداد استادان داکتر</div>
                    <div class="text-2xl font-bold">
                        {{ total_doctor_teacher }}
                    </div>
                </div>
            </div>

            <!-- number of data and attachment in archive -->
            <div
                class="bg-gradient-to-r from-gray-100 to-white text-black shadow-xl rounded-lg p-6 flex items-center gap-6 space-x-4 transform transition hover:scale-105">
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-20 h-20 bg-gray-200 text-blue-500 rounded-full p-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold">تعداد استادان ماستر</div>
                    <div class="text-2xl font-bold">
                        {{ total_master_teacher }}
                    </div>
                </div>
            </div>

            <!-- number of teacher they are bachelor -->

            <div
                class="bg-gradient-to-r from-gray-100 to-white text-black shadow-xl rounded-lg p-6 flex items-center gap-6 space-x-4 transform transition hover:scale-105">
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-20 h-20 bg-gray-200 text-orange-500 rounded-full p-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold">تعداد استادان لیسانس</div>
                    <div class="text-2xl font-bold">
                        {{ total_bachelor_teacher }}
                    </div>
                </div>
            </div>

            <!-- number of employee in the pdc department -->
            <div
                class="bg-gradient-to-r from-gray-100 to-white text-black shadow-lg rounded-lg p-6 flex items-center gap-6 space-x-4 transform transition hover:scale-105">
                <div class="flex-shrink-0">
                    <svg class="size-6 w-20 h-20 bg-gray-200 text-purple-500 rounded-full p-3"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold">تعداد کارمندان</div>
                    <div class="text-2xl font-bold">{{ total_employees }}</div>
                </div>
            </div>

            <!-- number of students in the post graduated department -->
            <div
                class="bg-gradient-to-r from-gray-100 to-white text-black shadow-lg rounded-lg p-6 flex items-center gap-6 space-x-4 transform transition hover:scale-105">
                <div class="flex-shrink-0">
                    <svg class="size-6 w-20 h-20 bg-gray-200 text-purple-500 rounded-full p-3"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold">تعداد محصلین</div>
                    <div class="text-2xl font-bold">{{ total_students }}</div>
                </div>
            </div>
            <!-- number of graduated students in the post graduated department -->
            <div
                class="bg-gradient-to-r from-gray-100 to-white text-black shadow-lg rounded-lg p-6 flex items-center gap-6 space-x-4 transform transition hover:scale-105">
                <div class="flex-shrink-0">
                    <svg class="size-6 w-20 h-20 bg-gray-200 text-purple-500 rounded-full p-3"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold">تعداد محصلین فارغ شده</div>
                    <div class="text-2xl font-bold">{{ total_graduated_students }}</div>
                </div>
            </div>
            <!-- number of current students in the post graduated department -->
            <div
                class="bg-gradient-to-r from-gray-100 to-white text-black shadow-lg rounded-lg p-6 flex items-center gap-6 space-x-4 transform transition hover:scale-105">
                <div class="flex-shrink-0">
                    <svg class="size-6 w-20 h-20 bg-gray-200 text-purple-500 rounded-full p-3"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                </div>
                <div>
                    <div class="text-lg font-bold">تعداد محصلین برحال</div>
                    <div class="text-2xl font-bold">{{ total_current_students }}</div>
                </div>
            </div>
            <!-- Sent Documents Card -->
            <div
                class="bg-white text-black shadow-xl rounded-lg p-6 flex items-center gap-6 space-x-4 transform transition hover:scale-105">
                <div class="flex-shrink-0">
                    <svg xmlns="http:/www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-20 h-20 bg-gray-200 text-green-500 rounded-full p-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
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
                class="bg-gradient-to-r from-gray-200 to-white text-black shadow-xl rounded-lg p-6 flex items-center gap-6 space-x-4 transform transition hover:scale-105">
                <div class="flex-shrink-0">
                    <svg xmlns="http:/www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-20 h-20 bg-gray-200 text-red-500 rounded-full p-3">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
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
        <div>
            <postGraduateChart />
        </div>
    </div>
</template>

<script setup>
import postGraduateChart from "./postGraduateChart.vue";
import { computed, onMounted, ref } from "vue";
import axiosClient from "../../axios";

let total_lab = ref();
let total_programs = ref("");
let total_equipment = ref("");
let total_students = ref("");
let total_graduated_students = ref("");
let total_current_students = ref("");
let total_teachers=ref("");
let total_doctor_teacher = ref("");
let total_bachelor_teacher = ref("");
let total_employees = ref("");
let total_send_docs = ref("");
let total_rec_docs = ref("");

const getTotalData = async () => {
    try {
        const response = await axiosClient.get(
            "/post_department/report/total"
        );
        total_lab.value = response.data.total_lab;
        total_programs.value = response.data.total_programs;
        total_equipment.value = response.data.total_equipment;
        total_students.value = response.data.total_students;
        total_graduated_students.value = response.data.total_graduated_students;
        total_current_students.value = response.data.total_current_students;
        total_teachers.value=response.data.total_teachers;
        total_doctor_teacher.value = response.data.total_doctor_teacher;
        total_bachelor_teacher.value = response.data.total_bachelor_teacher;
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
