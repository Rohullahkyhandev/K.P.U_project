<template>
    <div class="form--padding--top">
        <div class="flex items-center justify-between w-full">
            <div>
                <router-link
                    :to="{ name: 'app.pdc.teacher_in_workshop.list' }"
                    class="header--button"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-5 h-5 text-white"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"
                        />
                    </svg>
                    لیست ورکشاپ ها
                </router-link>
            </div>
            <div>
                <h1 class="text--header">فورم ثبت ورکشاپ جدید</h1>
            </div>
        </div>
        <form @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="wrapper--dev--form">
                <!-- display message area -->
                <div
                    class="msg--success"
                    v-if="teacherInWorkshopStore.msg_success"
                >
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="teacherInWorkshopStore.msg_success = ''"
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
                        <div>
                            <span>{{
                                teacherInWorkshopStore.msg_success
                            }}</span>
                        </div>
                    </div>
                </div>

                <div
                    class="msg--warning"
                    v-if="teacherInWorkshopStore.msg_wrang"
                >
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="teacherInWorkshopStore.msg_wrang = ''"
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
                        <div>
                            <span>{{ teacherInWorkshopStore.msg_wrang }}</span>
                        </div>
                    </div>
                </div>
                <!-- end of display message area -->

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
                            v-model="teacherInWorkshop.department_type"
                            :select-options="department_type"
                            class="mb-2"
                            required="required"
                        />
                    </div>
                </div>

                <div
                    class="wrapper--dev--input"
                    v-if="
                        teacherInWorkshop.department_type == 'common_department'
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
                            @change="
                                getTeacher(teacherInWorkshop.department_id)
                            "
                            v-model="teacherInWorkshop.department_id"
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
                        teacherInWorkshop.department_type ==
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
                                getDepartment(teacherInWorkshop.faculty_id)
                            "
                            v-model="teacherInWorkshop.faculty_id"
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
                        teacherInWorkshop.department_type ==
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
                                getTeacher(teacherInWorkshop.department_id)
                            "
                            v-model="teacherInWorkshop.department_id"
                            :select-options="departments"
                            class="mb-2"
                            required="required"
                        />
                    </div>
                </div>

                <div
                    class="wrapper--dev--input"
                    v-if="
                        (departments.length != '' ||
                            department_out_faculties.length != '') &&
                        teacherInWorkshop.department_type != ''
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
                            v-model="teacherInWorkshop.teacher_id"
                            :select-options="teachers"
                            class="mb-2"
                            required="required"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label for="" class="form--label">
                            ورکشاپ ها
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="select"
                            :selectOptions="workshops"
                            v-model="teacherInWorkshop.workshop_id"
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
                        <!-- <input type="file" multiple @change="handelFiles" /> -->
                        <CustomInput
                            type="file"
                            @change="
                                (file) => {
                                    teacherInWorkshop.document = file;
                                }
                            "
                            class="mb-2"
                        />
                    </div>
                </div>
            </div>

            <footer class="bg-gray-100 py-4 md:flex gap-5">
                <button
                    type="submit"
                    :class="[
                        teacherInWorkshopStore.loading === true
                            ? 'footer--button--submit cursor-not-allowed'
                            : 'footer--button--submit cursor-pointer rounded ',
                    ]"
                >
                    <span v-if="teacherInWorkshopStore.loading === true">
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
                    <span v-else> ثبت </span>
                </button>
                <router-link
                    :to="{ name: 'app.dashboard' }"
                    class="footer--button--cancel"
                    >لغو ثبت</router-link
                >
            </footer>
        </form>
    </div>
</template>

<script setup>
import { computed, onMounted, ref, useSlots } from "vue";
import CustomInput from "../../../components/core/CustomInput.vue";
import useDepartmentStore from "../../../stores/department/deparmentStore";
import { useFacultyStore } from "../../../stores/faculties/facultyStore";

import useTeacherInWorkshop from "../../../stores/pdc/teacherInWorshop/teacherInWorkshopStore";
const teacherInWorkshopStore = useTeacherInWorkshop();
const facultyStore = useFacultyStore();
const departmentStore = useDepartmentStore();

const teacherInWorkshop = computed(
    () => teacherInWorkshopStore.teacherInWorkshop
);

onMounted(() => {
    facultyStore.getAllFaculty();
    if (teacherInWorkshop.value.faculty_id != "") {
        departmentStore.getFacultyDepartment(
            teacherInWorkshopStore.value.faculty_id
        );
        if (teacherInWorkshopStore.value.department_id != "") {
            teacherInWorkshopStore.getTeacher(
                teacherInWorkshopStore.value.department_id
            );
        }
    } else {
        departmentStore.departmentHasOutFaculties();
    }
    teacherInWorkshopStore.getWorkshops();
});

function getDepartment(id) {
    departmentStore.getFacultyDepartment(id);
}

function getTeacher(id) {
    teacherInWorkshopStore.getTeacher(id);
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
    teacherInWorkshopStore.teacher_department.map((c) => ({
        key: c.id,
        text: c.name + " " + c.lname,
    }))
);

const workshops = computed(() =>
    teacherInWorkshopStore.workshops.map((workshop) => ({
        key: workshop.id,
        text:
            workshop.topic +
            "  تایم شروع:- " +
            workshop.start_time +
            " تایم ختم:- " +
            workshop.end_time,
    }))
);

const selectFiles = ref([]);

function onSubmit() {
    let formData = new FormData();
    selectFiles.value.forEach((item) => formData.append("files[]", item));
    teacherInWorkshopStore.createTeacherInWorkshop(teacherInWorkshop.value);
}

function handelFiles(event) {
    selectFiles.value = Array.from(event.target.files);
}
</script>
