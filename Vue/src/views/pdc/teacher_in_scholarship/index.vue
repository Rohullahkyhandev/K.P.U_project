<template>
    <div class="form--padding--top">
        <div class="flex items-center justify-between mb-4 ">
            <div class="mb-2 flex gap-4">
                <router-link :to="{ name: 'app.pdc.teacher_in_scholarship.create' }" class="header--button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    ثبت استاد شامل بورسیه
                </router-link>
            </div>
            <div class="text--header">لسیت استادان که در بورسیه هستند</div>
        </div>

        <div class="container mx-auto max-w-7xl">
            <div class="overflow-x-auto">
                <div class="min-w-full shadow rounded-lg overflow-hidden">
                    <div class="table--wrapper--dev min-w-full leading-normal">
                        <!-- display message area -->
                        <div class="bg-green-700 text-white rounded py-4 mb-2 text-center"
                            v-if="teacherInScholarshipStore.msg_success">
                            <div class="flex items-center justify-between px-10">
                                <div
                                    class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" @click="
                                            teacherInScholarshipStore.msg_success =
                                                ''
                                        " fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </div>
                                <div>
                                    <span>{{
                                        teacherInScholarshipStore.msg_success
                                        }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-red-500 text-white py-4 rounded mb-2 text-center"
                            v-if="teacherInScholarshipStore.msg_wrang">
                            <div class="flex items-center justify-between px-10">
                                <div
                                    class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" @click="
                                            teacherInScholarshipStore.msg_wrang =
                                                ''
                                        " fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </div>
                                <div>
                                    <span>{{
                                        teacherInScholarshipStore.msg_wrang
                                        }}</span>
                                </div>
                            </div>
                        </div>
                        <!-- end of display message area -->

                        <div class="flex justify-between border-b-2 pb-3">
                            <div>
                                <input v-model="search" @change="getTeacherInScholarship(null)"
                                    class="appearance-none relative block w-48 px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                    placeholder="جستجوی بر اساس تمام فیلد " />
                            </div>
                            <div class="flex items-center">
                                <span class="whitespace-nowrap mr-3">هر صفحه</span>
                                &nbsp;
                                <select @change="getTeacherInScholarship(null)" v-model="perPage" dir="ltr"
                                    class="appearance-none relative block w-24 px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm">
                                    <option value="5" selected>5</option>
                                    <option value="10" selected>10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                                &nbsp;
                                <span class="ml-3">پیداشد
                                    {{ teacherInScholarships.total }} دیتا</span>
                            </div>
                        </div>

                        <table class="table-auto w-full border">
                            <thead>
                                <tr>
                                    <TableHeaderCell field="id" :sortDirection="sortDirection" :sortField="sortField"
                                        @click="sortTeacherInScholarship('id')">
                                        شماره.
                                    </TableHeaderCell>

                                    <TableHeaderCell field="name" :sortDirection="sortDirection" :sortField="sortField"
                                        @click="
                                            sortTeacherInScholarship('name')
                                        ">
                                        نام
                                    </TableHeaderCell>

                                    <TableHeaderCell field="lname" :sortDirection="sortDirection" :sortField="sortField"
                                        @click="
                                            sortTeacherInScholarship('lname')
                                        ">
                                        تخلص
                                    </TableHeaderCell>

                                    <TableHeaderCell field="email" :sortDirection="sortDirection" :sortField="sortField"
                                        @click="
                                            sortTeacherInScholarship('email')
                                        ">
                                        ایمل
                                    </TableHeaderCell>

                                    <TableHeaderCell field="faculty_id" :sortDirection="sortDirection"
                                        :sortField="sortField" @click="
                                            sortTeacherInScholarship(
                                                'faculty_id'
                                            )
                                        ">
                                        پوهنځی
                                    </TableHeaderCell>

                                    <TableHeaderCell field="department" :sortDirection="sortDirection"
                                        :sortField="sortField" @click="
                                            sortTeacherInScholarship(
                                                'department'
                                            )
                                        ">
                                        دیپارتمنت
                                    </TableHeaderCell>

                                    <TableHeaderCell field="country_name" :sortDirection="sortDirection"
                                        :sortField="sortField" @click="
                                            sortTeacherInScholarship(
                                                'country_name'
                                            )
                                        ">
                                        نام کشور
                                    </TableHeaderCell>

                                    <TableHeaderCell field="edu_degree" :sortDirection="sortDirection"
                                        :sortField="sortField" @click="
                                            sortTeacherInScholarship(
                                                'edu_degree'
                                            )
                                        ">
                                        ریشته تحصیلی
                                    </TableHeaderCell>

                                    <TableHeaderCell field="edu_maqta" :sortDirection="sortDirection"
                                        :sortField="sortField" @click="
                                            sortTeacherInScholarship(
                                                'edu_maqta'
                                            )
                                        ">
                                        مقطع تحصیلی
                                    </TableHeaderCell>

                                    <TableHeaderCell field="sent_date" :sortDirection="sortDirection"
                                        :sortField="sortField" @click="
                                            sortTeacherInScholarship(
                                                'sent_date'
                                            )
                                        ">
                                        تاریخ اعزام
                                    </TableHeaderCell>

                                    <TableHeaderCell field="back_date" :sortDirection="sortDirection"
                                        :sortField="sortField" @click="
                                            sortTeacherInScholarship(
                                                'back_date'
                                            )
                                        ">
                                        تاریخ برگشت
                                    </TableHeaderCell>

                                    <TableHeaderCell field="document" :sortDirection="sortDirection"
                                        :sortField="sortField" @click="
                                            sortTeacherInScholarship('document')
                                        ">
                                        اسناد
                                    </TableHeaderCell>

                                    <TableHeaderCell field="id" :sortDirection="sortDirection" :sortField="sortField"
                                        @click="sortTeacherInScholarship('id')">
                                        کابر
                                    </TableHeaderCell>

                                    <TableHeaderCell field="action" :sortDirection="sortDirection"
                                        :sortField="sortField" @click="sortTeacherInScholarship('acs')">
                                        عملیات
                                    </TableHeaderCell>
                                </tr>
                            </thead>
                            <tbody v-if="
                                    teacherInScholarships.loading ||
                                    !teacherInScholarships.data.length
                                ">
                                <tr>
                                    <td colspan="12">
                                        <Spinner v-if="teacherInScholarships.loading" />
                                        <p v-else class="text-center py-8 text-gray-700">
                                            نتیجه ای پیدا نشد
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody class="border" v-else>
                                <tr v-for="(
                                        teacherInScholarship, index
                                    ) of teacherInScholarships.data" :key="index">
                                    <td class="border-b p-2">
                                        {{ index + 1 }}
                                    </td>

                                    <td class="border p-2">
                                        {{ teacherInScholarship.name }}
                                    </td>
                                    <td class="border p-2">
                                        {{ teacherInScholarship.lname }}
                                    </td>

                                    <td class="border p-2">
                                        {{ teacherInScholarship.email }}
                                    </td>

                                    <td class="border p-2">
                                        {{ teacherInScholarship.faculty }}
                                    </td>

                                    <td class="border p-2">
                                        {{ teacherInScholarship.department }}
                                    </td>

                                    <td class="border p-2">
                                        {{ teacherInScholarship.country_name }}
                                    </td>

                                    <td class="border p-2">
                                        {{ teacherInScholarship.edu_degree }}
                                    </td>

                                    <td class="border p-2">
                                        {{ teacherInScholarship.edu_maqta }}
                                    </td>

                                    <td class="border p-2">
                                        {{ teacherInScholarship.sent_date }}
                                    </td>

                                    <td class="border p-2">
                                        {{ teacherInScholarship.back_date }}
                                    </td>

                                    <td class="border p-3">
                                        <a class="bg-blue-600 w-8 py-2 flex item-center justify-center rounded-lg text-white"
                                            :href="
                                                teacherInScholarship.document_path
                                                    ? teacherInScholarship.document_path
                                                    : '#'
                                            ">
                                            <svg xmlns=" http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                            </svg>
                                        </a>
                                    </td>
                                    <td class="border p-2">
                                        {{ teacherInScholarship.uname }}
                                    </td>

                                    <td class="border p-2">
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
                                                    class="absolute z-10 left-4 mt-2 w-50 whitespace-nowrap origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                                    <div class="px-1 py-1">
                                                        <MenuItem v-slot="{ active }">
                                                        <button @click="
                                                                    openModal(
                                                                        teacherInScholarship.id
                                                                    )
                                                                " :class="[
                                                                    active
                                                                        ? 'bg-blue-800 text-white'
                                                                        : 'text-gray-900',
                                                                    'group flex w-full items-center rounded-md gap-3 px-2 py-2 text-sm',
                                                                ]">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="size-5 text-green">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                            </svg>

                                                            ویرایش معلومات
                                                            استاد
                                                        </button>
                                                        </MenuItem>
                                                    </div>

                                                    <div class="px-1 py-1">
                                                        <MenuItem v-slot="{ active }">
                                                        <router-link :to="{
                                                                    name: 'app.pdc.teacher_in_scholarship.edit',
                                                                    params: {
                                                                        id: teacherInScholarship.id,
                                                                        f_id: teacherInScholarship.faculty_id,
                                                                    },
                                                                }" :class="[
                                                                    active
                                                                        ? 'bg-blue-800 text-white'
                                                                        : 'text-gray-900',
                                                                    'group flex w-full items-center rounded-md gap-3 px-2 py-2 text-sm',
                                                                ]">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-5 h-5 text-indigo-500">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                            </svg>
                                                            ویراش
                                                        </router-link>
                                                        </MenuItem>
                                                    </div>

                                                    <div class="px-1 py-1">
                                                        <MenuItem v-slot="{ active }">
                                                        <button @click="
                                                                    deleteTeacherInScholarship(
                                                                        teacherInScholarship.id
                                                                    )
                                                                " :to="{
                                                                    name: 'app.pdc.received_document',
                                                                }" :class="[
                                                                    active
                                                                        ? 'bg-blue-800 text-white'
                                                                        : 'text-gray-900',
                                                                    'group flex w-full items-center rounded-md gap-3 px-2 py-2 text-sm',
                                                                ]">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor" class="w-5 h-5 text-red-500">
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
                        <div v-if="!teacherInScholarships.loading" class="flex justify-between items-center mt-5"
                            dir="ltr">
                            <div v-if="teacherInScholarships.data">
                                نمایش از {{ teacherInScholarships.from }} تا
                                {{ teacherInScholarships.to }}
                            </div>
                            <nav v-if="
                                    teacherInScholarships.total >
                                    teacherInScholarships.limit
                                " class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px"
                                aria-label="Pagination">
                                <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                                <a v-for="(
                                        link, i
                                    ) of teacherInScholarships.links" :key="i" :disabled="!link.url" href="#"
                                    @click="getForPage($event, link)" aria-current="page"
                                    class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap"
                                    :class="[
                                        link.active
                                            ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                                            : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                                        i === 0 ? 'rounded-l-md' : '',
                                        i ===
                                        teacherInScholarships.links.length - 1
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
                </div>
            </div>
        </div>
        <br /><br />

        <!-- update the teacher info Modal -->
        <WrapperModal :title="'فورم ویرایش معلومات استاد'" :is-open="isOpen" :close-modal="closeModal">
            <updateInfo :id="teacher_id" :close-modal="closeModal" />
        </WrapperModal>
    </div>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import Spinner from "../../../components/core/Spnnier.vue";
