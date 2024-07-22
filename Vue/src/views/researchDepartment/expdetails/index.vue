<template>
    <div>
        <!-- list the curriculum -->
        <listExpDetail :open-modal="openModal" />
        <!-- create  subject  in the curriculum  -->
        <WrapperModal
            :title="'فورم افزودن جزیات آزمایشات'"
            :is-open="isOpen"
            :close-modal="closeModal"
        >
            <createExpDetail :close-modal="closeModal" />
        </WrapperModal>
    </div>
</template>

<script setup>
import { ref } from "vue";
import WrapperModal from "../../postgraduatedProgram/graduatedStudent/Modal.vue";
import createExpDetail from "./create.vue";
import listExpDetail from "./list.vue";


const isOpen = ref(false);
function openModal() {
    isOpen.value = true;
}

function closeModal() {
    isOpen.value = false;
}
</script>
