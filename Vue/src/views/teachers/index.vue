<template>
    <main>
        <!-- personal  information  -->
        <div class="container mt-10">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-5" v-if="administrator || create_teacher_department">
                    <router-link :to="{ name: 'app.teacher.create' }" class="header--button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>
                        استاد جدید
                    </router-link>

                    <div class="inset-0 flex items-center justify-center">
                        <!-- <router-link
                        :to="{ name: 'teacher.report' }"
                        class="header--button"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                            />
                        </svg>

                        تهیه راپور
                    </router-link> -->
                    </div>
                </div>
                <div>
                    <h1 class="text--header">لیست استادان (شهرت و معلومات کادری)</h1>
                </div>
            </div>
            <div class="table--wrapper--dev min-w-full leading-normal">
                <!-- display message area -->
                <div class="msg--success" v-if="teacherStore.msg_success">
                    <div class="flex items-center justify-between px-10 mb-3">
                        <div
                            class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" @click="teacherStore.msg_success = ''" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div>
                            <span>{{ teacherStore.msg_success }}</span>
                        </div>
                    </div>
                </div>

                <div class="msg--warning" v-if="teacherStore.msg_wrang">
                    <div class="flex items-center justify-between px-10 mb-10">
                        <div
                            class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" @click="teacherStore.msg_wrang = ''" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div>
                            <span>{{ teacherStore.msg_wrang }}</span>
                        </div>
                    </div>
                </div>
                <!-- end of display message area -->
                <div class="flex justify-between border-b-2 pb-3 relative">
                    <div>
                        <input v-model="search" @change="getTeacher(null)"
                            class="appearance-none relative block w-48 px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            placeholder="جستجوی بر اساس تمام کالم ها" />
                    </div>

                    <div v-if="
                        authStore.user.data.part_name ==
                        'آمریت برنامه های فوق لیسانس'
