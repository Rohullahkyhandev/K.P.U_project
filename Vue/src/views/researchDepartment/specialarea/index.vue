<template>
    <div>
        <!-- list the curriculum -->
        <listSpecialArea :open-modal="openModal" />
        <!-- create  subject  in the curriculum  -->
        <WrapperModal
            :title="'فورم افزودن حوزه های تخصص و فعالیت'"
            :is-open="isOpen"
            :close-modal="closeModal"
        >
            <createSpecialArea :close-modal="closeModal" />
        </WrapperModal>
    </div>
</template>

<script setup>
import { ref } from "vue";
import WrapperModal from "../../postgraduatedProgram/graduatedStudent/Modal.vue";
import createSpecialArea from "./create.vue";
import listSpecialArea from "./list.vue";


const isOpen = ref(false);
function openModal() {
    isOpen.value = true;
}

function closeModal() {
    isOpen.value = false;
}
</script>
