<template>
    <div>
        <!-- list the curriculum -->
        <listLab :open-modal="openModal" />
        <!-- create  subject  in the curriculum  -->
        <WrapperModal
            :title="'فورم افزودن لابراتوار'"
            :is-open="isOpen"
            :close-modal="closeModal"
        >
            <createLab :close-modal="closeModal" />
        </WrapperModal>
    </div>
</template>

<script setup>
import { ref } from "vue";
import WrapperModal from "../../postgraduatedProgram/graduatedStudent/Modal.vue";
import createLab from "./create.vue";
import listLab from "./list.vue";


const isOpen = ref(false);
function openModal() {
    isOpen.value = true;
}

function closeModal() {
    isOpen.value = false;
}
</script>
