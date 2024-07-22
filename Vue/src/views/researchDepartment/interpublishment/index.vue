<template>
    <div>
        <!-- list the curriculum -->
        <listPublishment :open-modal="openModal" />
        <!-- create  subject  in the curriculum  -->
        <WrapperModal
            :title="'فورم ایجاد نشرات '"
            :is-open="isOpen"
            :close-modal="closeModal"
        >
            <createPublishment :close-modal="closeModal" />
        </WrapperModal>
    </div>
</template>

<script setup>
import { ref } from "vue";
import WrapperModal from "../../postgraduatedProgram/graduatedStudent/Modal.vue";
import createPublishment from "./create.vue";
import listPublishment from "./list.vue";


const isOpen = ref(false);
function openModal() {
    isOpen.value = true;
}

function closeModal() {
    isOpen.value = false;
}
</script>
