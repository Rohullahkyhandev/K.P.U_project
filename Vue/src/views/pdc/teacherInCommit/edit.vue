<template>
    <div class="form--padding--top">
        <form @submit.prevent="onSubmit">
            <div class="wrapper--dev--form">
                <!-- display message area -->
                <!-- display message area -->
                <div
                    class="msg--success"
                    v-if="teacherInCommitStore.msg_success"
                >
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="teacherInCommitStore.msg_success = ''"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 18 18 6M6 6l12 12"
                                />
                            </svg>
                        </div>
                        <div class="flex items-center gap-10">
                            <div>
                                <span class="px-4">{{
                                    teacherInCommitStore.msg_success
                                }}</span>
                            </div>
                            <div
                                class="bg-white flex items-center justify-center w-10 h-10 rounded-full"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-6 text-green-600"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m4.5 12.75 6 6 9-13.5"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="msg--warning" v-if="teacherInCommitStore.msg_wrang">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-red-200 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="teacherInCommitStore.msg_wrang = ''"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="w-6 h-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 18 18 6M6 6l12 12"
                                />
                            </svg>
                        </div>
                        <div class="flex items-center gap-10">
                            <div>
                                <span class="px-4">{{
                                    teacherInCommitStore.msg_wrang
                                }}</span>
                            </div>
                            <div
                                class="bg-white flex items-center justify-center w-10 h-10 rounded-full"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-6 text-red-500"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"
                                    />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of display message area -->
                <!-- end of display message area -->

                <div>
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                نوع دیپارتمنت
                                <span class="label--prefix">*</span>
                            </label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="select"
                                v-model="teacher_in_commit.department_type"
                                :select-options="department_type"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>

                    <div
                        class="wrapper--dev--input"
                        v-if="
                            teacher_in_commit.department_type ==
                            'common_department'
                        "
                    >
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                دیپارمنت های عمومی
                                <span class="label--prefix">*</span>
                            </label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="select"
                                v-model="teacher_in_commit.department_id"
                                :select-options="department_out_faculties"
                                class="mb-2"
                                required="required"
                                label=" دیپارتمنت"
                            />
                        </div>
                    </div>

                    <div
                        class="wrapper--dev--input"
                        v-if="
                            teacher_in_commit.department_type ==
                            'uncommon_department'
                        "
                    >
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                فاکولته
                                <span class="label--prefix">*</span>
                            </label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="select"
                                @change="
                                    getDepartment(teacher_in_commit.faculty_id)
                                "
                                v-model="teacher_in_commit.faculty_id"
                                :select-options="faculties"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>

                    <div
                        class="wrapper--dev--input"
                        v-if="
                            departments.length != '' &&
                            teacher_in_commit.department_type ==
                                'uncommon_department'
                        "
                    >
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                دیپارتمنت ها
                                <span class="label--prefix">*</span>
                            </label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="select"
                                @change="
                                    getTeacher(teacher_in_commit.department_id)
                                "
                                v-model="teacher_in_commit.department_id"
                                :select-options="departments"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>

                    <div
                        class="wrapper--dev--input"
                        v-if="
                            departments.length != '' ||
                            department_out_faculties.length != ''
                        "
                    >
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                استادان
                                <span class="label--prefix">*</span></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="select"
                                v-model="teacher_in_commit.teacher_id"
                                :select-options="teachers"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                کمیته<span class="label--prefix">*</span></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="select"
                                :select-options="commits"
                                v-model="teacher_in_commit.commit_id"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                آپلود فایل<span class="label--prefix"></span
                            ></label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="file"
                                @change="
                                    (file) =>
                                        (teacher_in_commit.attachment = file)
                                "
                                class="mb-2"
                            />
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-gray-100 py-4 md:flex gap-5">
                <button
                    type="submit"
                    :class="[
                        teacherInCommitStore.loading === true
                            ? 'footer--button--submit cursor-not-allowed'
                            : 'footer--button--submit cursor-pointer rounded ',
                    ]"
                >
                    <span v-if="teacherInCommitStore.loading === true">
                        <svg
                            class="animate-spin -ml-1 h-5 w-5 text-white"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                class="opacity-25"
                                cx="12"
                                cy="12"
                                r="10"
                                stroke="currentColor"
                                stroke-width="4"
                            ></circle>
                            <path
                                class="opacity-75"
                                fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                            ></path>
                        </svg>
                    </span>
                    <span v-else> ویرایش </span>
                </button>
                <router-link
                    :to="{ name: 'app.dashboard' }"
                    class="footer--button--cancel"
                    >لغو ویرایش</router-link
                >
            </footer>
        </form>
    </div>
</template>

<script setup>
import {
    computed,
    onBeforeMount,
    onMounted,
    onUpdated,
    ref,
    useSlots,
} from "vue";
import { useRoute } from "vue-router";
import CustomInput from "../../../components/core/CustomInput.vue";
import useDepartmentStore from "../../../stores/department/deparmentStore";
import { useFacultyStore } from "../../../stores/faculties/facultyStore";
import useTeacherInCommit from "../../../stores/pdc/teacherInCommit/teacherInCommitStore";

const teacherInCommitStore = useTeacherInCommit();
const facultyStore = useFacultyStore();
const departmentStore = useDepartmentStore();
const route = useRoute();

const teacher_in_commit = computed(
    () => teacherInCommitStore.teacher_in_commit
);

onMounted(() => {
    facultyStore.getAllFaculty();
    teacherInCommitStore.editTeacherInCommit(route.params.id);
    teacherInCommitStore.getCommits();
});

setTimeout(() => {
    getDepartment(teacher_in_commit.value.faculty_id);
    getTeacher(teacher_in_commit.value.department_id);
    departmentStore.departmentHasOutFaculties();
}, 2000);

function getDepartment(id) {
    departmentStore.getFacultyDepartment(id);
}

function getTeacher(id) {
    teacherInCommitStore.getTeachers(id);
}

const department_type = ref([
    {
        key: "common_department",
        text: "دیپارمنت های  عمومی",
    },

    {
        key: "uncommon_department",
        text: "دیپارمنت های غیر عمومی",
    },
]);

const faculties = computed(() =>
    facultyStore.listFaculty.map((f) => ({ key: f.id, text: f.name }))
);

const departments = computed(() =>
    departmentStore.faculty_department.map((d) => ({ key: d.id, text: d.name }))
);

const department_out_faculties = computed(() =>
    departmentStore.department_has_out_facilities.map((d) => ({
        key: d.id,
        text: d.name,
    }))
);

const teachers = computed(() =>
    teacherInCommitStore.teachers.map((c) => ({
        key: c.id,
        text: c.name + " " + c.lname,
    }))
);
const commits = computed(() =>
    teacherInCommitStore.commits.map((c) => ({
        key: c.id,
        text: c.name,
    }))
);

function onSubmit() {
    teacherInCommitStore.updateTeacherInCommit(teacher_in_commit.value);
}
</script>
