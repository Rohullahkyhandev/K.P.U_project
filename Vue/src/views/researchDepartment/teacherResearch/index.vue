<template>
    <div>
        <!-- list the curriculum -->
        <listTeacherResearch :open-modal="openModal" />
        <!-- create  subject  in the curriculum  -->
        <WrapperModal
            :title="'فورم ثبت تحقیق جدید '"
            :is-open="isOpen"
            :close-modal="closeModal"
        >
            <createTeacherResearch :close-modal="closeModal" />
        </WrapperModal>
    </div>
</template>

<script setup>
import { ref } from "vue";
import WrapperModal from "../../postgraduatedProgram/graduatedStudent/Modal.vue";
import createTeacherResearch from "./create.vue";
import listTeacherResearch from "./list.vue";


const isOpen = ref(false);
function openModal() {
    isOpen.value = true;
}

function closeModal() {
    isOpen.value = false;
}
</script>
