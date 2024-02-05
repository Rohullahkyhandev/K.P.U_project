<template>
    <div class="mt-10">
        <div class="flex items-center justify-between mb-3">
            <div class="mb-3">
                <router-link :to="{ name: 'app.teacher.list' }"
                    class="bg-blue-700 focus:ring flex items-center justify-center gap-3  focus:ring-indigo-600 outline-none mb-6 rounded-lg shadow text-white py-2 px-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>

                    لسیت استادان
                </router-link>
            </div>
            <div>
                <h1 class="text-xl font-bold mb-3">پروفایل &nbsp;&nbsp; {{ teacher.name }} {{ teacher.lname }}</h1>
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
                                    <td>
                                        <a :href="teacher.photo_path">
                                            <img :src="teacher.photo_path" class="w-40 h-40 rounded-full"
                                                :alt="teacher.name">
                                        </a>
                                    </td>
                                </tr>
                            </div>
                            <div>
                                <tr>
                                    <td class="border-b p-4 font-semibold">نام و تخلص:&nbsp;</td>
                                    <td class="border-b p-4 text-left">{{ teacher.name }} {{ teacher.lname }}</td>
                                    <td class="border-b p-4 font-semibold">نام پدر:&nbsp;</td>
                                    <td class="border-b p-4 text-left">{{ teacher.fatherName }}</td>
                                    <td class="border-b p-4 font-semibold">ایمل آدرس:&nbsp;</td>
                                    <td class="border-b p-4 text-left">{{ teacher.email }}</td>
                                </tr>

                                <tr>
                                    <td class="border-b p-4 font-semibold">تاریخ تولد:&nbsp;</td>
                                    <td class="border-b p-4 text-left">{{ teacher.birth_date }}</td>
                                    <td class="border-b p-4 font-semibold">تاریخ استخدام:&nbsp;</td>
                                    <td class="border-b p-4 text-left">{{ teacher.hire_date }}</td>
                                    <td class="border-b p-4 font-semibold">نمبر تذکره:&nbsp;</td>
                                    <td class="border-b p-4 text-left">{{ teacher.nic }}</td>
                                </tr>

                                <tr>
                                    <td class="border-b p-4 font-semibold">سکونت اصلی:&nbsp;</td>
                                    <td class="border-b p-4 text-left">{{ teacher.main_address }}</td>
                                    <td class="border-b p-4 font-semibold">سکونت فرعی:&nbsp;</td>
                                    <td class="border-b p-4 text-left">{{ teacher.current_address }}</td>
                                    <td class="border-b p-4 font-semibold">رتبه علمی:&nbsp;</td>
                                    <td class="border-b p-4 text-left">{{ teacher.academic_rank }}</td>
                                </tr>

                            </div>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-10 mb-4">
            <h1 class="text-2xl font-bold">سطح تحصیلی</h1>
        </div>
        <!-- display message area -->
        <div class="bg-green-700 text-white rounded py-4 text-center" v-if="teacherStore.msg_qsuccess">
            <div class="flex items-center justify-between px-10">
                <div
                    class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" @click="teacherStore.msg_qsuccess = ''" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </div>
                <div>
                    <span>{{ teacherStore.msg_qsuccess }}</span>
                </div>
            </div>
        </div>

        <div class="bg-red-500 text-white py-4 rounded text-center" v-if="teacherStore.msg_qwrang">
            <div class="flex items-center justify-between px-10">
                <div
                    class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" @click="teacherStore.msg_qwrang = ''" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </div>
                <div>
                    <span>{{ teacherStore.msg_qwrang }}</span>
                </div>
            </div>
        </div>
        <!-- end of display message area -->
        <div class="flex  flex-col items-center justify-center gap-2 mt-4 mb-10">
            <div class="py-8 px-8 bg-white rounded shadow w-full">
                <table class="table-auto w-full">
                    <thead>
                        <tr>
                            <th colspan="4"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <div class="flex flex-col items-center justify-between">
                            <div class="w-full ">
                                <tr>
                                    <td>

                                        <Menu as="div" class="relative inline-block text-left">
                                            <div>
                                                <MenuButton
                                                    class="inline-flex items-center justify-center w-full justify-center rounded-full w-10 h-10 bg-black bg-opacity-0 text-sm font-medium text-red-800 hover:bg-opacity-5 focus:bg-opacity-5 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
                                                    <svg class="text-red" xmlns="http://www.w3.org/2000/svg" width="30"
                                                        height="30" viewBox="0 0 20 20">
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
                                                    class="absolute z-10 left-4 mt-2 w-32 origin-top-right  divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                                    <div class="px-1 py-1">

                                                    </div>

                                                    <div class="px-1 py-1">
                                                        <MenuItem v-slot="{ active }">
                                                        <router-link
                                                            :to="{ name: 'app.qualification.create', params: { id: teacher.id } }"
                                                            :class="[
                                                                active ? 'bg-blue-800 text-white' : 'text-gray-900',
                                                                'group flex w-full items-center rounded-md gap-3 px-2 py-2 text-sm',
                                                            ]">

                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                class="w-6 h-6 text-blue-500">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                                                            </svg>
                                                            ثبت سطح
                                                        </router-link>
                                                        </MenuItem>
                                                    </div>

                                                    <div class="px-1 py-1">
                                                        <MenuItem v-slot="{ active }">
                                                        <router-link
                                                            :to="{ name: 'app.teacher.edit_document', params: { id: teacher_qualification.id } }"
                                                            :class="[
                                                                active ? 'bg-blue-800 text-white' : 'text-gray-900',
                                                                'group flex w-full items-center rounded-md gap-3 px-2 py-2 text-sm',
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
                                                        <MenuItem v-slot="{ active }">
                                                        <button @click="deleteQualification(teacher_qualification.id)"
                                                            :class="[
                                                                active ? 'bg-blue-800 text-white' : 'text-gray-900',
                                                                'group flex w-full items-center rounded-md gap-3 px-2 py-2 text-sm',
                                                            ]">

                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
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
                            </div>
                            <div>
                    <tbody v-if="teacherStore.loading == false">
                        <tr>
                            <td class="border-b p-4 font-semibold">درجه تحصیل:&nbsp;</td>
                            <td class="border-b p-4 text-left">{{ teacher_qualification.education_degree }}</td>
                            <td class="border-b p-4 font-semibold">دانشگاه:&nbsp;</td>
                            <td class="border-b p-4 text-left">{{ teacher_qualification.university }}</td>
                            <td class="border-b p-4 font-semibold">کشور:&nbsp;</td>
                            <td class="border-b p-4 text-left">{{ teacher_qualification.country }}</td>
                        </tr>

                        <tr>
                            <td class="border-b p-4 font-semibold">سال فراغت:&nbsp;</td>
                            <td class="border-b p-4 text-left">{{ teacher_qualification.graduated_year }}</td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <td class="py-8" colspan="4">
                                <Sppinner />
                            </td>
                        </tr>
                    </tbody>
            </div>
        </div>
        </tbody>
        </table>
    </div>
    </div>


    <div class="mt-10 mb-4">
        <h1 class="text-2xl font-bold">اسناد تحصیلی </h1>
    </div>
    <!-- display message area -->
    <div class="bg-green-700 text-white rounded py-4 text-center" v-if="teacherStore.msg_dsuccess">
        <div class="flex items-center justify-between px-10">
            <div class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" @click="teacherStore.msg_dsuccess = ''" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </div>
            <div>
                <span>{{ teacherStore.msg_dsuccess }}</span>
            </div>
        </div>
    </div>

    <div class="bg-red-500 text-white py-4 rounded text-center" v-if="teacherStore.msg_dwrang">
        <div class="flex items-center justify-between px-10">
            <div class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" @click="teacherStore.msg_dwrang = ''" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </div>
            <div>
                <span>{{ teacherStore.msg_dwrang }}</span>
            </div>
        </div>
    </div>
    <!-- end of display message area -->
    <div class="flex  flex-col items-center justify-center gap-2 mt-4 mb-10">
        <div class="py-8 px-8 bg-white rounded shadow w-full">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th colspan="4"></th>
                    </tr>
                </thead>
                <tbody>
                    <div class="flex flex-col items-center justify-between">
                        <div class="w-full">
                            <tr>
                                <td>

                                    <Menu as="div" class="relative inline-block text-left">
                                        <div>
                                            <MenuButton
                                                class="inline-flex items-center justify-center w-full justify-center rounded-full w-10 h-10 bg-black bg-opacity-0 text-sm font-medium text-red-800 hover:bg-opacity-5 focus:bg-opacity-5 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
                                                <svg class="text-red" xmlns="http://www.w3.org/2000/svg" width="30"
                                                    height="30" viewBox="0 0 20 20">
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
                                                class="absolute z-10 left-4 mt-2 w-32 origin-top-right  divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                                <div class="px-1 py-1">

                                                </div>

                                                <div class="px-1 py-1">
                                                    <MenuItem v-slot="{ active }">
                                                    <router-link
                                                        :to="{ name: 'app.document.create', params: { id: teacher.id } }"
                                                        :class="[
                                                            active ? 'bg-blue-800 text-white' : 'text-gray-900',
                                                            'group flex w-full items-center rounded-md gap-3 px-2 py-2 text-sm',
                                                        ]">

                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-5 h-5 tex-blue-900">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                        </svg>
                                                        ثبت سند
                                                    </router-link>
                                                    </MenuItem>
                                                </div>

                                                <div class="px-1 py-1">
                                                    <MenuItem v-slot="{ active }">
                                                    <router-link
                                                        :to="{ name: 'app.document.edit', params: { id: teacher.id } }"
                                                        :class="[
                                                            active ? 'bg-blue-800 text-white' : 'text-gray-900',
                                                            'group flex w-full items-center rounded-md gap-3 px-2 py-2 text-sm',
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
                                                    <MenuItem v-slot="{ active }">
                                                    <button @click="deleteDocument(teacher_document.id)" :class="[
                                                        active ? 'bg-blue-800 text-white' : 'text-gray-900',
                                                        'group flex w-full items-center rounded-md gap-3 px-2 py-2 text-sm',
                                                    ]">

                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
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
                        </div>
                        <div>

                <tbody v-if="teacherStore.loading == false">
                    <tr>
                        <td class="border-b p-4 font-semibold">نوع سند:&nbsp;</td>
                        <td class="border-b p-4 ">{{ teacher_document.type }}</td>
                        <td class="border-b p-4 font-semibold">لینک دانلود فایل:&nbsp;</td>
                        <td class="border-b p-4 text-left">
                            <a :href="teacher_document.attachment_path" @click="download()"
                                class="bg-blue-500 text-white flex items-center justify-center rounded-lg py-2 px-3 shadow">
                                <span v-if="loading == true">
                                    <svg class="animate-spin -ml-1 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                </span>
                                <span v-else>دانلود فایل</span>

                            </a>
                        </td>

                    </tr>

                    <tr>
                        <td class="border-b p-4 font-semibold">توضیحات:&nbsp;</td>
                        <td class="border-b p-4 text-right" colspan="4">{{ teacher_document.description }}</td>

                    </tr>

                </tbody>
                <tbody v-else>
                    <tr>
                        <td class="py-8 " colspan="4">
                            <Sppinner />
                        </td>
                    </tr>
                </tbody>
        </div>
    </div>
    </tbody>
    </table>
    </div>
    </div>


    <div class="mt-10 mb-4">
        <h1 class="text-2xl font-bold">آثار و مقلات علمی</h1>
    </div>
    <div class="flex  flex-col items-center justify-center gap-2 mt-4 mb-10">
        <div class="py-8 px-8 bg-white rounded shadow w-full">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th colspan="4"></th>
                    </tr>
                </thead>
                <tbody>
                    <div class="flex flex-col items-center justify-between">
                        <div class="w-full">
                            <tr>
                                <td>
                                    <!-- <router-link :to="{ name: 'app.document.create', params: { id: $route.params.id } }"
                                            class="bg-blue-700 flex items-center justify-center gap-3 focus:ring focus:ring-indigo-600 outline-none mb-6 rounded-lg shadow text-white py-2 px-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                                            </svg>
                                            ثبت اسناد
                                        </router-link> -->
                                    <Menu as="div" class="relative inline-block text-left">
                                        <div>
                                            <MenuButton
                                                class="inline-flex items-center justify-center w-full justify-center rounded-full w-10 h-10 bg-black bg-opacity-0 text-sm font-medium text-red-800 hover:bg-opacity-5 focus:bg-opacity-5 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75">
                                                <svg class="text-red" xmlns="http://www.w3.org/2000/svg" width="30"
                                                    height="30" viewBox="0 0 20 20">
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
                                                class="absolute z-10 left-4 mt-2 w-32 origin-top-right  divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                                <div class="px-1 py-1">

                                                </div>

                                                <div class="px-1 py-1">
                                                    <MenuItem v-slot="{ active }">
                                                    <router-link
                                                        :to="{ name: 'app.literature.create', params: { id: teacher.id } }"
                                                        :class="[
                                                            active ? 'bg-blue-800 text-white' : 'text-gray-900',
                                                            'group flex w-full items-center rounded-md gap-3 px-2 py-2 text-sm',
                                                        ]">

                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-5 h-5 tex-blue-900">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                        </svg>
                                                        ثبت سند
                                                    </router-link>
                                                    </MenuItem>
                                                </div>

                                                <div class="px-1 py-1">
                                                    <MenuItem v-slot="{ active }">
                                                    <router-link
                                                        :to="{ name: 'app.teacher.edit', params: { id: teacher.id } }"
                                                        :class="[
                                                            active ? 'bg-blue-800 text-white' : 'text-gray-900',
                                                            'group flex w-full items-center rounded-md gap-3 px-2 py-2 text-sm',
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
                                                    <MenuItem v-slot="{ active }">
                                                    <button @click="deleteDocument(teacher.id)" :class="[
                                                        active ? 'bg-blue-800 text-white' : 'text-gray-900',
                                                        'group flex w-full items-center rounded-md gap-3 px-2 py-2 text-sm',
                                                    ]">

                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
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
                        </div>
                        <div>
                            <tr>
                                <td class="border-b p-4 font-semibold">عنوان مقاله:&nbsp;</td>
                                <td class="border-b p-4 ">{{ teacher_article.title }}</td>
                                <td class="border-b p-4 ">{{ teacher_article.title }}</td>
                                <td class="border-b p-4 font-semibold">تاریخ نشر:&nbsp;</td>
                                <td class="border-b p-4 ">{{ teacher_article.date }}</td>
                                <td class="border-b p-4 font-semibold">لینک جورنال:&nbsp;</td>
                                <td class="border-b p-4 text-left">
                                    <a :href="teacher_article.publisher"
                                        class="bg-blue-500 text-white  rounded-lg py-2 px-5 shadow"> لینک</a>
                                </td>

                            </tr>

                            <tr>
                                <td class="border-b p-4 font-semibold">توضیحات:&nbsp;</td>
                                <td class="border-b p-4 text-right" colspan="4">{{ teacher_document.description }}</td>

                            </tr>


                        </div>
                    </div>
                </tbody>
            </table>
        </div>
    </div>



    </div>
