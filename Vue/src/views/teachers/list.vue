<template>
    <div class="form--padding--top">
        <!-- post teacher  -->
        <teacherInPostGraduatedProgram
            v-if="post_graduated_view == true || administrator == true"
        />
        <!-- all teacher  -->
        <allTeachers
            v-if="teacher_department_view == true || administrator == true"
        />
    </div>
</template>
<script setup>
import { computed, onMounted } from "vue";

import { useUserStore } from "../../stores/user/userStore";
import teacherInPostGraduatedProgram from "../postgraduatedProgram/teacher/index.vue";
import allTeachers from "../teachers/index.vue";

const userStore = useUserStore();

onMounted(() => {
    userStore.getUserPermission();
});

const post_graduated_view = computed(
    () => userStore.permission_current.post_graduated_view
);
const teacher_department_view = computed(
    () => userStore.permission_current.view_teacher_department
);
const administrator = computed(
    () => userStore.permission_current.administrator
);
</script>
