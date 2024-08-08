<template>
    <div class="form--padding--top">
        <div class="flex items-center justify-between mb-4">
            <div class="mb-2">
                <button @click="openModal" class="header--button">
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                        />
                    </svg>

                    ثبت لابرتوار
                </button>
            </div>

            <div class="text--header">لیست لابرتوار ها</div>
        </div>

        <div class="table--wrapper--dev">
            <!-- display message area -->
            <div
                class="bg-green-700 text-white rounded py-4 mb-2 text-center"
                v-if="labStore.msg_success"
            >
                <div class="flex items-center justify-between px-10">
                    <div
                        class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            @click="labStore.msg_success = ''"
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
                        <span>{{ labStore.msg_success }}</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-red-500 text-white py-4 rounded mb-2 text-center"
                v-if="labStore.msg_wrang"
            >
                <div class="flex items-center justify-between px-10">
                    <div
                        class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            @click="labStore.msg_wrang = ''"
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
                        <span>{{ labStore.msg_wrang }}</span>
                    </div>
                </div>
            </div>
            <!-- end of display message area -->

            <div class="flex justify-between border-b-2 pb-3">
                <div>
                    <input
                        v-model="search"
                        @change="getLab(null)"
                        class="appearance-none relative block w-48 px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="جستجوی بر اساس نام"
                    />
                </div>
                <div class="flex items-center">
                    <select
                        @change="getLab(null)"
                        v-model="program_id"
                        dir="ltr"
                        class="appearance-none relative block w-72 px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    >
                        <option
                            value=""
                            disabled
                            selected
                            class="flex items-center justify-between float-end"
                        >
                            فلتر کردن دیتا بر اساس برنامه ماستری
                        </option>
                        <option
                            v-for="(program, index) in programs"
                            :value="program.id"
                            :key="index"
                        >
                            {{ program.program_name }}
                        </option>
                    </select>
                </div>
                <div class="flex items-center">
                    <span class="whitespace-nowrap mr-3">هر صفحه</span>
                    &nbsp;
                    <select
                        @change="getLab(null)"
                        v-model="perPage"
                        dir="ltr"
                        class="appearance-none relative block w-24 px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    >
                        <option value="5" selected>5</option>
                        <option value="10" selected>10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    &nbsp;
                    <span class="ml-3">پیداشد {{ labs.total }} دیتا</span>
                </div>
            </div>

            <table class="table-auto w-full border">
                <thead>
                    <tr>
                        <TableHeaderCell
                            field="id"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortLab('id')"
                        >
                            شماره.
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="name"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortLab('name')"
                        >
                            نام لابرتوار
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="establishment_date"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortLab('establishment_date')"
                        >
                            تاریخ تاسیس
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="experiment"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortLab('experiment')"
                        >
                            آزمایشات
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="description"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortLab('description')"
                        >
                            توضیحات
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="faculty"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortLab('faculty')"
                        >
                            برنامه مربوطه
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="id"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortLab('id')"
                        >
                            کابر
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="action"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortLab('acs')"
                        >
                            عملیات
                        </TableHeaderCell>
                    </tr>
                </thead>
                <tbody v-if="labs.loading || !labs.data.length">
                    <tr>
                        <td colspan="10">
                            <Spinner v-if="labs.loading" />
                            <p v-else class="text-center py-8 text-gray-700">
                                نتیجه ای پیدا نشد
                            </p>
                        </td>
                    </tr>
                </tbody>
                <tbody class="border" v-else>
                    <tr v-for="(lab, index) of labs.data" :key="index">
                        <td class="border-b p-3">{{ index + 1 }}</td>

                        <td class="border p-">
                            {{ lab.name }}
                        </td>

                        <td class="border p-3">
                            {{ lab.establishment_date }}
                        </td>

                        <td class="border p-3">
                            {{ lab.experiment }}
                        </td>
                        <td class="border p-3">
                            {{ lab.description }}
                        </td>

                        <td class="border p-3">
                            {{ lab.program_name }}
                        </td>

                        <td class="border p-3">
                            {{ lab.uname }}
                        </td>

                        <td class="border p-2">
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
                                        <div class="px-1 py-1">
                                            <MenuItem v-slot="{ active }">
                                                <router-link
                                                    :to="{
                                                        name: 'app.post-graduated.lab.edit',
                                                        params: {
                                                            id: lab.id,
                                                        },
                                                    }"
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
                                                </router-link>
                                            </MenuItem>
                                        </div>

                                        <div class="px-1 py-1">
                                            <MenuItem v-slot="{ active }">
                                                <button
                                                    @click="deleteLab(lab.id)"
                                                    :to="{
                                                        name: 'app.pdc.received_document',
                                                    }"
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
                v-if="!labs.loading"
                class="flex justify-between items-center mt-5"
                dir="ltr"
            >
                <div v-if="labs.data">
                    نمایش از {{ labs.from }} تا {{ labs.to }}
                </div>
                <nav
                    v-if="labs.total > labs.limit"
                    class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px"
                    aria-label="Pagination"
                >
                    <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                    <a
                        v-for="(link, i) of labs.links"
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
                            i === labs.links.length - 1 ? 'rounded-r-md' : '',
                            !link.url ? ' bg-gray-100 text-gray-700' : '',
                        ]"
                        v-html="link.label"
                    >
                    </a>
                </nav>
            </div>
        </div>
        <!-- lab tools component -->
        <labToolsList />
        <br /><br />

        <!-- commit member -->
        <WrapperModal
            :is-open="isOpen"
            :close-modal="closeModal"
            :title="title"
        >
            <createLab
              :close-modal="closeModal"
            />
        </WrapperModal>
    </div>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import Spinner from "../../../components/core/Spnnier.vue";
