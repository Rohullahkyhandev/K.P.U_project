<template>
    <div class="flex flex-col items-center" :class="class">
        <div class="card flex flex-col justify-center">
            <ProgressSpinner
                style="width: 60px; height: 60px; color:blue"
                strokeWidth="3"
                fill="transparent"
                animationDuration=".5s"
                aria-label="Custom ProgressSpinner"
            />
            <div v-if="text" class="mt-2 font-semibold">{{ text }}</div>
        </div>
    </div>
</template>

<script setup>
import ProgressSpinner from "primevue/progressspinner";

const { text } = defineProps({
    text: {
        type: String,
        default: "لطفا منتظر باشید ....",
    },
    class: {
        type: String,
        default: "py-8",
    },
});
</script>

<style scoped></style>