">
                        <Select v-model="program" @change="getTeacher(null)" :options="programs" optionLabel="name"
                            placeholder="فلیتر کردن استادان براساس برنامه" class="w-full md:w-80 py-1 rounded-lg" />
                    </div>

                    <div v-else>
                        <Select v-model="department" @change="getTeacher(null)" :options="departments"
                            optionLabel="name" filter placeholder="فلیتر کردن استادان براساس دیپارمنت"
                            class="w-full md:w-80 py-1 rounded-lg" />
                    </div>

                    <div class="flex items-center">
                        <span class="whitespace-nowrap mr-3">هر صفحه</span>
                        &nbsp;
                        <select dir="ltr" @change="getTeacher(null)" v-model="perPage"
                            class="appearance-none relative block w-24 px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                            <option value="5" selected>5</option>
                            <option value="10" selected>10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        &nbsp;
                        <span class="ml-3">پیداشد {{ teachers.total }} دیتا</span>
                    </div>
                </div>
                <table class="w-full table-auto border">
                    <thead>
                        <tr>
                            <th colspan="5" class="border  border-blue-300 px-2 py-3 text-center bg-gray-200 font-bold">
                                شهرت
                            </th>
                            <th colspan="10"
                                class="border  border-blue-300 px-2 py-3 text-center bg-gray-200 font-bold">
                                معلومات کادری
                            </th>
                        </tr>
                        <tr>
                            <TableHeaderCell field="id" :sortDirection="sortDirection" :sortField="sortField"
                                @click="sortTeacher('id')">
                                شماره.
                            </TableHeaderCell>
                            <TableHeaderCell field="code_bast" :sortDirection="sortDirection" :sortField="sortField"
                                @click="sortTeacher('code_bast')">
                                کود بست
                            </TableHeaderCell>
                            <TableHeaderCell field="name" :sortDirection="sortDirection" :sortField="sortField"
                                @click="sortTeacher('name')">
                                نام
                            </TableHeaderCell>

                            <TableHeaderCell field="lname" :sortDirection="sortDirection" :sortField="sortField"
                                @click="sortTeacher('lname')">
                                تخلص
                            </TableHeaderCell>

                            <TableHeaderCell field="fatherName" :sortDirection="sortDirection" :sortField="sortField"
                                @click="sortTeacher('fatherName')">
                                نام پدر
                            </TableHeaderCell>

                            <!-- info -->
                            <TableHeaderCell field="birth_date" :sortDirection="sortDirection" :sortField="sortField"
                                @click="sortTeacher('birth_date')">
                                رتبه علمی
                            </TableHeaderCell>

                            <TableHeaderCell field="" :sortDirection="sortDirection" :sortField="sortField"
                                @click="sortTeacher('')">
                                درجه تحصلی
                            </TableHeaderCell>

                            <TableHeaderCell field="birth_date" :sortDirection="sortDirection" :sortField="sortField"
                                @click="sortTeacher('birth_date')">
                                تاریخ تولد
                            </TableHeaderCell>

                            <TableHeaderCell field="hire_date" :sortDirection="sortDirection" :sortField="sortField"
                                @click="sortTeacher('hire_date')">
                                تاریخ تقرر در کادر علمی
                            </TableHeaderCell>

                            <TableHeaderCell field="faculty_id" :sortDirection="sortDirection" :sortField="sortField">
                                تاریخ آخرین ترفیع
                            </TableHeaderCell>

                            <TableHeaderCell field="faculty_id" :sortDirection="sortDirection" :sortField="sortField"
                                @click="sortTeacher('faculty_id')">
                                پوهنځی
                            </TableHeaderCell>

                            <TableHeaderCell field="department_id" :sortDirection="sortDirection" :sortField="sortField"
                                @click="sortTeacher('department_id')">
                                دیپارتمنت
                            </TableHeaderCell>

                            <TableHeaderCell field="gender" :sortDirection="sortDirection" :sortField="sortField"
                                @click="sortTeacher('gender')">
                                جنسیت
                            </TableHeaderCell>

                            <TableHeaderCell field="user_id" :sortDirection="sortDirection" :sortField="sortField"
                                @click="sortTeacher('user_id')">
                                کاربر
                            </TableHeaderCell>

                            <TableHeaderCell field="id" :sortDirection="sortDirection" :sortField="sortField"
                                @click="sortTeacher('id')">
                                عملیات
                            </TableHeaderCell>

                            <!-- long term scholarships -->

                        </tr>



                        <tr>


                            <!-- <TableHeaderCell field="code_bast" :sortDirection="sortDirection"
                                            :sortField="sortField" @click="sortTeacher('code_bast')">
                                            کود بست
                                        </TableHeaderCell>


                                        <TableHeaderCell field="education_field" :sortDirection="sortDirection"
                                            :sortField="sortField" @click="sortTeacher('education_field')">
                                            ریشته تحصیلی
                                        </TableHeaderCell> -->








                            <!-- <TableHeaderCell field="program_id" :sortDirection="sortDirection"
                                            :sortField="sortField" @click="sortTeacher('program_id')">
                                            آشنایی با لسان های خارجی
                                        </TableHeaderCell> -->



                            <!-- <TableHeaderCell field="status" :sortDirection="sortDirection"
                                            :sortField="sortField" @click="sortTeacher('status')">
                                            بورس طول المدت
                                        </TableHeaderCell> -->

                            <!-- <TableHeaderCell field="action" :sortDirection="sortDirection"
                                            :sortField="sortField" @click="sortTeacher('acs')">
                                            کابر
                                        </TableHeaderCell> -->

                            <!-- <TableHeaderCell field="action" :sortDirection="sortDirection"
                                            :sortField="sortField" @click="sortTeacher('acs')">
                                            عملیات
                                        </TableHeaderCell> -->
                        </tr>
                    </thead>
                    <tbody v-if="
                        teachers.loading || !teachers.data?.length