import { USER_PER_PAGE } from "../../../constant";
import TableHeaderCell from "../../../components/tableHeader/tableheader.vue";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import WrapperModal from "../graduatedStudent/Modal.vue";
import createLab from "../labs/create.vue";

// lab tools
import labToolsList from "../lab_tools/index.vue";
import { useRoute, useRouter } from "vue-router";
import uselabStore from "../../../stores/postgraduatedPrograms/labStore";
import useProgramStore from "../../../stores/postgraduatedPrograms/programStore";

const labStore = uselabStore();
const programStore = useProgramStore();
const route = useRoute();
const router = useRouter();
const getCurrentPath = route.path;

const perPage = ref(USER_PER_PAGE);
const search = ref("");
const labs = computed(() => labStore.labs);
const sortField = ref("updated_at");
const sortDirection = ref("desc");
const program_id = ref("");

onMounted(() => {
    getLab();
    programStore.getAllPrograms();
});

const programs = computed(() => programStore.listProgram);

// modal
const title = ref("فورم ثبت اطلاعات لابرتوار");
const isOpen = ref(false);

function closeModal() {
    isOpen.value = false;
}
let commit_id = ref("");
function openModal(id) {
    isOpen.value = true;
    if (id) {
        commit_id.value = id;
    }
}

// open the edit modal box
const isOpenEdit = ref(false);
function openEditModal(id) {
    isOpen.value = true;
}

function getForPage(ev, link) {
    ev.preventDefault();
    if (!link.url || link.active) {
        return;
    }
    getLab(link.url);
}

function getLab(url = null) {
    labStore.getLab({
        url,
        search: search.value,
        per_page: perPage.value,
        sortField: sortField.value,
        sortDirection: sortDirection.value,
        program_id: program_id.value,
    });
}

function sortLab(field) {
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
    getLab();
}

function deleteLab(id) {
    if (!confirm(`Are you sure you want to delete the product?`)) {
        return;
    }
    labStore.deleteLab(id);
    if (labStore.msg_success != null) {
    }
    getLab();
}

function msg_success_fun() {}

function msg_warning_fun() {}
</script>

<style scoped></style>
