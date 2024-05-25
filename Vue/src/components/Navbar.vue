<template>
    <div
        class="w-full shadow-sm h-16 bg-gray-50 shadow relative flex items-center justify-between"
    >
        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div class="ml-96">
            <Menu as="div" class="relative inline-block text-left w-full">
                <div
                    class="h-16 hover:bg-gray-100 transition-colors py-2 px-3 w-full"
                >
                    <MenuButton>
                        <span id="bell--button " class="relative">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-8 h-8 mt-2 text-red-500"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5"
                                />
                            </svg>
                            <span
                                class="absolute w-4 h-4 bg-red-500 top-2 left-4 rounded-full"
                            ></span>
                        </span>
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
                        class="absolute right-0 mt-2 z-20 w-96 h-64 overflow-y-scroll origin-top-right bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
                    >
                        <div class="px-1 py-1 z-2">
                            <MenuItem v-slot="{ active }">
                                <router-link
                                    :to="{ name: 'app.pdc.commit.list' }"
                                    :class="[
                                        active
                                            ? 'bg-gray-200 w-full py-4 px-3 flex border-b items-center justify-between'
                                            : 'flex w-full items-center py-2 border-b px-3 justify-between',
                                    ]"
                                >
                                    <span class="flex gap-3">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-6 h-6 text-blue-800"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z"
                                            />
                                        </svg>
                                        <span class="text-red-300"
                                            >New Commit Created
                                        </span>
                                    </span>
                                    <div>
                                        <img
                                            :src="auth.user.data.photo_path"
                                            class="rounded-full w-10 h-10"
                                            alt=""
                                        />
                                        <span
                                            class="text-blue-300"
                                            style="font-size: 12px"
                                            >{{ auth.user.data.name }}</span
                                        >
                                    </div>
                                </router-link>
                            </MenuItem>
                        </div>

                        <div class="px-1 py-1 z-2">
                            <MenuItem v-slot="{ active }">
                                <router-link
                                    :to="{ name: 'app.pdc.commit.list' }"
                                    :class="[
                                        active
                                            ? 'bg-gray-200 w-full py-4 px-3 flex border-b items-center justify-between'
                                            : 'flex w-full items-center py-2 border-b px-3 justify-between',
                                    ]"
                                >
                                    <span class="flex gap-3">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-6 h-6 text-blue-800"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z"
                                            />
                                        </svg>
                                        <span class="text-red-300"
                                            >New Commit Created
                                        </span>
                                    </span>
                                    <div>
                                        <img
                                            :src="auth.user.data.photo_path"
                                            class="rounded-full w-10 h-10"
                                            alt=""
                                        />
                                        <span
                                            class="text-blue-300"
                                            style="font-size: 12px"
                                            >{{ auth.user.data.name }}</span
                                        >
                                    </div>
                                </router-link>
                            </MenuItem>
                        </div>

                        <div class="px-1 py-1 z-2">
                            <MenuItem v-slot="{ active }">
                                <router-link
                                    :to="{ name: 'app.pdc.commit.list' }"
                                    :class="[
                                        active
                                            ? 'bg-gray-200 w-full py-4 px-3 flex border-b items-center justify-between'
                                            : 'flex w-full items-center py-2 border-b px-3 justify-between',
                                    ]"
                                >
                                    <span class="flex gap-3">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-6 h-6 text-blue-800"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z"
                                            />
                                        </svg>
                                        <span class="text-red-300"
                                            >New Commit Created
                                        </span>
                                    </span>
                                    <div>
                                        <img
                                            :src="auth.user.data.photo_path"
                                            class="rounded-full w-10 h-10"
                                            alt=""
                                        />
                                        <span
                                            class="text-blue-300"
                                            style="font-size: 12px"
                                            >{{ auth.user.data.name }}</span
                                        >
                                    </div>
                                </router-link>
                            </MenuItem>
                        </div>

                        <div class="px-1 py-1 z-2">
                            <MenuItem v-slot="{ active }">
                                <router-link
                                    :to="{ name: 'app.pdc.commit.list' }"
                                    :class="[
                                        active
                                            ? 'bg-gray-200 w-full py-4 px-3 flex border-b items-center justify-between'
                                            : 'flex w-full items-center py-2 border-b px-3 justify-between',
                                    ]"
                                >
                                    <span class="flex gap-3">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-6 h-6 text-blue-800"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z"
                                            />
                                        </svg>
                                        <span class="text-red-300"
                                            >New Commit Created
                                        </span>
                                    </span>
                                    <div>
                                        <img
                                            :src="auth.user.data.photo_path"
                                            class="rounded-full w-10 h-10"
                                            alt=""
                                        />
                                        <span
                                            class="text-blue-300"
                                            style="font-size: 12px"
                                            >{{ auth.user.data.name }}</span
                                        >
                                    </div>
                                </router-link>
                            </MenuItem>
                        </div>

                        <div class="px-1 py-1 z-2">
                            <MenuItem v-slot="{ active }">
                                <router-link
                                    :to="{ name: 'app.pdc.commit.list' }"
                                    :class="[
                                        active
                                            ? 'bg-gray-200 w-full py-4 px-3 flex border-b items-center justify-between'
                                            : 'flex w-full items-center py-2 border-b px-3 justify-between',
                                    ]"
                                >
                                    <span class="flex gap-3">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="w-6 h-6 text-blue-800"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z"
                                            />
                                        </svg>
                                        <span class="text-red-300"
                                            >Is trying to delete crucial data.
                                        </span>
                                    </span>
                                    <div>
                                        <img
                                            :src="auth.user.data.photo_path"
                                            class="rounded-full w-10 h-10"
                                            alt=""
                                        />
                                        <span
                                            class="text-blue-300"
                                            style="font-size: 12px"
                                            >{{ auth.user.data.name }}</span
                                        >
                                    </div>
                                </router-link>
                            </MenuItem>
                        </div>
                    </MenuItems>
                </transition>
            </Menu>
        </div>
        <div class="absolute left-4 w-56 text-right">
            <Menu as="div" class="relative inline-block text-left w-full">
                <div
                    class="h-16 hover:bg-gray-100 transition-colors py-2 px-3 w-full"
                >
                    <MenuButton>
                        <div
                            class="flex items-center justify-between w-full gap-5"
                            @click="rotateProfile = !rotateProfile"
                        >
                            <span v-if="auth.user.data.photo_path != ''">
                                <img
                                    :src="auth.user.data.photo_path"
                                    class="rounded-full object-cover h-10 w-10"
                                    :alt="auth.user.data.name"
                                />
                            </span>
                            <span v-else>
                                <img
                                    src="../../public/th.jpg"
                                    class="rounded-full object-cover h-10 w-10"
                                />
                            </span>
                            <span>{{ auth.user.data.name }}</span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                :class="[
                                    rotateProfile == true
                                        ? 'rotate-180 w-5 h-5 transition'
                                        : 'w-5 h-5 transition',
                                ]"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m4.5 15.75 7.5-7.5 7.5 7.5"
                                />
                            </svg>
                        </div>
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
                        class="absolute right-0 mt-2 w-56 origin-top-right bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
                    >
                        <div class="px-1 py-1">
                            <MenuItem v-slot="{ active }">
                                <button
                                    :class="[
                                        active
                                            ? 'bg-red-500 text-white'
                                            : 'text-gray-900',
                                        'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                    ]"
                                    @click="logout"
                                >
                                    <EditIcon
                                        :active="active"
                                        class="mr-2 h-5 w-5 text-violet-400"
                                        aria-hidden="true"
                                    />
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
                                            d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l-3 3m0 0 3 3m-3-3h12.75"
                                        />
                                    </svg>
                                    خروج
                                </button>
                            </MenuItem>
                            <MenuItem v-slot="{ active }">
                                <button
                                    :class="[
                                        active
                                            ? 'bg-blue-500 text-white'
                                            : 'text-gray-900',
                                        'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                    ]"
                                >
                                    <DuplicateIcon
                                        :active="active"
                                        class="mr-2 h-5 w-5 text-violet-400"
                                        aria-hidden="true"
                                    />
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
                                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                        />
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
</template>

<script setup>
import { Menu, MenuItem, MenuItems, MenuButton } from "@headlessui/vue";
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";
import { useAuthStore } from "../stores/auth";
const rotateProfile = ref(false);
const router = useRouter();
const auth = useAuthStore();
onMounted(() => {
    auth.getUser();
});
function logout() {
    auth.logout();
    router.push({ name: "login" });
}
</script>