</template>
<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import Sppinner from '../../components/core/spnnier.vue'
import { computed, onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import { useTeacherStore } from "../../stores/teachers/teacherStore";



const teacherStore = useTeacherStore();
const route = useRoute();

const teacher = computed(() => teacherStore.teacher);
const teacher_qualification = computed(() => teacherStore.teacher_qualification);
const teacher_document = computed(() => teacherStore.teacher_document);
const teacher_article = computed(() => teacherStore.teacher_articles);

onMounted(() => {
    teacherStore.getTeacherDetails(route.params.id)
    teacherStore.getQualification(route.params.id);
    teacherStore.getDocument(route.params.id);
    teacherStore.getArticle(route.params.id);
})

function deleteDocument(id) {
    if (id != '') {
        if (!window.confirm('آیا می خواهید این ایتم را حذف نماید؟')) {
            return
        }
        teacherStore.deleteDocument(id);
        teacherStore.getDocument(route.params.id);
    }
}

function deleteQualification(id) {
    if (id != '') {
        if (!window.confirm('آیا می خواهید این ایتم را حذف نماید؟')) {
            return
        }
        teacherStore.deleteQualification(id);
        teacherStore.getQualification(route.params.id);
    }

}



let loading = ref(false)
function download() {
    loading.value = true
}

</script>
