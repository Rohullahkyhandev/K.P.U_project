<template>
    <div class="mt-10">
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-5">
                <router-link
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
                </router-link>

                <!-- <router-link
                    :to="{ name: 'app.teacher.create' }"
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
                    راپور
                </router-link> -->

                <!-- <div class="inset-0 flex items-center justify-center">
                    <router-link
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
                    </router-link>
                </div> -->
                <!-- <TransitionRoot appear :show="isOpen" as="template">
                    <Dialog as="div" @close="closeModal" class="relative z-10">
                        <TransitionChild
                            as="template"
                            enter="duration-300 ease-out"
                            enter-from="opacity-0"
                            enter-to="opacity-100"
                            leave="duration-200 ease-in"
                            leave-from="opacity-100"
                            leave-to="opacity-0"
                        >
                            <div class="fixed inset-0 bg-black/25" />
                        </TransitionChild>

                        <div class="fixed inset-0 overflow-y-auto">
                            <div
                                class="flex min-h-full items-center justify-center p-4 text-center"
                            >
                                <TransitionChild
                                    as="template"
                                    enter="duration-300 ease-out"
                                    enter-from="opacity-0 scale-95"
                                    enter-to="opacity-100 scale-100"
                                    leave="duration-200 ease-in"
                                    leave-from="opacity-100 scale-100"
                                    leave-to="opacity-0 scale-95"
                                >
                                    <DialogPanel
                                        class="w-full max-w-md transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                                    >
                                        <DialogTitle
                                            as="h2"
                                            class="text-lg font-medium leading-6 text-gray-900"
                                        >
                                            لطفا فلید های مورد نیاز انتخاب نماید
                                        </DialogTitle>
                                        <div
                                            class="mt-2 flex items-center justify-content-end flex-col"
                                        >
                                            <div
                                                class="flex gap-4"
                                                v-for="(
                                                    attribute, index
                                                ) in attributes"
                                                :key="index"
                                            >
                                                <div
                                                    class="flex gap-5 items-center justify-end text-left"
                                                >
                                                    <Switch
                                                        v-model="
                                                            attribute.isActive
                                                        "
                                                        :class="
                                                            attribute.isActive
                                                                ? 'bg-blue-800'
                                                                : 'bg-blue-600'
                                                        "
                                                        class="relative inline-flex h-[20px] w-[60px] shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-white/75"
                                                    >
                                                        <span class="sr-only"
                                                            >Use setting</span
                                                        >
                                                        <span
                                                            aria-hidden="true"
                                                            :class="
                                                                attribute.isActive
                                                                    ? 'translate-x-9'
                                                                    : 'translate-x-0'
                                                            "
                                                            class="pointer-events-none inline-block h-[18px] w-[25px] transform rounded-full bg-white shadow-lg ring-0 transition duration-200 ease-in-out"
                                                        />
                                                    </Switch>
                                                    <label class="form--label">
                                                        {{ attribute.text }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <button
                                                type="button"
                                                class="header--button"
                                                @click="closeModal"
                                            >
                                                DownLoad
                                            </button>
                                        </div>
                                    </DialogPanel>
                                </TransitionChild>
                            </div>
                        </div>
                    </Dialog>
                </TransitionRoot> -->
            </div>
            <div>
                <h1 class="text--header">لیست محصلین</h1>
            </div>
        </div>

        <div class="table--wrapper--dev">
            <!-- display message area -->
            <div class="msg--success" v-if="studentStore.msg_success">
                <div class="flex items-center justify-between px-10 ,mb-3">
                    <div
                        class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            @click="studentStore.msg_success = ''"
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
                        <span>{{ studentStore.msg_success }}</span>
                    </div>
                </div>
            </div>

            <div class="msg--warning" v-if="studentStore.msg_wrang">
                <div class="flex items-center justify-between px-10 mb-10">
                    <div
                        class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            @click="studentStore.msg_wrang = ''"
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
                        <span>{{ studentStore.msg_wrang }}</span>
                    </div>
                </div>
            </div>
            <!-- end of display message area -->
            <div class="flex justify-between border-b-2 pb-3 relative">
                <div>
                    <input
                        v-model="search"
                        @change="getStudent(null)"
                        class="appearance-none relative block w-48 px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="جستجوی بر اساس نام,تخلص"
                    />
                </div>

                <select
                    class="appearance-none relative block w-64 flex item-center justify-between text-left px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                    v-model="selectYear"
                    @change="getStudent(null)"
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
                        @change="getStudent(null)"
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
                    <span class="ml-3">پیداشد {{ students.total }} دیتا</span>
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
                            field="phone"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortUsers('phone')"
                        >
                            شماره تماس
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="phone"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortUsers('phone')"
                        >
                            ایمل آدرس
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="kankor_id"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortUsers('kankor_id')"
                        >
                            آدی کانکور
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="نمره کانکور"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortUsers('نمره کانکور')"
                        >
                            نمره کانکور
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="bachelor_field"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortUsers('bachelor_field')"
                        >
                            رشته دوره لیسانس
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="nic"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortUsers('nic')"
                        >
                            نمبر تذکره
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="address"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortUsers('address')"
                        >
                            آدرس
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="admission_year"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortUsers('admission_year')"
                        >
                            تاریخ ثبت نام
                        </TableHeaderCell>

                        <TableHeaderCell
                            field="blood_group"
                            :sortDirection="sortDirection"
                            :sortField="sortField"
                            @click="sortUsers('blood_group')"
                        >
                            گروپ خونی
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
                <tbody v-if="students.loading || !students.data?.length">
                    <tr>
                        <td colspan="16">
                            <Spinner v-if="students.loading" />
                            <p v-else class="text-center py-8 text-gray-700">
                                نتیجه ای پیدا نشد
                            </p>
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr v-for="(student, index) of students.data" :key="index">
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
                            {{ student.phone }}
                        </td>
                        <td class="border-b p-2 border">
                            {{ student.email }}
                        </td>

                        <td class="border-b p-2 border">
                            {{ student.kankor_id }}
                        </td>

                        <td class="border-b p-2 border">
                            {{ student.kankor_mark }}
                        </td>

                        <td class="border-b p-2 border">
                            {{ student.bachelor_field }}
                        </td>

                        <td class="border-b p-2 border">
                            {{ student.nic }}
                        </td>
                        <td class="border-b p-2 border">
                            {{ student.address }}
                        </td>

                        <td class="border-b p-2 border">
                            {{ student.admission_year }}
                        </td>

                        <td class="border-b p-2 border">
                            {{ student.blood_group }}
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
                                                    ویرایش دیتا
                                                </button>
                                            </MenuItem>
                                        </div>

                                        <div class="px-1 py-1">
                                            <MenuItem v-slot="{ active }">
                                                <router-link
                                                    :to="{
                                                        name: 'app.post-graduated.student.edit',
                                                        params: {
                                                            id: student.id,
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
                                                    @click="
                                                        deleteStudent(
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
                v-if="!students.loading"
                class="flex justify-between items-center mt-5"
                dir="ltr"
            >
                <div v-if="students.data">
                    نمایش از {{ students.from }} تا {{ students.to }}
                </div>
                <nav
                    v-if="students.total > students.limit"
                    class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px"
                    aria-label="Pagination"
                >
                    <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                    <a
                        v-for="(link, i) of students.links"
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
                            i === students.links.length - 1
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

        <createGraduatedStudent
            :is-open="isOpen"
            :close-modal="closeModal"
            :title="title"
        >
            <!-- update form component -->
            <updateStudentInfo :student_id="student_id" />
        </createGraduatedStudent>

        <!-- Modal Box -->
        <!-- <ModalBox
            :is-pro-open="isProOpen"
            :close-pro-modal="closeProModal"
            :openProModal="openProModal"
            :teacher_id="teacher_id"
        /> -->
        <!-- end of Modal box -->
    </div>
</template>

<script setup>
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
    Switch,
} from "@headlessui/vue";
import { computed, onMounted, ref } from "vue";
import Spinner from "../../../components/core/Spnnier.vue";
import { USER_PER_PAGE } from "../../../constant";
import TableHeaderCell from "../../../components/tableHeader/tableheader.vue";
import createGraduatedStudent from "../graduatedStudent/Modal.vue";
import updateStudentInfo from "../graduatedStudent/create.vue";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
// import { PencilAltIcon, PencilIcon, TrashIcon } from '@heroicons/vue/24/outline'
import { useRoute } from "vue-router";
// import ModalBox from "./ModalBox.vue";
import useStudentStore from "../../../stores/postgraduatedPrograms/studentStore";
import useDateStore from "../../../stores/dateStore";

const studentStore = useStudentStore();
const route = useRoute();

// search student accroding ot the admission year
const dateStore = useDateStore();
const years = computed(() => dateStore.years);
const selectedYear = computed(() => dateStore.selectedYear);
let selectYear = ref("");

const perPage = ref(USER_PER_PAGE);
const search = ref("");
const students = computed(() => studentStore.studnets);
const sortField = ref("updated_at");
const sortDirection = ref("desc");
const department_id = ref("");

// let msg_success = ref(computed(() => store.state.msg_success));
// let msg_warning = ref("");
// let user_image_src = '';

const title = ref("فورم ویرایش اطلاعات محصیلن تازه فارغ");
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
    getStudent();
});

