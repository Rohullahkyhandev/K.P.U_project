<template>
    <div class="mt-10">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-5">
                <!-- <router-link
                    :to="{ name: 'app.post-graduated.student.create' }"
                    class="header--button"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z"
                        />
                    </svg>
                    محصیل جدید
                </router-link> -->
            </div>
            <div>
                <h1 class="text--header">لیست محصلین فارغ شده</h1>
            </div>
        </div>

        <div class="table--wrapper--dev">
            <!-- display message area -->
            <div class="msg--success" v-if="graduatedStudentStore.msg_success">
                <div class="flex items-center justify-between px-10 ,mb-3">
                    <div
                        class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            @click="graduatedStudentStore.msg_success = ''"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18 18 6M6 6l12 12"
                            />
                        </svg>
                    </div>
                    <div>
                        <span>{{ graduatedStudentStore.msg_success }}</span>
                    </div>
                </div>
            </div>

            <div class="msg--warning" v-if="graduatedStudentStore.msg_wrang">
                <div class="flex items-center justify-between px-10 mb-10">
                    <div
                        class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            @click="graduatedStudentStore.msg_wrang = ''"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18 18 6M6 6l12 12"
                            />
                        </svg>
                    </div>
                    <div>
                        <span>{{ graduatedStudentStore.msg_wrang }}</span>
                    </div>
                </div>
            </div>
            <!-- end of display message area -->
            <div class="flex justify-between border-b-2 pb-3 relative">
                <div>
                    <input
                        v-model="search"
                        @change="getGraduatedStudent(null)"
                        class="appearance-none relative block w-48 px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="جستجوی بر اساس نام,تخلص"
                    />
                </div>

                <select
                    class="appearance-none relative block w-64 flex item-center justify-between text-left px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                    v-model="selectYear"
                    @change="getGraduatedStudent(null)"
                >
                    <option
                        value=""
                        selected
                        class="flex items-center font-bold justify-between float-end"
                    >
                        {{ selectedYear }}
                        ه,ش
                    </option>
                    <option v-for="year in years" :key="year" :value="year">
                        {{ year }} ه,ش
                    </option>
                </select>

                <div class="flex items-center">
                    <span class="whitespace-nowrap mr-3">هر صفحه</span>
                    &nbsp;
                    <select
                        dir="ltr"
                        @change="getGraduatedStudent(null)"
                        v-model="perPage"
                        class="appearance-none relative block w-24 px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                    >
                        <option value="5" selected>5</option>
                        <option value="10" selected>10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    &nbsp;
                    <span class="ml-3"
                        >پیداشد {{ graduatedStudents.total }} دیتا</span
                    >
                </div>
            </div>
            <table class="table-auto w-full border">
                <thead>
                    <tr>
                        <TableHeaderCell
                            field="id"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortUsers('id')"
                        >
                            شماره.
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="name"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortUsers('name')"
                        >
                            نام
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="email"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortUsers('id')"
                        >
                            تخلص
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="‌fname"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortUsers('‌fname')"
                        >
                            نام پدر
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="program_name"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortUsers('program_name')"
                        >
                            برنامه ماستری
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="thesis_mark"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortUsers('thesis_mark')"
                        >
                            نمره تیزیس
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="thesis_guide_teacher"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortUsers('thesis_guide_teacher')"
                        >
                            استاد رهنمای تیزیس
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="percentage"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortUsers('percentage')"
                        >
                            فصدی کلی
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="diplome_id"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortUsers('diplome_id')"
                        >
                            آدی دیپلوم
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="graduated_year"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortUsers('graduated_year')"
                        >
                            سال فراغت
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="action"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortUsers('acs')"
                        >
                            کابر
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="action"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortUsers('acs')"
                        >
                            عملیات
                        </TableHeaderCell>
                    </tr>
                </thead>
                <tbody
                    v-if="
                        graduatedStudents.loading ||
                        !graduatedStudents.data?.length
                    "
                >
                    <tr>
                        <td colspan="16">
                            <Spinner v-if="graduatedStudents.loading" />
                            <p v-else class="text-center py-8 text-gray-700">
                                نتیجه ای پیدا نشد
                            </p>
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr
                        v-for="(student, index) of graduatedStudents.data"
                        :key="index"
                    >
                        <td class="border-b p-2 border">{{ index + 1 }}</td>

                        <td class="border-b p-2 border">
                            {{ student.name }}
                        </td>
                        <td class="border-b p-2 border">
                            {{ student.lname }}
                        </td>

                        <td class="border-b p-2 border">
                            {{ student.fname }}
                        </td>

                        <td class="border-b p-2 border">
                            {{ student.program_name }}
                        </td>

                        <td class="border-b p-2 border">
                            {{ student.thesis_mark }}
                        </td>
                        <td class="border-b p-2 border">
                            {{ student.thesis_guide_teacher }}
                        </td>

                        <td class="border-b p-2 border">
                            {{ student.percentage }}
                        </td>

                        <td class="border-b p-2 border">
                            {{ student.diplome_id }}
                        </td>

                        <td class="border-b p-2 border">
                            {{ student.graduated_year }}
                        </td>

                        <td class="border-b p-2 border">
                            {{ student.uname }}
                        </td>

                        <td class="border-b p-2 border">
                            <Menu
                                as="div"
                                class="relative inline-block text-left"
                            >
                                <div>
                                    <MenuButton
                                        class="inline-flex items-center justify-center w-full justify-center rounded-full w-10 h-10 bg-black bg-opacity-0 text-sm font-medium text-blue-800 hover:bg-opacity-5 focus:bg-opacity-5 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                                    >
                                        <svg
                                            class="text-red"
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="20"
                                            height="20"
                                            viewBox="0 0 20 20"
                                        >
                                            <path
                                                fill="currentColor"
                                                d="M10 6a2 2 0 1 1 0-4a2 2 0 0 1 0 4Zm0 6a2 2 0 1 1 0-4a2 2 0 0 1 0 4Zm0 6a2 2 0 1 1 0-4a2 2 0 0 1 0 4Z"
                                            />
                                        </svg>
                                    </MenuButton>
                                </div>

                                <transition
                                    enter-active-class="transition duration-100 ease-out"
                                    enter-from-class="transform scale-95 opacity-0"
                                    enter-to-class="transform scale-100 opacity-100"
                                    leave-active-class="transition duration-75 ease-in"
                                    leave-from-class="transform scale-100 opacity-100"
                                    leave-to-class="transform scale-95 opacity-0"
                                >
                                    <MenuItems
                                        class="absolute z-10 left-4 mt-2 w-32 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    >
                                        <div class="px-1 py-1"></div>

                                        <div class="px-1 py-1">
                                            <MenuItem v-slot="{ active }">
                                                <button
                                                    @click="
                                                        openModal(student.id)
                                                    "
                                                    :class="[
                                                        active
                                                            ? 'bg-blue-800 text-white'
                                                            : 'text-gray-900',
                                                        'group flex w-full items-center rounded-md gap-3 px-2 py-2 text-sm',
                                                    ]"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke-width="1.5"
                                                        stroke="currentColor"
                                                        class="w-5 h-5 text-indigo-500"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
                                                        />
                                                    </svg>
                                                    ویراش
                                                </button>
                                            </MenuItem>
                                        </div>

                                        <div class="px-1 py-1">
                                            <MenuItem v-slot="{ active }">
                                                <button
                                                    @click="
                                                        deleteGraduatedStudent(
                                                            student.id
                                                        )
                                                    "
                                                    :class="[
                                                        active
                                                            ? 'bg-blue-800 text-white'
                                                            : 'text-gray-900',
                                                        'group flex w-full items-center rounded-md gap-3 px-2 py-2 text-sm',
                                                    ]"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke-width="1.5"
                                                        s
                                                        stroke="currentColor"
                                                        class="w-5 h-5 text-red-500"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                                        />
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
            <div
                v-if="!graduatedStudents.loading"
                class="flex justify-between items-center mt-5"
                dir="ltr"
            >
                <div v-if="graduatedStudents.data">
                    نمایش از {{ graduatedStudents.from }} تا
                    {{ graduatedStudents.to }}
                </div>
                <nav
                    v-if="graduatedStudents.total > graduatedStudents.limit"
                    class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px"
                    aria-label="Pagination"
                >
                    <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                    <a
                        v-for="(link, i) of graduatedStudents.links"
                        :key="i"
                        :disabled="!link.url"
                        href="#"
                        @click="getForPage($event, link)"
                        aria-current="page"
                        class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap"
                        :class="[
                            link.active
                                ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                                : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                            i === 0 ? 'rounded-l-md' : '',
                            i === graduatedStudents.links.length - 1
                                ? 'rounded-r-md'
                                : '',
                            !link.url ? ' bg-gray-100 text-gray-700' : '',
                        ]"
                        v-html="link.label"
                    >
                    </a>
                </nav>
            </div>
        </div>
        <br /><br />
        <WrapperModal
            :close-modal="closeModal"
            :is-open="isOpen"
            :title="title"
        >
            <editGraduatedStudent :student_id="student_id" />
        </WrapperModal>
    </div>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import Spinner from "../../../components/core/Spnnier.vue";
