<template>
    <div class="container form--padding--top">
        <div class="flex max-au items-center justify-between mb-8 px-8">
            <div class="flex items-center gap-4">
                <router-link
                    :to="{ name: 'app.document.list' }"
                    class="header--button"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="size-5"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"
                        />
                    </svg>

                    لسیت کلی مکتوب ها
                </router-link>
            </div>
            <div>
                <h1 class="text--header">لیست مکتوبات تکثر شده</h1>
            </div>
        </div>

        <div class="table--wrapper--dev mx-8">
            <!-- display message area -->
            <div
                class="bg-green-700 text-white rounded py-4 text-center mb-3"
                v-if="documentStore.msg_success"
            >
                <div class="flex items-center justify-between px-10">
                    <div
                        class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            @click="documentStore.msg_success = ''"
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
                        <span>{{ documentStore.msg_success }}</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-red-500 text-white py-4 rounded text-center mb-3"
                v-if="documentStore.msg_wrang"
            >
                <div class="flex items-center justify-between px-10">
                    <div
                        class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            @click="documentStore.msg_wrang = ''"
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
                        <span>{{ documentStore.msg_wrang }}</span>
                    </div>
                </div>
            </div>
            <!-- end of display message area -->
            <div class="flex justify-between border-b-2 pb-3">
                <div>
                    <input
                        v-model="search"
                        @change="getFarwardedDocument(null)"
                        class="appearance-none relative block w-48 px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="جستجو..."
                    />
                </div>
                <div class="flex items-center">
                    <span class="whitespace-nowrap mr-3">هر صفحه</span>
                    &nbsp;
                    <select
                        dir="ltr"
                        @change="getFarwardedDocument(null)"
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
                        >پیداشد {{ documentStore.total }} دیتا</span
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
                            @click="sortFawardedDocument('id')"
                        >
                            شماره.
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="number"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortFawardedDocument('number')"
                        >
                            شماره مکتوب
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="title"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortFawardedDocument('title')"
                        >
                            عنوان مکتوب
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="date"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortFawardedDocument('date')"
                        >
                            تاریخ مکتوب
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="status"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortFawardedDocument('status')"
                        >
                            وضعیت مکتوب
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="action"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortFawardedDocument('acs')"
                        >
                            عملیات
                        </TableHeaderCell>
                    </tr>
                </thead>
                <tbody
                    v-if="
                        farwardedDocuments.loading ||
                        !farwardedDocuments.data?.length
                    "
                >
                    <tr>
                        <td colspan="10">
                            <Spinner v-if="farwardedDocuments.loading" />
                            <p v-else class="text-center py-8 text-gray-700">
                                نتیجه ای پیدا نشد
                            </p>
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr
                        v-for="(
                            farwaded_document, index
                        ) of farwardedDocuments.data"
                        :key="index"
                    >
                        <td class="border p-2">{{ index + 1 }}</td>

                        <td class="border p-2">
                            {{ farwaded_document.number }}
                        </td>
                        <td class="border p-2">
                            {{ farwaded_document.title }}
                        </td>

                        <td class="border p-2">
                            {{ farwaded_document.date }}
                        </td>

                        <td class="border p-2">
                            <span
                                v-if="farwaded_document.status == 1"
                                class="bg-red-500 text-white whitespace-nowrap rounded-md py-1 px-3"
                            >
                                ملاحظه نگردیده</span
                            >
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
                                        class="absolute z-10 left-4 mt-2 w-40 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                    >
                                        <div class="px-1 py-1">
                                            <MenuItem v-slot="{ active }">
                                                <button
                                                    @click="
                                                        openModal(
                                                            farwaded_document.id,
                                                            farwaded_document.document_id
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
                                                        stroke="currentColor"
                                                        class="size-6"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                                                        />
                                                    </svg>

                                                    ذخیره به وارده
                                                </button>
                                            </MenuItem>
                                        </div>

                                        <div class="px-1 py-1">
                                            <MenuItem v-slot="{ active }">
                                                <a
                                                    :href="
                                                        farwaded_document.attachment_path
                                                    "
                                                    :class="[
                                                        active
                                                            ? 'bg-blue-800 text-white'
                                                            : 'text-gray-900',
                                                        'group flex w-full items-center rounded-md gap-3 px-2 py-2 text-sm',
                                                    ]"
                                                >
                                                    <svg
                                                        fill="none"
                                                        viewBox="0 0 24 24"
                                                        stroke-width="1.5"
                                                        stroke="currentColor"
                                                        class="w-5 h-5"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3"
                                                        />
                                                    </svg>
                                                    دانلود مکتوب
                                                </a>
                                            </MenuItem>
                                        </div>

                                        <div class="px-1 py-1">
                                            <MenuItem v-slot="{ active }">
                                                <button
                                                    @click="
                                                        deleteFormFarwardList(
                                                            farwaded_document.id
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
                v-if="!farwardedDocuments.loading"
                class="flex justify-between items-center mt-5"
                dir="ltr"
            >
                <div v-if="farwardedDocuments.data">
                    نمایش از {{ farwardedDocuments.from }} تا
                    {{ farwardedDocuments.to }}
                </div>
                <nav
                    v-if="farwardedDocuments.total > farwardedDocuments.limit"
                    class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px"
                    aria-label="Pagination"
                >
                    <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                    <a
                        v-for="(link, i) of farwardedDocuments.links"
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
                            i === farwardedDocuments.links.length - 1
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

        <!-- Modal box -->
        <WrapperModal
            :close-modal="closeModal"
            :title="'فورم ثبت مکتوب  وارده'"
            :isOpen="isOpen"
        >
            <createModal
                :close-modal="closeModal"
                :document_id="document_id"
                :farward_id="farward_id"
            />
        </WrapperModal>
        <!-- end Modal box -->
        <br /><br />
    </div>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import Spinner from "../../components/core/Spnnier.vue";
import { USER_PER_PAGE } from "../../constant";
import TableHeaderCell from "../../components/tableHeader/tableheader.vue";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import WrapperModal from "../postgraduatedProgram/graduatedStudent/Modal.vue";
import createModal from "./Modal.vue";
import { useRoute } from "vue-router";
import useDocumentStore from "../../stores/documents/documentStore";

const documentStore = useDocumentStore();
const route = useRoute();

const perPage = ref(USER_PER_PAGE);
const search = ref("");
const farwardedDocuments = computed(() => documentStore.farwarded_document);
const sortField = ref("updated_at");
const sortDirection = ref("desc");

onMounted(() => {
    getFarwardedDocument();
    documentStore.getFarwardedDocument();
});

function getForPage(ev, link) {
    ev.preventDefault();
    if (!link.url || link.active) {
        return;
    }
    getFarwardedDocument(link.url);
}

function getFarwardedDocument(url = null) {
    documentStore.getFarwardedDocument({
        url,
        search: search.value,
        per_page: perPage.value,
        sortField: sortField.value,
        sortDirection: sortDirection.value,
    });
}

function sortFawardedDocument(field) {
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
    getFarwardedDocument();
}

function deleteFormFarwardList(id) {
    if (!confirm(`آیا شما می خواهید این مکتوب را خذف نماید?`)) {
        return;
    }
    documentStore.deleteFormFarwardList(id);
    getFarwardedDocument();
}

// Modal box
let isOpen = ref(false);
function closeModal() {
    isOpen.value = false;
}
let document_id = ref("");
let farward_id = ref("");
function openModal(f_id, d_id) {
    isOpen.value = true;
    if (f_id && d_id) {
        farward_id.value = f_id;
        document_id.value = d_id;
    }
}

function msg_success_fun() {}
function msg_warning_fun() {}
</script>

<style scoped></style>
