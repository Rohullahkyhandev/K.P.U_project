<template>
    <div class="form--padding--top">
        <div class="flex items-center justify-between mb-4">
            <div class="mb-2">
                <button @click="openModal" class="header--button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    ایجاد در نشرات بین المیللی
                </button>
            </div>

            <div class="text--header">لسیت نشرات</div>
        </div>

        <div class="table--wrapper--dev">
            <!-- display message area -->
            <div class="bg-green-700 text-white rounded py-4 mb-2 text-center" v-if="interpubStore.msg_success">
                <div class="flex items-center justify-between px-10">
                    <div
                        class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" @click="interpubStore.msg_success = ''" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div>
                        <span>{{ interpubStore.msg_success }}</span>
                    </div>
                </div>
            </div>

            <div class="bg-red-500 text-white py-4 rounded mb-2 text-center" v-if="interpubStore.msg_wrang">
                <div class="flex items-center justify-between px-10">
                    <div
                        class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" @click="interpubStore.msg_wrang = ''" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div>
                        <span>{{ interpubStore.msg_wrang }}</span>
                    </div>
                </div>
            </div>
            <!-- end of display message area -->

            <div class="flex justify-between border-b-2 pb-3">
                <div>
                    <input v-model="search" @change="getPublishment(null)"
                        class="appearance-none relative block w-48 px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="جستجوی بر اساس تمام فیلد ها" />
                </div>
                <div class="flex items-center">
                    <span class="whitespace-nowrap mr-3">هر صفحه</span>
                    &nbsp;
                    <select @change="getPublishment(null)" v-model="perPage" dir="ltr"
                        class="appearance-none relative block w-24 px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="5" selected>5</option>
                        <option value="10" selected>10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    &nbsp;
                    <span class="ml-3">پیداشد {{ publishments.total }} دیتا</span>
                </div>
            </div>

            <table class="table-auto w-full border">
                <thead>
                    <tr>
                        <TableHeaderCell field="id" :sortDirection="sortDirection" :sortField="sortField"
                            @click="sortPublishment('id')">
                            شماره.
                        </TableHeaderCell>

                        <TableHeaderCell field="author" :sortDirection="sortDirection" :sortField="sortField"
                            @click="sortPublishment('author')">
                            نویسنده
                        </TableHeaderCell>

                        <TableHeaderCell field="author_assesstance" :sortDirection="sortDirection"
                            :sortField="sortField" @click="sortPublishment('author_assesstance')">
                            همکار نویسنده
                        </TableHeaderCell>

                        <TableHeaderCell field="title" :sortDirection="sortDirection" :sortField="sortField"
                            @click="sortPublishment('title')">
                            عنوان
                        </TableHeaderCell>

                        <TableHeaderCell field="journal_name" :sortDirection="sortDirection" :sortField="sortField"
                            @click="sortPublishment('journal_name')">
                            نام جورنال
                        </TableHeaderCell>

                        <TableHeaderCell field="journal_link_website" :sortDirection="sortDirection"
                            :sortField="sortField" @click="sortPublishment('journal_link_website')">
                            لینک جورنال
                        </TableHeaderCell>
                        <TableHeaderCell field="attachments" :sortDirection="sortDirection" :sortField="sortField"
                            @click="sortPublishment('attachments')">
                            اسناد
                        </TableHeaderCell>

                        <TableHeaderCell field="faculty_id" :sortDirection="sortDirection" :sortField="sortField"
                            @click="sortPublishment('faculty_id')">
                            پوهنځی
                        </TableHeaderCell>

                        <TableHeaderCell field="department_id" :sortDirection="sortDirection" :sortField="sortField"
                            @click="sortPublishment('department_id')">
                            دیپارتمنت
                        </TableHeaderCell>

                        <TableHeaderCell field="id" :sortDirection="sortDirection" :sortField="sortField"
                            @click="sortPublishment('id')">
                            کابر
                        </TableHeaderCell>

                        <TableHeaderCell field="action" :sortDirection="sortDirection" :sortField="sortField"
                            @click="sortPublishment('acs')">
                            عملیات
                        </TableHeaderCell>
                    </tr>
                </thead>
                <tbody v-if="publishments.loading || !publishments.data.length">
                    <tr>
                        <td colspan="10">
                            <Spinner v-if="publishments.loading" />
                            <p v-else class="text-center py-8 text-gray-700">
                                نتیجه ای پیدا نشد
                            </p>
                        </td>
                    </tr>
                </tbody>
                <tbody class="border" v-else>
                    <tr v-for="(publishment, index) of publishments.data" :key="index">
                        <td class="border-b p-3">{{ index + 1 }}</td>

                        <td class="border p-">
                            {{ publishment.author }}
                        </td>
                        <td class="border p-3">
                            {{ publishment.author_assesstance }}
                        </td>
                        <td class="border p-3">
                            {{ publishment.title }}
                        </td>

                        <td class="border p-3">
                            {{ publishment.journal_name }}
                        </td>

                        <td class="border p-3">
                            {{ publishment.journal_link_website }}
                        </td>

                        <td class="border p-3">
                            <a :href="publishment.attachment">Download</a>
                        </td>
                        <td class="border p-3">
                            {{ publishment.faculty }}
                        </td>
                        <td class="border p-3">
                            {{ publishment.department }}
                        </td>

                        <td class="border p-3">
                            {{ publishment.uname }}
                        </td>

                        <td class="border p-2">
                            <Menu as="div" class="relative inline-block text-left">
                                <div>
                                    <MenuButton
                                        class="inline-flex items-center justify-center w-full justify-center rounded-full w-10 h-10 bg-black bg-opacity-0 text-sm font-medium text-blue-800 hover:bg-opacity-5 focus:bg-opacity-5 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
                                        <svg class="text-red" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 20 20">
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
                                        class="absolute z-10 left-4 mt-2 w-32 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                        <div class="px-1 py-1">
                                            <MenuItem v-slot="{ active }">
                                            <router-link :to="{
                                                        name: 'app.research.interpub.edit',
                                                        params: {
                                                            id: publishment.id,
                                                        },
                                                    }" :class="[
                                                        active
                                                            ? 'bg-blue-800 text-white'
                                                            : 'text-gray-900',
                                                        'group flex w-full items-center rounded-md gap-3 px-2 py-2 text-sm',
                                                    ]">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor"
                                                    class="w-5 h-5 text-indigo-500">
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
                                                        deletePublishment(
                                                            publishment.id
                                                        )
                                                    " :to="{
                                                        name: 'app.pdc.received_document',
                                                    }" :class="[
                                                        active
                                                            ? 'bg-blue-800 text-white'
                                                            : 'text-gray-900',
                                                        'group flex w-full items-center rounded-md gap-3 px-2 py-2 text-sm',
                                                    ]">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor"
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
            <div v-if="!publishments.loading" class="flex justify-between items-center mt-5" dir="ltr">
                <div v-if="publishments.data">
                    نمایش از {{ publishments.from }} تا {{ publishments.to }}
                </div>
                <nav v-if="publishments.total > publishments.limit"
                    class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px"
                    aria-label="Pagination">
                    <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                    <a v-for="(link, i) of publishments.links" :key="i" :disabled="!link.url" href="#"
                        @click="getForPage($event, link)" aria-current="page"
                        class="relative inline-flex items-center px-4 py-2 border text-sm font-medium whitespace-nowrap"
                        :class="[
                            link.active
                                ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                                : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                            i === 0 ? 'rounded-l-md' : '',
                            i === publishments.links.length - 1
                                ? 'rounded-r-md'
                                : '',
                            !link.url ? ' bg-gray-100 text-gray-700' : '',
                        ]" v-html="link.label">
                    </a>
                </nav>
            </div>
        </div>
        <br /><br />
    </div>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import Spinner from "../../../components/core/Spnnier.vue";