">
                        <tr>
                            <td colspan="15">
                                <Spinner v-if="teachers.loading" />
                                <p v-else class="text-center py-8 text-gray-700">
                                    نتیجه ای پیدا نشد
                                </p>
                            </td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr v-for="(teacher, index) of teachers.data" :key="index">
                            <td class="border-b p-2 border">
                                {{ index + 1 }}
                            </td>

                            <td class="border-b p-2 border">
                                {{ teacher.code_bast }}

                            </td>

                            <td class="border-b p-2 border">
                                {{ teacher.name }}
                            </td>
                            <td class="border-b p-2 border">
                                {{ teacher.lname }}
                            </td>

                            <td class="border-b p-2 border">
                                {{ teacher.fname }}
                            </td>

                            <td class="border-b p-2 border">
                                {{ teacher.academic_rank }}
                            </td>

                            <td class="border-b p-2 border">
                                {{ teacher.education }}
                            </td>

                            <td class="border-b p-2 border">
                                {{ teacher.birth_date }}
                            </td>

                            <td class="border-b p-2 border">
                                {{ teacher.hire_date }}
                            </td>

                            <td class="border-b p-2 border">
                                <span v-if="teacher.date"> {{ teacher.date }}</span>
                                <span v-else>ترفیع نکرده</span>
                            </td>


                            <td class="border-b p-2 border">
                                {{ teacher.faculty }}
                            </td>

                            <td class="border-b p-2 border">
                                {{ teacher.department }}
                            </td>

                            <td class="border-b p-2 border">
                                <span v-if="teacher.gender == 'مرد'">ذکور</span>
                                <span v-if="teacher.gender == 'زن'">اناث</span>
                            </td>

                            <td class="border-b p-2 border">
                                {{ teacher.uname }}
                            </td>

                            <td class="border-b p-2 border">
                                <Menu as="div" class="relative inline-block text-left">
                                    <div>
                                        <MenuButton
                                            class="inline-flex items-center justify-center w-full justify-center rounded-full w-10 h-10 bg-black bg-opacity-0 text-sm font-medium text-blue-800 hover:bg-opacity-5 focus:bg-opacity-5 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
                                            <svg class="text-red" xmlns="http://www.w3.org/2000/svg" width="20"
                                                height="20" viewBox="0 0 20 20">
                                                <path fill="currentColor"
                                                    d="M10 6a2 2 0 1 1 0-4a2 2 0 0 1 0 4Zm0 6a2 2 0 1 1 0-4a2 2 0 0 1 0 4Zm0 6a2 2 0 1 1 0-4a2 2 0 0 1 0 4Z" />
                                            </svg>
                                        </MenuButton>
                                    </div>

                                    <transition enter-active-class="transition duration-100 ease-out"
                                        enter-from-class="transform scale-95 opacity-0"
                                        enter-to-class="transform scale-100 opacity-100"
                                        leave-active-class="transition duration-75 ease-in"
                                        leave-from-class="transform scale-100 opacity-100"
                                        leave-to-class="transform scale-95 opacity-0">
                                        <MenuItems
                                            class="absolute z-10 left-4 mt-2 w-40 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                            <div class="px-1 py-1"></div>

                                            <div class="px-1 py-1">
                                                <MenuItem v-slot="{ active }"
                                                    v-if="administrator || view_teacher_department">
                                                <router-link :to="{
                                                    name: 'app.teacher.details',
                                                    params: {
                                                        id: teacher.id,
                                                    },
                                                }" :class="[
                                                    active
                                                        ? 'bg-blue-800 text-white'
                                                        : 'text-gray-900',
                                                    'group flex w-full items-center rounded-md gap-3 px-2 py-2 text-lg',
                                                ]">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5 text-blue-500">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                    </svg>
                                                    جزئيات
                                                </router-link>
                                                </MenuItem>
                                            </div>

                                            <div class="px-1 py-1" v-if="administrator || create_teacher_department">
                                                <MenuItem v-slot="{ active }">
                                                <button @click="
                                                    openProModal(
                                                        teacher.id
                                                    )
                                                    " :class="[
                                                        active
                                                            ? 'bg-blue-800 text-white'
                                                            : 'text-gray-900',
                                                        'group flex w-full items-center rounded-md gap-3 px-2 py-2 text-lg',
                                                    ]">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-5 text-blue-600">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0 0 20.25 18V6A2.25 2.25 0 0 0 18 3.75H6A2.25 2.25 0 0 0 3.75 6v12A2.25 2.25 0 0 0 6 20.25Z" />
                                                    </svg>

                                                    ثبت ترفیع
                                                </button>
                                                </MenuItem>
                                            </div>

                                            <div class="px-1 py-1" v-if="administrator || view_teacher_department">
                                                <MenuItem v-slot="{ active }">
                                                <button @click="
                                                    openModal(
                                                        teacher.id
                                                    )
                                                    " :class="[
                                                        active
                                                            ? 'bg-blue-800 text-white'
                                                            : 'text-gray-900',
                                                        'group flex w-full items-center rounded-md gap-3 px-2 py-2 text-lg',
                                                    ]">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-5 text-green-600">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                    </svg>

                                                    لسیت ترفیع
                                                </button>
                                                </MenuItem>
                                            </div>

                                            <div class="px-1 py-1">
                                                <MenuItem v-slot="{ active }"
                                                    v-if="administrator || edit_teacher_department">
                                                <router-link :to="{
                                                    name: 'app.teacher.edit',
                                                    params: {
                                                        id: teacher.id,
                                                    },
                                                }" :class="[
                                                    active
                                                        ? 'bg-blue-800 text-white'
                                                        : 'text-gray-900',
                                                    'group flex w-full items-center rounded-md gap-3 px-2 py-2 text-lg',
                                                ]">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5 text-indigo-500">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                    </svg>
                                                    ویراش
                                                </router-link>
                                                </MenuItem>
                                            </div>

                                            <div class="px-1 py-1">
                                                <MenuItem v-slot="{ active }"
                                                    v-if="administrator || delete_teacher_department">
                                                <button @click="
                                                    deleteTeacher(
                                                        teacher.id
                                                    )
                                                    " :class="[
                                                        active
                                                            ? 'bg-blue-800 text-white'
                                                            : 'text-gray-900',
                                                        'group flex w-full items-center rounded-md gap-3 px-2 py-2 text-lg',
                                                    ]">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" s stroke="currentColor"
                                                        class="w-5 h-5 text-red-500">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>

                                                    حذف
                                                </button>
                                                </MenuItem>
                                            </div>
                                        </MenuItems>
                                    </transition>
                                </Menu>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-if="!teachers.loading" class="flex justify-between items-center mt-5" dir="ltr">
                    <div v-if="teachers.data">
                        نمایش از {{ teachers.from }} تا
                        {{ teachers.to }}
                    </div>
                    <nav v-if="teachers.total > teachers.limit"
                        class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px"
                        aria-label="Pagination">
                        <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                        <a v-for="(link, i) of teachers.links" :key="i" :disabled="!link.url" href="#"
                            @click="getForPage($event, link)" aria-current="page"
                            class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap"
                            :class="[
                                link.active
                                    ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                                    : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                                i === 0 ? 'rounded-l-md' : '',
                                i === teachers.links.length - 1
                                    ? 'rounded-r-md'
                                    : '',
                                !link.url
                                    ? ' bg-gray-100 text-gray-700'
                                    : '',
                            ]" v-html="link.label">
                        </a>
                    </nav>
                </div>
            </div>
            <br /><br />

            <!-- Modal Box -->
            <ModalBox :is-pro-open="isProOpen" :close-pro-modal="closeProModal" :openProModal="openProModal"
                :teacher_id="teacher_id" />
            <!-- end of Modal box -->

            <!-- list of Promotions  -->
            <WrapperModal :title="'لسیت  ترفیعات '" :close-modal="closeModal" :is-open="isOpen">
                <PromotionList :id="teacher_id" :close-modal="closeModal" />
            </WrapperModal>
        </div>
    </main>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import Spinner from "../../components/core/Spnnier.vue";
