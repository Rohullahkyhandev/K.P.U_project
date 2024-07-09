<template>
    <div>
        <!-- display message area -->
        <div class="msg--success" v-if="msg_success">
            <div class="flex items-center justify-between px-10">
                <div
                    class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        @click="msg_success = ''"
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
                <div class="flex items-center gap-10">
                    <div>
                        <span class="px-4">{{ msg_success }}</span>
                    </div>
                    <div
                        class="bg-white flex items-center justify-center w-10 h-10 rounded-full"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6 text-green-600"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m4.5 12.75 6 6 9-13.5"
                            />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="msg--warning" v-if="msg_wrang">
            <div class="flex items-center justify-between px-10">
                <div
                    class="hover:bg-red-200 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        @click="msg_wrang = ''"
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
                <div class="flex items-center gap-10">
                    <div>
                        <span class="px-4">{{ msg_wrang }}</span>
                    </div>
                    <div
                        class="bg-white flex items-center justify-center w-10 h-10 rounded-full"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-6 text-red-500"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"
                            />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of display message area -->
    </div>
</template>
<script setup>
const props = defineProps({
    msg_success: {
        type: String,
        required: true,
    },
    msg_wrang: {
        type: String,
        required: true,
    },
});
</script>
