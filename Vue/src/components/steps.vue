<template>
    <div class="flex gap-24">
        <div class="flex items-center flex-col gap-3">
            <span
                v-if="stepOne == false"
                class="bg-blue-400 text-white w-10 h-10 flex items-center justify-center rounded-full"
            >
                <!-- <svg
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
                        d="M6 18 18 6M6 6l12 12"
                    />
                </svg> -->
                <span>1</span>
            </span>
            <span
                v-else
                class="bg-green-400 text-white w-10 h-10 flex items-center justify-center rounded-full"
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
                        d="m4.5 12.75 6 6 9-13.5"
                    />
                </svg>
            </span>
            <span class="">معلومات شخصی استاد</span>
        </div>
        <div class="flex items-center flex-col gap-3">
            <span
                v-if="stepTwo == false"
                class="bg-blue-400 text-white w-10 h-10 flex items-center justify-center rounded-full"
            >
                <!-- <svg
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
                        d="M6 18 18 6M6 6l12 12"
                    />
                </svg> -->
                <span>2</span>
            </span>
            <span
                v-else
                class="bg-green-400 text-white w-10 h-10 flex items-center justify-center rounded-full"
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
                        d="m4.5 12.75 6 6 9-13.5"
                    />
                </svg>
            </span>
            <span>سویه تحصلی استاد</span>
        </div>
        <div class="flex items-center flex-col gap-3">
            <span
                v-if="stepThree == false"
                class="bg-blue-400 text-white w-10 h-10 flex items-center justify-center rounded-full"
            >
                <!-- <svg
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
                        d="M6 18 18 6M6 6l12 12"
                    />
                </svg> -->
                <span>3</span>
            </span>
            <span
                v-else
                class="bg-green-400 text-white w-10 h-10 flex items-center justify-center rounded-full"
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
                        d="m4.5 12.75 6 6 9-13.5"
                    />
                </svg>
            </span>
            <span>اسناد تحصلی</span>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    stepOne: {
        type: Boolean,
        required: true,
        default: false,
    },
    stepTwo: {
        type: Boolean,
        required: true,
        default: false,
    },
    stepThree: {
        type: Boolean,
        required: true,
        default: false,
    },
});
</script>
