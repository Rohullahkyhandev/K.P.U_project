<script setup lang="ts">
const props = defineProps(["subtitle", "title", "customClasses"]);
import illustration from "../../assets/images/illustration/illustration-03.svg";
import Logo from "../../assets/images/logo/logo.svg";
</script>

<template>
    <!-- ====== Forms Section Start -->
    <div
        class="rounded-lg border border-stroke bg-white py-6 px-6 shadow-default"
    >
        <div class="flex flex-wrap items-center">
            <div class="hidden w-full xl:block xl:w-1/2">
                <div class="py-17.5 px-26 text-center">
                    <router-link class="mb-5.5 inline-block" to="/">

                    </router-link>

                    <span class="mt-15 inline-block">
                        <img :src="illustration" alt="illustration" />
                    </span>
                </div>
            </div>
            <div
                class="w-full border-stroke dark:border-strokedark xl:w-1/2 xl:border-l-2"
            >
                <div class="w-full p-4 sm:p-12.5 xl:p-17.5" dir="rtl">
                    <!-- <span class="mb-1.5 block font-medium">{{
                        props.subtitle
                    }}</span> -->
                    <h2
                        class="mb-9 text-2xl font-bold text-black sm:text-title-xl2"
                    >
                        {{ props.title }}
                    </h2>

                    <slot></slot>
                </div>
            </div>
        </div>
    </div>
    <!-- ====== Forms Section End -->
</template>
