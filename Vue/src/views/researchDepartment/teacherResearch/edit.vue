<template>
    <div class="form--padding--top">
        <div class="flex items-center justify-between w-full">
            <div>
                <router-link
                    :to="{ name: 'app.research.tresearch.list' }"
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
                    لیست تحقیقات استادان
                </router-link>
            </div>
            <div>
                <h1 class="text--header">فورم ویرایش تحقیقات استادان</h1>
            </div>
        </div>
        <form @submit.prevent="onSubmit">
            <div class="py-8 mt-6 px-6 bg-white">
                <!-- display message area -->
                <div
                    class="msg--success"
                    v-if="teacherResearchStore.msg_success"
                >
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="teacherResearchStore.msg_success = ''"
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
                            <span>{{ teacherResearchStore.msg_success }}</span>
                        </div>
                    </div>
                </div>

                <div class="msg--warning" v-if="teacherResearchStore.msg_wrang">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="teacherResearchStore.msg_wrang = ''"
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
                            <span>{{ teacherResearchStore.msg_wrang }}</span>
                        </div>
                    </div>
                </div>
                <!-- end of display message area -->

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label for="" class="form--label">
                            اســـــم استاد<span class="label--prefix"
                                >*</span
                            ></label
                        >
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="text"
                            v-model="teacherResearch.name"
                            class="mb-2"
                            required="required"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label for="" class="form--label">
                            تخلص استاد<span class="label--prefix"
                                >*</span
                            ></label
                        >
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="text"
                            v-model="teacherResearch.lname"
                            class="mb-2"
                            required="required"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label for="" class="form--label">
                            اسم پدر استاد
                            <span class="label--prefix">*</span></label
                        >
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="text"
                            v-model="teacherResearch.fname"
                            class="mb-2"
                            required="required"
                        />
                    </div>
                </div>

                <div>
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                رتبه علمی
                                <span class="label--prefix">*</span></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="select"
                                :select-options="academic_ranks"
                                v-model="teacherResearch.academic_rank"
                                class="mb-2"
                                required="required"
                                label=" رتبه علمی"
                            />
                        </div>
                    </div>
                </div>
                <div>
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                سویه تحصیلی
                                <span class="label--prefix">*</span></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="select"
                                :select-options="education_degrees"
                                v-model="teacherResearch.education_degree"
                                class="mb-2"
                                required="required"
                                label=" سویه تحصیلی"
                            />
                        </div>
                    </div>
                </div>

                <div>
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                عنوان تحقیق
                                <span class="label--prefix">*</span></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="text"
                                v-model="teacherResearch.research_title"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>
                </div>

                <div>
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                پوهنځی ها
                                <span class="label--prefix">*</span></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="select"
                                v-model="teacherResearch.faculty_id"
                                @change="
                                    getDepartmentFaculty(
                                        teacherResearch.faculty_id
                                    )
                                "
                                :select-options="faculties"
                                label=" پوهنځی"
                                class="mb-2"
                            />
                        </div>
                    </div>
                </div>

                <div>
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                دیپارتمنت ها
                                <span class="label--prefix">*</span></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="select"
                                v-model="teacherResearch.department_id"
                                :select-options="departments"
                                label=" دیپارتمنت"
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
                        teacherResearchStore.loading === true
                            ? 'footer--button--submit cursor-not-allowed'
                            : 'footer--button--submit cursor-pointer rounded ',
                    ]"
                >
                    <span v-if="teacherResearchStore.loading === true">
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
                <span @click="closeModal" class="footer--button--cancel">
                    لغو ویرایش
                </span>
            </footer>
        </form>
    </div>
</template>

<script setup>
import DatePicker from "vue3-persian-datetime-picker";
import Select from "primevue/select";
import { computed, onMounted, ref, useSlots } from "vue";
import CustomInput from "../../../components/core/CustomInput.vue";
import useDepartmentStore from "../../../stores/department/deparmentStore";
import useTeacherResearchStore from "../../../stores/researchDepartment/teacherResearch";
import { useFacultyStore } from "../../../stores/faculties/facultyStore";
import { useRoute } from "vue-router";

const teacherResearchStore = useTeacherResearchStore();
const departmentStore = useDepartmentStore();
const facultyStore = useFacultyStore();
const route = useRoute();

onMounted(() => {
    teacherResearchStore.getAllDepartments();
    facultyStore.getAllFaculty();
    teacherResearchStore.editTeacherResearch(route.params.id);
});

const education_degrees = ref([
    {
        text: "لیسانس",
        key: "لیسانس",
    },
    {
        text: "ماستر",
        key: "ماستر",
    },
    {
        text: "داکتر",
        key: "داکتر",
    },
]);
const academic_ranks = ref([
    {
        text: "نامزد پوهنیار",
        key: "نامزد پوهنیار",
    },
    {
        text: "پوهیالی",
        key: "پوهیالی",
    },
    {
        text: "پوهنیار",
        key: "پوهنیار",
    },
    {
        text: "پوهنمل",
        key: "پوهنمل",
    },
    {
        text: "پوهاند",
        key: "پوهاند",
    },
]);

const props = defineProps({
    closeModal: {
        type: Function,
        required: true,
    },
});
const teacherResearch = computed(() => teacherResearchStore.teacherResearch);

const faculties = computed(() =>
    facultyStore.listFaculty.map((faculty) => ({
        key: faculty.id,
        text: faculty.name,
    }))
);
const departments = computed(() =>
    departmentStore.faculty_department.map((department) => ({
        key: department.id,
        text: department.name,
    }))
);

setTimeout(() => {
    getDepartmentFaculty(teacherResearchStore.teacherResearch.faculty_id);
}, 2000);

function getDepartmentFaculty(id) {
    departmentStore.getFacultyDepartment(id);
}

function onSubmit() {
    teacherResearchStore.updateTeacherResearch(teacherResearch.value);

    // for refreshing the teacher research
    // teacherResearchStore.getTeacherResearch();
}
</script>