import { USER_PER_PAGE } from "../../../constant";
import TableHeaderCell from "../../../components/tableHeader/tableheader.vue";
import WrapperModal from "./Modal.vue";
import editGraduatedStudent from "./edit.vue";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
// import { PencilAltIcon, PencilIcon, TrashIcon } from '@heroicons/vue/24/outline'
import { useRoute } from "vue-router";
// import ModalBox from "./ModalBox.vue";
import useDateStore from "../../../stores/dateStore";
import useGraduatedStudent from "../../../stores/postgraduatedPrograms/graudatedStudent";

const graduatedStudentStore = useGraduatedStudent();
const route = useRoute();

// search student accroding ot the admission year
const dateStore = useDateStore();
const years = computed(() => dateStore.years);
const selectedYear = computed(() => dateStore.selectedYear);
let selectYear = ref("");

const perPage = ref(USER_PER_PAGE);
const search = ref("");
const graduatedStudents = computed(
    () => graduatedStudentStore.graduatedStudents
);
const sortField = ref("updated_at");
const sortDirection = ref("desc");
const department_id = ref("");

// modal box functions and ref
const title = ref("فورم ویرایش اطلاعات");
const isOpen = ref(false);

function closeModal() {
    isOpen.value = false;
}
let student_id = ref("");
function openModal(id) {
    isOpen.value = true;
    if (id) {
        student_id.value = id;
    }
}

onMounted(() => {
    getGraduatedStudent();
});

function getForPage(ev, link) {
    ev.preventDefault();
    if (!link.url || link.active) {
        return;
    }
    getGraduatedStudent(link.url);
}

function getGraduatedStudent(url = null) {
    graduatedStudentStore.getGraduatedStudent({
        url,
        search: search.value,
        per_page: perPage.value,
        sortField: sortField.value,
        sortDirection: sortDirection.value,
        department_id: department_id.value,
        program_id: localStorage.getItem("program_id"),
        year: selectYear.value,
    });
}

function sortUsers(field) {
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
    getGraduatedStudent();
}

function deleteGraduatedStudent(id) {
    if (!confirm(`آیا شما می خواهد این اطلاعات را حذف نماید?`)) {
        return;
    }
    graduatedStudentStore.deleteGraduatedStudent(id);
    getGraduatedStudent();
}

// modal dialog for updating the student
const props = defineProps({
    openModal: {
        type: Function,
        required: true,
    },
});



</script>

<style scoped></style>