import { USER_PER_PAGE } from "../../constant";
import TableHeaderCell from "../../components/tableHeader/tableheader.vue";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import Select from "primevue/select";
// import { PencilAltIcon, PencilIcon, TrashIcon } from '@heroicons/vue/24/outline'
import { useRoute } from "vue-router";
import { useTeacherStore } from "../../stores/teachers/teacherStore";
import ModalBox from "./ModalBox.vue";
import WrapperModal from "../postgraduatedProgram/graduatedStudent/Modal.vue";
import PromotionList from "./promotionList.vue";
import useDepartmentStore from "../../stores/department/deparmentStore";
import { useAuthStore } from "../../stores/auth";
import useProgramStore from "../../stores/postgraduatedPrograms/programStore";
import { useUserStore } from "../../stores/user/userStore";

const teacherStore = useTeacherStore();
const departmentStore = useDepartmentStore();
const authStore = useAuthStore();
const programStore = useProgramStore();
const userStore = useUserStore();
const route = useRoute();

const perPage = ref(USER_PER_PAGE);
const search = ref("");
const teachers = computed(() => teacherStore.Teachers);
const sortField = ref("updated_at");
const sortDirection = ref("desc");
const department = ref("");
const program = ref("");

const isOpen = ref(false);
const teacher_id = ref("");
const isProOpen = ref(false);
function closeModal() {
    isOpen.value = false;
}
function openModal(id) {
    isOpen.value = true;
    if (teacher_id) {
        teacher_id.value = id;
    }
}

