<template>
    <div class="form--padding--top">
        <div class="flex items-center justify-between w-full">
            <div>
                <h1 class="text--header">
                    فورم تهیه نمودن راپور تحقیقات استادان
                </h1>
            </div>
        </div>

        <form>
            <div class="wrapper--dev--form">
                <div>
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                انتخاب راپور بر اساس<span class="label--prefix"
                                    >*</span
                                ></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <select
                                class="appearance-none relative mb-3 shadow-sm block w-full item-center justify-between text-left px-3 py-2.5 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                v-model="reportData.type"
                            >
                                <option
                                    value=""
                                    selected
                                    class="flex items-center font-bold justify-between float-end"
                                >
                                    انتخاب راپور بر اساس
                                </option>
                                <option
                                    v-for="(type, index) in types"
                                    :key="index"
                                    :value="type.key"
                                >
                                    {{ type.text }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div
                        class="wrapper--dev--input"
                        v-if="
                            reportData.type == 'faculty' ||
                            reportData.type == 'department'
                        "
                    >
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                انتخاب پوهنحی<span class="label--prefix"
                                    >*</span
                                ></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <custom-input
                                type="select"
                                @change="getDepartment(reportData.faculty_id)"
                                :select-options="faculties"
                                v-model="reportData.faculty_id"
                                :placeholder="`انتخاب پوهنحی...`"
                                class="mb-2"
                            />
                        </div>
                    </div>

                    <div
                        class="wrapper--dev--input"
                        v-if="reportData.type == 'department'"
                    >
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                انتخاب دیپارتمنت<span class="label--prefix"
                                    >*</span
                                ></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <custom-input
                                type="select"
                                :select-options="departments"
                                v-model="reportData.department_id"
                                :placeholder="`انتخاب دیپارتمنت...`"
                                class="mb-2"
                            />
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-gray-100 py-4 md:flex gap-5">
                <a
                    v-if="reportData.type != '' && reportData.report_data != ''"
                    :href="
                        ExportUrl +
                        reportData.type +
                        '/' +
                        reportData.faculty_id +
                        '/' +
                        reportData.department_id
                    "
                    :class="[
                        reportData.department_id == '' ||
                        reportData.faculty_id == ''
                            ? 'footer--button--submit cursor-not-allowed'
                            : 'footer--button--submit cursor-pointer rounded ',
                    ]"
                >
                    <span> تهیه راپور </span>
                </a>
                <button
                    class="bg-blue-400 text-white rounded-lg py-2 px-8 mr-6"
                    v-else
                >
                    تهیه راپور
                </button>
                <router-link
                    :to="{ name: 'app.research.tresearch.list' }"
                    class="footer--button--cancel"
                    >لغو ثبت</router-link
                >
            </footer>
        </form>
    </div>
</template>

<script setup>
import { computed, onMounted, ref, useSlots } from "vue";
import CustomInput from "../../components/core/CustomInput.vue";
import DatePicker from "vue3-persian-datetime-picker";
import useCommitMemberStore from "../../stores/postgraduatedPrograms/commitMember";
import useDepartmentStore from "../../stores/department/deparmentStore";
import { useFacultyStore } from "../../stores/faculties/facultyStore";

const ExportUrl = `http://localhost/ViceChancellor/public/research/report/`;

// search student accroding ot the admission year
const facultyStore = useFacultyStore();
const departmentStore = useDepartmentStore();

onMounted(() => {
    facultyStore.getAllFaculty();
});

const reportData = ref({
    type: "",
    faculty_id: "",
    department_id: "",
});

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

function getDepartment(id) {
    if (id) {
        departmentStore.getFacultyDepartment(id);
    }
}

const types = ref([
    {
        key: "all",
        text: "عمومی",
    },
    {
        key: "faculty",
        text: "پوهنحی",
    },
    {
        key: "department",
        text: "دیپارتمنت",
    },
]);
</script>
