<template>
    <div>
        <!-- list the res project -->
        <listResProject :open-modal="openModal" />
        <!-- create  subject  in the res project  -->
        <WrapperModal
            :title="'فورم افزودن پروژه تحقیق'"
            :is-open="isOpen"
            :close-modal="closeModal"
        >
            <createResProject :close-modal="closeModal" />
        </WrapperModal>
    </div>
</template>

<script setup>
import { ref } from "vue";
import WrapperModal from "../../postgraduatedProgram/graduatedStudent/Modal.vue";
import createResProject from "./create.vue";
import listResProject from "./list.vue";


const isOpen = ref(false);
function openModal() {
    isOpen.value = true;
}

function closeModal() {
    isOpen.value = false;
}
</script>