function closeProModal() {
    isProOpen.value = false;
}
function openProModal(id) {
    if (id) {
        teacher_id.value = id;
        isProOpen.value = true;
    }
}

onMounted(() => {
    getTeacher();
    teacherStore.getAllDepartments();
    departmentStore.getAllDepartment();
    programStore.getAllPrograms();
    authStore.getUser();
});

// permissions
const create_teacher_department = computed(() => userStore.permission_current.create_teacher_department)
const view_teacher_department = computed(() => userStore.permission_current.view_teacher_department)
const delete_teacher_department = computed(() => userStore.permission_current.delete_teacher_department)
const edit_teacher_department = computed(() => userStore.permission_current.edit_teacher_department)
const administrator = computed(() => userStore.permission_current.administrator)

const departments = computed(() =>
    departmentStore.all_department.map((c) => ({ id: c.id, name: c.name }))
);
const programs = computed(() =>
    programStore.listProgram.map((c) => ({ id: c.id, name: c.program_name }))
);

function getForPage(ev, link) {
    ev.preventDefault();
    if (!link.url || link.active) {
        return;
    }
    getTeacher(link.url);
}

function getTeacher(url = null) {
    teacherStore.getTeachers({
        url,
        search: search.value,
        per_page: perPage.value,
        sortField: sortField.value,
        sortDirection: sortDirection.value,
        department_id: department.value.id,
        program_id: program.value.id,
    });
}

function sortTeacher(field) {
    if (field === sortField.value) {
        if (sortDirection.value === "desc") {
            sortDirection.value = "asc";
        } else {
            sortDirection.value = "desc";
        }
    } else {
        sortField.value = field;
        sortDirection.value = "asc";
    }
    getTeacher();
}

function deleteTeacher(id) {
    if (!confirm(`آیا شما می خواهد این اطلاعات را حذف نماید?`)) {
        return;
    }
    teacherStore.deleteTeacher(id);
    getTeacher();
}

// education degres
const education_degrees = ref([
    {
        key: "لیسانس",
        text: "لیسانس",
    },
    {
        key: "ماستر",
        text: "ماستر",
    },
    {
        key: "داکتر",
        text: "داکتر",
    },
]);

const enabled = ref(false);
function msg_success_fun() { }
function msg_warning_fun() { }
</script>

<style scoped>
td {
    white-space: nowrap !important;
}
</style>
