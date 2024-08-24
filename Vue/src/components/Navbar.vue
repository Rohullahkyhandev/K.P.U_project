<template>
    <div class="w-full  shadow-sm h-20 bg-gray-50 flex items-center ">
        <div>&nbsp;</div>

        <div class="flex w-full gap-6 items-center justify-end">
            <div class="w-12 flex items-center justify-center">
                <Menu as="div" class="relative inline-block text-left w-full">
                    <div class="h-20 mb-2 hover:bg-gray-100 flex items-center transition-colors py-2 px-3 w-full">
                        <MenuButton>
                            <span id="bell--button" class="relative">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-8 h-8 mt-2 text-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                                </svg>
                                <span v-if="
                                    notificationStore.notificationCounter >
                                    0
                                "
                                    class="absolute flex items-center justify-center text-white w-6 h-6 bg-red-500 top-2 left-4 rounded-full">
                                    {{ notificationStore.notificationCounter }}
                                </span>
                            </span>
                        </MenuButton>
                    </div>
                    <transition enter-active-class="transition duration-100 ease-out"
                        enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100"
                        leave-active-class="transition duration-75 ease-in"
                        leave-from-class="transform scale-100 opacity-100"
                        leave-to-class="transform scale-95 opacity-0">
                        <MenuItems style="width: 450px"
                            class="absolute left-4 z-20 overflow-y-auto origin-top-right bg-white rounded-lg shadow-lg ring-1 ring-black/5 focus:outline-none">
                            <div></div>
                            <div class="wrapper--for--condations" v-if="notificationStore.notifications">
                                <div class="px-1 py-1 z-2" v-for="(
                                        notification, index
                                    ) in notificationStore.notifications" :key="index">
                                    <MenuItem v-slot="{ active }">
                                    <button @click="
                                        updateNotification(
                                            notification.id
                                        )
                                        " :class="[
                                            active
                                                ? 'hover:bg-gray-200 rounded w-full  px-3 flex border-b items-center justify-between'
                                                : 'flex w-full items-center  border-b px-3 justify-between',
                                        ]">
                                        <div class="flex w-full justify-between gap-3 py-3">
                                            <div class="flex gap-3">
                                                <div class="mb-3">
                                                    <img :src="notification.photo_path
                                                        " class="w-10 h-10 rounded-full" alt="image" />
                                                    <span>{{
                                                        notification.uname
                                                    }}</span>
                                                </div>
                                                <div class="flex flex-col text-right">
                                                    <div class="whitespace-nowrap">
                                                        <span class="font-semibold whitespace-nowrap">{{
                                                            truncatedTitle(
                                                                notification.title,
                                                                50
                                                            )
                                                        }}</span>
                                                    </div>
                                                    <div class="whitespace-nowrap">
                                                        مکتوب با شماره
                                                        <span class="underline">{{
                                                            notification.number
                                                        }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="whitespace-nowrap">
                                                <span
                                                    class="bg-blue-400 text-white whitespace-nowrap rounded-lg px-3">{{
                                                        notification.created_at
                                                    }}</span>
                                            </div>
                                        </div>
                                    </button>
                                    </MenuItem>
                                </div>
                            </div>
                            <div class="p-3 text-start font-semibold" v-else>
                                پیام یافت نشد!
                            </div>
                        </MenuItems>
                    </transition>
                </Menu>
            </div>
            <div class="ml-[50px]  w-56 text-right">
                <Menu as="div" class="relative inline-block text-left w-full">
                    <div class="h-20 hover:bg-gray-100 transition-colors py-3 flex items-center px-3 w-full">
                        <MenuButton>
                            <div class="flex z-10 items-center justify-between w-full gap-5"
                                @click="rotateProfile = !rotateProfile">
                                <span v-if="auth.user.data.photo_path != ''">
                                    <img :src="auth.user.data.photo_path" class="rounded-full object-cover h-10 w-10"
                                        :alt="auth.user.data.name" />
                                </span>
                                <span v-else>
                                    <img src="../../public/th.jpg" class="rounded-full object-cover h-10 w-10" />
                                </span>
                                <span>{{ auth.user.data.name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" :class="[
                                        rotateProfile == true
                                            ? 'rotate-180 w-5 h-5 transition'
                                            : 'w-5 h-5 transition',
                                    ]">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m4.5 15.75 7.5-7.5 7.5 7.5" />
                                </svg>
                            </div>
                        </MenuButton>
                    </div>

                    <transition enter-active-class="transition duration-100 ease-out"
                        enter-from-class="transform scale-95 opacity-0" enter-to-class="transform scale-100 opacity-100"
                        leave-active-class="transition duration-75 ease-in"
                        leave-from-class="transform scale-100 opacity-100"
                        leave-to-class="transform scale-95 opacity-0">
                        <MenuItems
                            class="absolute right-0 w-56 origin-top-right bg-white shadow-lg ring-1 ring-black/5 focus:outline-none">
                            <div class="px-1 py-1">
                                <MenuItem v-slot="{ active }">
                                <button :class="[
                                    active
                                        ? 'bg-red-500/90 text-white'
                                        : 'text-gray-900',
                                    'group flex w-full items-center gap-3 rounded-md px-2 py-2 text-sm',
                                ]" @click="logout">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75" />
                                    </svg>
                                    خروج
                                </button>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                <button :class="[
                                    active
                                        ? 'bg-blue-500 text-white'
                                        : 'text-gray-900',
                                    'group flex w-full items-center gap-3 rounded-md px-2 py-2 text-sm',
                                ]">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                    پروفایل کاربر
                                </button>
                                </MenuItem>
                            </div>
                        </MenuItems>
                    </transition>
                </Menu>
            </div>
        </div>
        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div>&nbsp;</div>
    </div>
</template>

<script setup>
import { Menu, MenuItem, MenuItems, MenuButton } from "@headlessui/vue";
import { onMounted, ref, computed } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "../stores/auth";
import useDocumentStore from "../stores/documents/documentStore";
const rotateProfile = ref(false);

const router = useRouter();
const auth = useAuthStore();
const notificationStore = useDocumentStore();
onMounted(() => {
    auth.getUser();
    Notify();
    countNotify();
});

function truncatedTitle(text, maxLength) {
    return text.length > maxLength ? text.slice(0, maxLength) + "..." : text;
}

// job for get all the data
function Notify() {
    setInterval(() => {
        notificationStore.getNotification();
    }, 2000 * 4);
}

// job for the countNotifications
function countNotify() {
    setInterval(() => {
        notificationStore.countNotification();
    }, 2000 * 4);
}

// job update the notification
function updateNotification(id) {
    notificationStore.updateNotification(id);
}

function logout() {
    auth.logout();
    router.push({ name: "login" });
}
</script>
