<template>
    <div class="mt-10 px-8">
        <div class="flex items-center justify-between mb-3">
            <div class="mb-3">
                <router-link :to="{ name: 'app.teacher.list' }"
                    class="bg-blue-700 focus:ring flex items-center justify-center gap-3 focus:ring-indigo-600 outline-none mb-6 rounded-lg shadow text-white py-2 px-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>

                    لسیت استادان
                </router-link>
            </div>
            <div>
                <h1 class="text-xl font-bold mb-3">
                    پروفایل &nbsp;&nbsp; {{ teacher.name }} {{ teacher.lname }}
                </h1>
            </div>
        </div>
        <div class="flex items-center justify-center gap-2">
            <div class="py-8 px-8 bg-white rounded shadow w-full">
                <table class="table-auto w-full p-5">
                    <thead>
                        <tr>
                            <th colspan="4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <div class="flex items-center justify-between">
                            <div>
                                <tr>
                                    <td class="p-3">
                                        <a :href="teacher.photo_path">
                                            <img :src="teacher.photo_path" class="w-40 h-40 rounded-full"
                                                :alt="teacher.name" />
                                        </a>
                                    </td>
                                </tr>
                            </div>
                            <div>
                                <tr>
                                    <td class="border-b p-2 font-semibold">
                                        نام و تخلص:&nbsp;
                                        {{ teacher.name }} {{ teacher.lname }}
                                    </td>

                                    <td class="border-b p-2 font-semibold">
                                        نام پدر:&nbsp; {{ teacher.fatherName }}
                                    </td>
                                    <td class="border-b p-2 font-semibold">
                                        نام پدرکلان:&nbsp;
                                        {{ teacher.grandFathername }}
                                    </td>

                                    <td class="border-b p-2 font-semibold">
                                        ایمل آدرس:&nbsp; {{ teacher.email }}
                                    </td>
                                </tr>

                                <tr>

                                    <td class="border-b p-2 font-semibold">
                                        شماره تماس:&nbsp; {{ teacher.phone }}
                                    </td>
                                    <td class="border-b p-2 font-semibold">
                                        تاریخ تولد:&nbsp;
                                        {{ teacher.birth_date }}
                                    </td>

                                    <td class="border-b p-2 font-semibold">
                                        تاریخ استخدام:&nbsp;
                                        {{ teacher.hire_date }}
                                    </td>

                                    <td class="border-b p-2 font-semibold">
                                        نمبر تذکره:&nbsp; {{ teacher.nic }}
                                    </td>
                                </tr>

                                <tr>
                                    <td class="border-b p-2 font-semibold">
                                        جنسیت:&nbsp;
                                        {{ teacher.gender }}
                                    </td>
                                    <td class="border-b p-2 font-semibold">
                                        سکونت اصلی:&nbsp;
                                        {{ teacher.main_address }}
                                    </td>

                                    <td class="border-b p-2 font-semibold">
                                        سکونت فعلی:&nbsp;{{
                                            teacher.current_address
                                        }}
                                    </td>

                                    <td class="border-b p-2 font-semibold">
                                        رتبه علمی:&nbsp;
                                        {{ teacher.academic_rank }}
                                    </td>
                                </tr>
                            </div>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- teacher Qualification -->
        <IndexQualification v-if="administrator == true || view_post_graduated == true || view_teacher == true" />

        <!-- teacher education degree -->
        <IndexDocument v-if="
            view_teacher == true ||
            view_post_graduated == true ||
            administrator == true
        " />

        <!-- teacher Articles -->
        <IndexArticle v-if="administrator == true || view_post_graduated == true" />
        <!-- teacher Literature -->
        <IndexLiterature v-if="administrator == true || view_post_graduated == true" />
    </div>
</template>
<script setup>
import IndexQualification from "./qualificationIndex.vue";
import IndexLiterature from "./leteratureIndex.vue";
import IndexDocument from "./documentIndex.vue";
import IndexArticle from "./articleIndex.vue";

import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import Sppinner from "../../components/core/Spnnier.vue";
import { computed, onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import { useTeacherStore } from "../../stores/teachers/teacherStore";
import { useUserStore } from "../../stores/user/userStore";

const teacherStore = useTeacherStore();
const userStore = useUserStore();
const route = useRoute();

onMounted(() => {
    teacherStore.getTeacherDetails(route.params.id);
    userStore.getPermissions();
});

const administrator = computed(
    () => userStore.permission_current.administrator
);
const view_teacher = computed(
    () => userStore.permission_current.view_teacher_department
);

const view_post_graduated = computed(
    () => userStore.permission_current.view_post_graduated
);

const teacher = computed(() => teacherStore.teacher);
</script>