import { USER_PER_PAGE } from "../../../constant";
import TableHeaderCell from "../../../components/tableHeader/tableheader.vue";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
// import { PencilAltIcon, PencilIcon, TrashIcon } from '@heroicons/vue/24/outline'
import { useRoute, useRouter } from "vue-router";
import useInterpubStore from "../../../stores/researchDepartment/interpublishmentStore";

const interpubStore = useInterpubStore();
const route = useRoute();
const router = useRouter();
const getCurrentPath = route.path;

const props = defineProps({
    openModal: {
        type: Function,
        required: true,
    },
});

const perPage = ref(USER_PER_PAGE);
const search = ref("");
const publishments = computed(() => interpubStore.publishments);
const sortField = ref("updated_at");
const sortDirection = ref("desc");

onMounted(() => {
    getPublishment();
});

function getForPage(ev, link) {
    ev.preventDefault();
    if (!link.url || link.active) {
        return;
    }
    getPublishment(link.url);
}

function getPublishment(url = null) {
    interpubStore.getPublishment({
        url,
        search: search.value,
        per_page: perPage.value,
        sortField: sortField.value,
        sortDirection: sortDirection.value,
    });
}

function sortPublishment(field) {
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
    getPublishment();
}

function deletePublishment(id) {
    if (!confirm(`آیا شما مطمین هستید این دیتا را حذف می نماید?`)) {
        return;
    }
    interpubStore.deletePublishment(id);
    if (interpubStore.msg_success != null) {
    }
    getPublishment();
}

function msg_success_fun() {}

function msg_warning_fun() {}
</script>

<style scoped></style>
