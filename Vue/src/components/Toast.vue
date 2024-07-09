<template>
    <div>
        <button @click="notify">Notify !</button>
    </div>
</template>

<script setup>
import { toast } from "vue3-toastify";


const notify = () => {
    toast.info("این مسیج را دریافت", {
        autoClose: false,
        rtl: true,
        position: "top-center",
        theme: "colored",

    }); // ToastOptions
};
</script>