// const departments = computed(() =>
//     studentStore.listDepartment.map((c) => ({ key: c.id, text: c.name }))
// );

function getForPage(ev, link) {
    ev.preventDefault();
    if (!link.url || link.active) {
        return;
    }
    getStudent(link.url);
}

const program_id = ref("");

function getStudent(url = null) {
    studentStore.getStudent({
        url,
        search: search.value,
        per_page: perPage.value,
        sort_field: sortField.value,
        sort_direction: sortDirection.value,
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
    getStudent();
}

function deleteStudent(id) {
    if (!confirm(`آیا شما می خواهد این اطلاعات را حذف نماید?`)) {
        return;
    }
    studentStore.deleteStudent(id);
    getStudent();
}

const enabled = ref(false);

const attributes = ref([
    {
        key: "codebast",
        text: "کود بست",
        isActive: true,
    },

    {
        key: "name",
        text: "نام",
        isActive: true,
    },

    {
        key: "lname",
        text: "تخلص ",
        isActive: true,
    },

    {
        key: "fname",
        text: "نام پدر",
        isActive: true,
    },

    {
        key: "faculty_id",
        text: "فاکولته",
        isActive: true,
    },
    {
        key: "department_id",
        text: "دیمارتمنت",
        isActive: true,
    },

    {
        key: "email",
        text: "علمی استاد",
        isActive: true,
    },

    {
        key: "adamic_rank",
        text: "رتبه عملی ",
        isActive: true,
    },
    {
        key: "phone",
        text: "شماره تماس",
        isActive: true,
    },
    {
        key: "join_date",
        text: "تاریخ تقرر",
        isActive: true,
    },
    {
        key: "nic",
        text: "نمبر تٰٰذکره",
        isActive: true,
    },
]);

function msg_success_fun() {}
function msg_warning_fun() {}

function selectToggle() {
    attributes.value.map((item) => {
        item.isActive = !item.isActive;
    });
}
</script>

<style scoped></style>
