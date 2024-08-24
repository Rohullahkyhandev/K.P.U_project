<template>
    <div class="form--padding--top">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center justify-center gap-6">
                <router-link :to="{ name: 'app.faculty.list' }" class="header--button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    لسیت پوهنځی ها
                </router-link>
                <router-link :to="{ name: 'app.department.create' }" class="header--button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    دیپارمنت جدید
                </router-link>
                <router-link :to="{
                    name: 'app.teacher.create',
                    params: { id: $route.params.id },
}" class="header--button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    استاد جدید
                </router-link>
            </div>
            <div>
                <h1 class="font-bold text-xl">
                    درباره پوهنځی {{ faculty.name }}
                </h1>
            </div>
        </div>
        <div class="bg-white rounded-lg mb-8 px-10 py-8 overflow-auto">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th colspan="4"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border-b p-2">
                            &nbsp;&nbsp;<b>نام پوهنځی:&nbsp;&nbsp;</b>
                            {{ faculty.name }}
                        </td>

                        <td class="border-b p-2">
                            &nbsp;&nbsp;<b>سال تأسیس:&nbsp;&nbsp;</b>
                            {{ faculty.date }}
                        </td>

                        <td class="border-b p-2 flex items-center gap-4">
                            &nbsp;&nbsp;<b>تعداد دیپارمنت:&nbsp;&nbsp;</b>
                            <span
                                class="w-10 h-10 rounded-full bg-green-700 flex items-center justify-center text-white font-bold">{{
                                    total }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="border-b p-2">
                            &nbsp;&nbsp;<b>ریس پوهنځی:&nbsp;&nbsp;</b>
                            {{ faculty.director_name }} {{ faculty.director_lname }}
                        </td>

                        <td class="border-b p-2" colspan="6">
                            <img :src="faculty.photo_path" class="object-fill w-20 h-20" width="50px" height="50px"
                                :alt="faculty.director_name">
                        </td>


                    </tr>
                    <tr>
                        <td class="border-b p-2" colspan="6">
                            <b>توضیحات در باره پوهنځی:</b>
                            &nbsp;
                            {{ faculty.description }}
                        </td>
                    </tr>
                    <tr></tr>
                </tbody>
            </table>
            <br /><br />
        </div>
        <!-- external component -->
        <FacultyDepartments />
    </div>
</template>

<script setup>
import { computed, onMounted } from "vue";
import { useRoute } from "vue-router";
import { useFacultyStore } from "../../stores/faculties/facultyStore";
import FacultyDepartments from "./table.vue";

const facultyStore = useFacultyStore();

const faculty = computed(() => facultyStore.faculty);
const total = computed(() => facultyStore.faculty_department.total);

const route = useRoute();

onMounted(() => {
    facultyStore.getFaculty(route.params.id);
});
</script>
