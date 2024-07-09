<template>
    <div>
        <!-- list the curriculum -->
        <listCurriculum :open-modal="openModal" />
        <!-- create  subject  in the curriculum  -->
        <WrapperModal
            :title="'فورم افزودن مضمون در کریکولم'"
            :is-open="isOpen"
            :close-modal="closeModal"
        >
            <createCurriculum :close-modal="closeModal" />
        </WrapperModal>
    </div>
</template>

<script setup>
import { ref } from "vue";
import WrapperModal from "../../postgraduatedProgram/graduatedStudent/Modal.vue";
import createCurriculum from "./create.vue";
import listCurriculum from "./list.vue";


const isOpen = ref(false);
function openModal() {
    isOpen.value = true;
}

function closeModal() {
    isOpen.value = false;
}
</script>
