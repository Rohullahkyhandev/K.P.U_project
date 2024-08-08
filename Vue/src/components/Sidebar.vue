<template>
    <aside class="bg-blue-900 shadow w-64 hidden sm:block">
        <div
            class="flex items-center bg-blue-800 justify-center py-2 border-gray-500 border-b"
        >
            <img src="../../public/logo.jpg" class="w-16" alt="" />
        </div>
        <nav class="mt-3 flex items-start justify-start flex-col">
            <!-- <p class="font-bold font-italic text-gray-400 mr-10 justify-start mt-2 w-full">پنل مدیریت</p> -->
            <ul class="mt-2 w-64">
                <li
                    class="transition-colors cursor-pointer w-full px-4 py-2 text-white"
                >
                    <router-link
                        :to="{ name: 'app.dashboard' }"
                        class="sidebar-item flex items-center justify-start gap-3"
                    >
                        <svg
                            class="fill-stroke h-5 w-5"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M9 4H5C4.44772 4 4 4.44772 4 5V9C4 9.55228 4.44772 10 5 10H9C9.55228 10 10 9.55228 10 9V5C10 4.44772 9.55228 4 9 4Z"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M19 4H15C14.4477 4 14 4.44772 14 5V9C14 9.55228 14.4477 10 15 10H19C19.5523 10 20 9.55228 20 9V5C20 4.44772 19.5523 4 19 4Z"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M9 14H5C4.44772 14 4 14.4477 4 15V19C4 19.5523 4.44772 20 5 20H9C9.55228 20 10 19.5523 10 19V15C10 14.4477 9.55228 14 9 14Z"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M19 14H15C14.4477 14 14 14.4477 14 15V19C14 19.5523 14.4477 20 15 20H19C19.5523 20 20 19.5523 20 19V15C20 14.4477 19.5523 14 19 14Z"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                        <span>داشبورد</span>
                    </router-link>
                </li>

                <li
                    v-if="view_document || administrator"
                    class="text-white transition-colors py-2 px-4"
                >
                    <router-link
                        :to="{ name: 'app.document.list' }"
                        class="sidebar-item flex items-center justify-start gap-3"
                    >
                        <svg
                            xmlns="http:/www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-5 h-5"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                            />
                        </svg>
                        <span>مکتوب ها</span>
                    </router-link>
                </li>

                <li
                    v-if="view_pdc || administrator"
                    class="transition-colors cursor-pointer w-full px-4 py-2 text-white"
                >
                    <button
                        class="sidebar-item flex items-center transition-all duration-100 justify-start gap-3"
                        @click="togglePdc"
                    >
                        <svg
                            id="icon1"
                            :class="[
                                pdcToggle == true
                                    ? 'rotate-180 transform w-5 h-5 transition'
                                    : 'transform w-5 h-5',
                            ]"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M18 15L12 9L6 15"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                        <span>آمریت P.D.C</span>
                    </button>

                    <ul class="mr-3 transition-all" v-if="pdcToggle">
                        <li class="transition-colors px-2 py-1 rounded">
                            <router-link
                                :to="{ name: 'app.pdc.plan.list' }"
                                class="sidebar-item flex items-center justify-start gap-3"
                            >
                                <svg
                                    xmlns="http:/www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="w-5 h-5"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                                    />
                                </svg>
                                <span>پلان ها</span>
                            </router-link>
                        </li>
                        <li class="transition-colors px-2 py-1 rounded">
                            <router-link
                                :to="{ name: 'app.pdc.commit.list' }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"
                                    />
                                </svg>
                                <span>کمیته ها</span>
                            </router-link>
                        </li>

                        <li class="transition-colors px-2 py-1 rounded">
                            <router-link
                                :to="{ name: 'app.pdc.workshop.list' }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6"
                                    />
                                </svg>
                                <span>ورکشاپ ها</span>
                            </router-link>
                        </li>

                        <li class="transition-colors px-2 py-1 rounded">
                            <router-link
                                :to="{
                                    name: 'app.pdc.teacher_in_scholarship.create',
                                }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"
                                    />
                                </svg>

                                <span>بورسیه ها</span>
                            </router-link>
                        </li>
                    </ul>
                </li>

                <li
                    v-if="administrator || view_teacher_department"
                    class="transition-colors cursor-pointer w-full px-3 py-2 text-white"
                >
                    <a
                        to="#"
                        class="sidebar-item flex items-center transition-all duration-100 justify-start gap-3"
                        @click="toggleTeacher"
                    >
                        <svg
                            id="icon1"
                            :class="[
                                teacherToggle == true
                                    ? 'rotate-180 transform w-6 h-6 transition'
                                    : 'transform w-5 h-5',
                            ]"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M18 15L12 9L6 15"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                        <span>آمریت استادان</span>
                    </a>
                    <ul class="mr-3 transition-all" v-if="teacherToggle">
                        <li class="transition-colors py-2 px-4 rounded">
                            <router-link
                                :to="{ name: 'app.teacher.list' }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"
                                    />
                                </svg>
                                <span>استادان</span>
                            </router-link>
                        </li>
                        <li class="transition-colors py-2 px-4 rounded">
                            <router-link
                                :to="{ name: 'app.faculty.list' }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z"
                                    />
                                </svg>
                                <span>فاکولته ها</span>
                            </router-link>
                        </li>

                        <li class="transition-colors py-2 px-4 rounded">
                            <router-link
                                :to="{ name: 'app.department.list' }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z"
                                    />
                                </svg>

                                <span>دیپارتمنت ها</span>
                            </router-link>
                        </li>
                    </ul>
                </li>

                <li
                    v-if="
                        administrator == true || view_quality_assurance == true
                    "
                    class="transition-colors cursor-pointer w-full px-3 py-2 text-white"
                >
                    <button
                        class="sidebar-item flex items-center justify-start gap-3"
                        @click="toggleQuality"
                    >
                        <svg
                            id="icon3"
                            :class="[
                                qualityToggle == true
                                    ? 'rotate-180 transform w-5 h-5 transition'
                                    : 'transform w-5 h-5',
                            ]"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M18 15L12 9L6 15"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                        <span>آمریت تضمین کیفیت</span>
                    </button>
                    <ul class="mr-3 transition-all" v-if="qualityToggle">
                        <li class="transition-colors px-2 py-1rounded">
                            <router-link
                                :to="{ name: 'app.criteria.create' }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                    />
                                </svg>

                                <span>معیارات اصلی</span>
                            </router-link>
                        </li>

                        <li class="transition-colors px-2 py-1rounded">
                            <router-link
                                :to="{ name: 'app.quality.list' }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                                    />
                                </svg>

                                <span>اداری</span>
                            </router-link>
                        </li>
                    </ul>
                </li>

                <li
                    v-if="administrator == true || view_post_graduated == true"
                    class="transition-colors cursor-pointer w-full px-3 py-2 text-white"
                >
                    <button
                        class="sidebar-item flex items-center justify-start gap-3"
                        @click="togglePost"
                    >
                        <svg
                            id="icon4"
                            :class="[
                                postToggle == true
                                    ? 'rotate-180 transform w-6 h-6 transition'
                                    : 'transform w-6 h-6',
                            ]"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M18 15L12 9L6 15"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                        <span>آمریت فوق لیسانس </span>
                    </button>
                    <ul class="mr-3 transition-all" v-if="postToggle">
                        <li class="transition-colors px-2 py-1 rounded">
                            <router-link
                                :to="{ name: 'app.post.list' }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 12.872M12.75 3.031a9 9 0 0 1 6.69 14.036m0 0-.177-.529A2.25 2.25 0 0 0 17.128 15H16.5l-.324-.324a1.453 1.453 0 0 0-2.328.377l-.036.073a1.586 1.586 0 0 1-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 0 1-5.276 3.67m0 0a9 9 0 0 1-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25"
                                    />
                                </svg>

                                <span>برنامه ها </span>
                            </router-link>
                        </li>

                        <li class="transition-colors px-2 py-1 rounded">
                            <router-link
                                :to="{ name: 'app.teacher.list' }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"
                                    />
                                </svg>
                                <span>استادان</span>
                            </router-link>
                        </li>

                        <li class="transition-colors px-2 py-1 rounded">
                            <router-link
                                :to="{
                                    name: 'app.post-graduated.student.create',
                                }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"
                                    />
                                </svg>

                                <span>محصلین</span>
                            </router-link>
                        </li>

                        <li class="transition-colors px-2 py-1 rounded">
                            <router-link
                                :to="{
                                    name: 'app.post-graduated.commit.list',
                                }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"
                                    />
                                </svg>

                                <span>کمیته ها</span>
                            </router-link>
                        </li>

                        <li class="transition-colors px-2 py-1 rounded">
                            <router-link
                                :to="{
                                    name: 'app.post-graduated.board.list',
                                }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"
                                    />
                                </svg>

                                <span> بورد</span>
                            </router-link>
                        </li>

                        <li class="transition-colors px-2 py-1 rounded">
                            <router-link
                                :to="{ name: 'app.post-graduated.lab.list' }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"
                                    />
                                </svg>

                                <span>لابرتورا ها</span>
                            </router-link>
                        </li>

                        <li class="transition-colors px-2 py-1 rounded">
                            <router-link
                                :to="{
                                    name: 'app.post-graduated.class_room.list',
                                }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819"
                                    />
                                </svg>

                                <span>صنف ها</span>
                            </router-link>
                        </li>
                    </ul>
                </li>

                <li
                    v-if="
                        administrator == true ||
                        view_research_department == true
                    "
                    class="transition-colors cursor-pointer w-full px-3 py-2 text-white"
                >
                    <button
                        :to="{ name: 'app.dashboard' }"
                        class="sidebar-item flex items-center justify-start gap-3"
                        @click="toggleResearch"
                    >
                        <svg
                            id="icon5"
                            :class="[
                                researchToggle == true
                                    ? 'rotate-180 transform w-5 h-5 transition'
                                    : 'transform w-5 h-5',
                            ]"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M18 15L12 9L6 15"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                        <span>آمریت تحقیقات علمی</span>
                    </button>
                    <ul class="mr-3 transition-all" v-if="researchToggle">
                        <li class="transition-colors px-2 py-1 rounded">
                            <router-link
                                :to="{ name: 'app.research.tresearch.list' }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"
                                    />
                                </svg>
                                <span>تحقیقات استادان</span>
                            </router-link>
                        </li>

                        <li class="transition-colors px-2 py-1 rounded">
                            <router-link
                                :to="{ name: 'app.research.interpub.list' }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418"
                                    />
                                </svg>

                                <span>نشرات بین المیللی</span>
                            </router-link>
                        </li>

                        <li class="transition-colors px-2 py-1 rounded">
                            <router-link
                                :to="{ name: 'app.research.curriculum.list' }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"
                                    />
                                </svg>

                                <span> کریکولم </span>
                            </router-link>
                        </li>

                        <li class="transition-colors px-2 py-1 rounded">
                            <router-link
                                :to="{ name: 'app.research.lab.list' }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"
                                    />
                                </svg>

                                <span>لابرتورا ها</span>
                            </router-link>
                        </li>
                    </ul>
                </li>

                <li
                    v-if="
                        view_pdc ||
                        view_teacher_department ||
                        view_research_department ||
                        view_post_graduated ||
                        administrator
                    "
                    class="mr-3 transition-colors cursor-pointer w-full px-1 py-1 text-white"
                >
                    <button
                        :to="{ name: 'app.dashboard' }"
                        class="sidebar-item flex items-center justify-start gap-3"
                        @click="toggleReport"
                    >
                        <svg
                            id="icon5"
                            :class="[
                                reportToggle == true
                                    ? 'rotate-180 transform w-5 h-5 transition'
                                    : 'transform w-5 h-5',
                            ]"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M18 15L12 9L6 15"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                        <span> راپور </span>
                    </button>
                    <ul class="mr-1 transition-all" v-if="reportToggle">
                        <li
                            v-if="view_pdc || administrator"
                            class="transition-colors py-1 px-3 whitespace-nowrap rounded"
                        >
                            <router-link
                                :to="{
                                    name: 'app.pdc.report.teacher_in_commit',
                                }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                                    />
                                </svg>

                                <span> راپور اعضای کمیته ها</span>
                            </router-link>
                        </li>

                        <li
                            v-if="view_pdc || administrator"
                            class="transition-colors py-1 px-3 whitespace-nowrap rounded"
                        >
                            <router-link
                                :to="{
                                    name: 'app.pdc.report.teacher_in_scholarship',
                                }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                                    />
                                </svg>

                                <span> راپور بورسیه ها</span>
                            </router-link>
                        </li>

                        <li
                            v-if="view_post_graduated || administrator"
                            class="transition-colors py-1 px-3 whitespace-nowrap rounded"
                        >
                            <router-link
                                :to="{
                                    name: 'app.student.report',
                                }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                                    />
                                </svg>

                                <span> راپور محصیلن </span>
                            </router-link>
                        </li>

                        <li
                            v-if="view_post_graduated || administrator"
                            class="transition-colors py-1 px-3 whitespace-nowrap rounded"
                        >
                            <router-link
                                :to="{
                                    name: 'app.board.report',
                                }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                                    />
                                </svg>

                                <span> راپور اعضای بورد </span>
                            </router-link>
                        </li>

                        <li
                            v-if="view_post_graduated || administrator"
                            class="transition-colors py-1 px-3 whitespace-nowrap rounded"
                        >
                            <router-link
                                :to="{
                                    name: 'app.post.commit_member.report',
                                }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                                    />
                                </svg>

                                <span> راپور اعضای کمیته </span>
                            </router-link>
                        </li>

                        <li
                            v-if="view_research_department || administrator"
                            class="transition-colors py-1 px-3 whitespace-nowrap rounded"
                        >
                            <router-link
                                :to="{
                                    name: 'app.teacher_research.report',
                                }"
                                class="sidebar-item flex items-center justify-start gap-3"
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
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                                    />
                                </svg>

                                <span> راپور تحقیقات استادان </span>
                            </router-link>
                        </li>
                    </ul>
                </li>

                <li
                    v-if="administrator || view_employee"
                    class="transition-colors py-2 px-4 rounded text-white"
                >
                    <router-link
                        :to="{
                            name: 'app.employee.list',
                        }"
                        class="sidebar-item flex items-center justify-start gap-3"
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
                                d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 12.872M12.75 3.031a9 9 0 0 1 6.69 14.036m0 0-.177-.529A2.25 2.25 0 0 0 17.128 15H16.5l-.324-.324a1.453 1.453 0 0 0-2.328.377l-.036.073a1.586 1.586 0 0 1-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 0 1-5.276 3.67m0 0a9 9 0 0 1-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25"
                            />
                        </svg>

                        <span>کارمندان </span>
                    </router-link>
                </li>

                <li
                    v-if="administrator"
                    class="transition-colors cursor-pointer w-full px-4 py-2 text-white"
                >
                    <router-link
                        :to="{ name: 'app.user.list' }"
                        class="sidebar-item flex items-center justify-start gap-3"
                    >
                        <svg
                            class="fill-stroke w-5 h-5"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <path
                                d="M6 21V19C6 17.9391 6.42143 16.9217 7.17157 16.1716C7.92172 15.4214 8.93913 15 10 15H14C15.0609 15 16.0783 15.4214 16.8284 16.1716C17.5786 16.9217 18 17.9391 18 19V21"
                                stroke="currentColor"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                        </svg>
                        <span>کاربران سیستم</span>
                    </router-link>
                </li>
            </ul>
        </nav>
    </aside>