import { USER_PER_PAGE } from "../../../constant";
import TableHeaderCell from "../../../components/tableHeader/tableheader.vue";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import WrapperModal from "../../postgraduatedProgram/graduatedStudent/Modal.vue";
import updateInfo from "./modal.vue";
// import { PencilAltIcon, PencilIcon, TrashIcon } from '@heroicons/vue/24/outline'
import { useRoute } from "vue-router";
import useTeacherInScholarship from "../../../stores/pdc/teacher_in_scholarship/teacherInScholarshipStore";

const teacherInScholarshipStore = useTeacherInScholarship();

const route = useRoute();

const perPage = ref(USER_PER_PAGE);
const search = ref("");
const teacherInScholarships = computed(
    () => teacherInScholarshipStore.teacherInScholarships
);
const sortField = ref("updated_at");
const sortDirection = ref("desc");

onMounted(() => {
    getTeacherInScholarship();
});

function getForPage(ev, link) {
    ev.preventDefault();
    if (!link.url || link.active) {
        return;
    }
    getTeacherInScholarship(link.url);
}

function getTeacherInScholarship(url = null) {
    teacherInScholarshipStore.getTeacherInScholarship({
        url,
        search: search.value,
        per_page: perPage.value,
        sortField: sortField.value,
        sortDirection: sortDirection.value,
    });
}

function sortTeacherInScholarship(field) {
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
    getTeacherInScholarship();
}

function deleteTeacherInScholarship(id) {
    if (!confirm(`آیا شما می خواهید این دیتا را حذف نماید?`)) {
        return;
    }
    teacherInScholarshipStore.deleteTeacherInScholarship(id);
    if (teacherInScholarshipStore.msg_success != null) {
    }
    getTeacherInScholarship();
}

let isOpen = ref(false);
let teacher_id = ref("");
function openModal(id) {
    isOpen.value = true;
    if (id) {
        teacher_id.value = id;
    }
}
function closeModal() {
    isOpen.value = false;
}

function msg_success_fun() {}

function msg_warning_fun() {}
</script>

<style scoped></style>