</template>
<script setup>
import { computed, onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import { useUserStore } from "../stores/user/userStore";

const userStore = useUserStore();
const route = useRoute();

const current_route = route.path;

onMounted(() => {
    getCurrentPermission();
});

const administrator = computed(
    () => userStore.permission_current.administrator
);

const view_pdc = computed(() => userStore.permission_current.view_pdc);
const view_post_graduated = computed(
    () => userStore.permission_current.view_post_graduated
);
const view_teacher_department = computed(
    () => userStore.permission_current.view_teacher_department
);
const view_quality_assurance = computed(
    () => userStore.permission_current.view_quality_assurance
);
const view_research_department = computed(
    () => userStore.permission_current.view_research_department
);

const view_document = computed(
    () => userStore.permission_current.view_document
);

const view_employee = computed(
    () => userStore.permission_current.view_employee
);

function getCurrentPermission() {
    userStore.getCurrentPermission();
}

let pdcToggle = ref(false);
let teacherToggle = ref(false);
let qualityToggle = ref(false);
let postToggle = ref(false);
let researchToggle = ref(false);
let reportToggle = ref(false);

function togglePdc() {
    pdcToggle.value = !pdcToggle.value;
}

function toggleTeacher() {
    teacherToggle.value = !teacherToggle.value;
}

function toggleQuality() {
    qualityToggle.value = !qualityToggle.value;
}

function togglePost() {
    postToggle.value = !postToggle.value;
}

function toggleResearch() {
    researchToggle.value = !researchToggle.value;
}

function toggleReport() {
    reportToggle.value = !reportToggle.value;
}
</script>
