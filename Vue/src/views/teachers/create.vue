<template>
    <div class="form--padding--top">
        <div class="flex items-center justify-between w-full">
            <div>
                <router-link
                    :to="{ name: 'app.teacher.list' }"
                    class="header--button"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-6 h-6"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z"
                        />
                    </svg>
                    لیست استادان
                </router-link>
            </div>
            <div>
                <h1 class="text--header">فورم ثبت اطلاعات استادان</h1>
            </div>
        </div>

        <form @submit.prevent="onSubmit">
            <div class="w-full py-8 bg-white shadow mt-8 px-4">
                <!-- display message area -->
                <Message
                    :msg_success="teacherStore.msg_success"
                    :msg_wrang="teacherStore.msg_wrang"
                />
                <!-- <div class="msg--success" v-if="teacherStore.msg_success">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="teacherStore.msg_success = ''"
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
                            <div
                                class="bg-white absolute left-4 top-4 flex items-center justify-center w-10 h-10 rounded-full"
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
                            <span>{{ teacherStore.msg_success }}</span>
                        </div>
                    </div>
                </div>

                <div class="msg--warning" v-if="teacherStore.msg_wrang">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="teacherStore.msg_wrang = ''"
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
                            <div
                                class="bg-white absolute left-4 top-4 flex items-center justify-center w-10 h-10 rounded-full"
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
                            <span>{{ teacherStore.msg_wrang }}</span>
                        </div>
                    </div>
                </div> -->
                <!-- end of display message area -->
                <!-- steper  -->
                <div class="w-full flex items-center justify-center">
                    <Steper
                        :step-one="teacherStore.stepOne"
                        :step-two="teacherStore.stepTwo"
                        :step-three="teacherStore.stepThree"
                    />
                </div>
                <div class="mt-5">
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label class="form--label" for="code_bast"
                                >کود بست
                                <span class="label--prefix">*</span>
                            </label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="text"
                                v-model="teacher.code_bast"
                                class="mb-2"
                                name="code_bast"
                                id="code_bast"
                                required="required"
                                label="کود بست "
                            />
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label class="form--label" for="name"
                                >نام
                                <span class="label--prefix">*</span>
                            </label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="text"
                                v-model="teacher.name"
                                class="mb-2"
                                id="name"
                                name="name"
                                required="required"
                                label="نام"
                            />
                        </div>
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label class="form--label"
                            >تخلص
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="text"
                            v-model="teacher.lname"
                            class="mb-2"
                            required="required"
                            label="تخلص"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="w-2/12">
                        <label class="form--label"
                            >نام پدر
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="w-6/12">
                        <CustomInput
                            type="text"
                            v-model="teacher.fatherName"
                            class="mb-2"
                            required="required"
                            label="نام پدر"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="w-2/12">
                        <label class="form--label"
                            >نام پدر کلان
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="w-6/12">
                        <CustomInput
                            type="text"
                            v-model="teacher.grandFathername"
                            class="mb-2"
                            required="required"
                            label=" نام پدر کلان"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="w-2/12">
                        <label class="form--label"
                            >ایمل آدرس
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="w-6/12">
                        <CustomInput
                            type="text"
                            v-model="teacher.email"
                            class="mb-2"
                            required="required"
                            label="ایمل آدرس"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="w-2/12">
                        <label class="form--label"
                            >شماره تماس
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="w-6/12">
                        <CustomInput
                            type="text"
                            v-model="teacher.phone"
                            class="mb-2"
                            required="required"
                            label="شماره تماس "
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="w-2/12">
                        <label class="form--label"
                            >جنسیت
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="w-6/12 mb-2">
                        <div class="flex items-center justify-start gap-7">
                            <div class="flex items-center justify-start gap-4">
                                <b> مرد</b>
                                <input
                                    type="radio"
                                    name="gander"
                                    checked
                                    class="rounded-full focus:ring focus:bg-indigo-500"
                                    v-model="teacher.gender"
                                    value="مرد"
                                />
                            </div>
                            <div class="flex items-center justify-start gap-4">
                                <b> زن</b>
                                <input
                                    type="radio"
                                    name="gander"
                                    v-model="teacher.gender"
                                    class="rounded-full focus:ring focus:bg-indigo-500"
                                    value="زن"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="w-2/12">
                        <label class="form--label"
                            >تاریخ تولد
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <DatePicker
                            v-model="teacher.birth_date"
                            class="mb-2"
                            required="required"
                            placeholder="تاریخ تولد"
                        />
                    </div>
                </div>
                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label class="form--label"
                            >نمبر تذکره
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="text"
                            v-model="teacher.nic"
                            class="mb-2"
                            required="required"
                            label="نمر تذکره"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label class="form--label"
                            >ریشته تحصلی
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="text"
                            v-model="teacher.education_field"
                            class="mb-2"
                            required="required"
                            label=" ریشته تحصلی"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label class="form--label"
                            >آدرس اصلی
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="text"
                            v-model="teacher.main_address"
                            class="mb-2"
                            required="required"
                            label="آدرس اصلی"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label class="form--label"
                            >آدرس فعلی
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="text"
                            v-model="teacher.current_address"
                            class="mb-2"
                            required="required"
                            label="آدرس فعلی"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label class="form--label"
                            >تاریخ استخدام
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <DatePicker
                            v-model="teacher.hire_date"
                            class="mb-2"
                            :local="DariLocalConfig"
                            format="YYYY-MM-DD"
                            required="required"
                            placeholder="تاریخ استخدام"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="w-2/12">
                        <label class="form--label"
                            >شیفت تدریس
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="w-6/12">
                        <CustomInput
                            type="select"
                            :selectOptions="teaching_status"
                            v-model="teacher.teaching_status"
                            class="mb-2"
                            required="required"
                            label=" شیفت"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="w-2/12">
                        <label class="form--label"
                            >بخش مربوطه
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="w-6/12">
                        <CustomInput
                            type="select"
                            :selectOptions="parts"
                            v-model="teacher.related_part"
                            class="mb-2"
                            required="required"
                            label=" بخش"
                        />
                    </div>
                </div>

                <div
                    class="wrapper--dev--input"
                    v-if="
                        (teacher.teaching_status == 'post-graduated' &&
                            teacher.related_part == 'faculty') ||
                        (teacher.teaching_status == 'both' &&
                            teacher.related_part == 'faculty') ||
                        (teacher.teaching_status == 'both' &&
                            teacher.related_part == 'common_department') ||
                        (teacher.teaching_status == 'post-graduated' &&
                            teacher.related_part == 'common_department')
                    "
                >
                    <div class="label--dev--width">
                        <label class="form--label"
                            >برنامه های فوق لیسانس
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="select"
                            :selectOptions="programs"
                            v-model="teacher.program_id"
                            class="mb-2"
                            required="required"
                            label=" برنامه"
                        />
                    </div>
                </div>

                <div
                    class="wrapper--dev--input"
                    v-if="
                        (teacher.teaching_status == 'bachelor' &&
                            teacher.related_part == 'faculty') ||
                        (teacher.teaching_status == 'both' &&
                            teacher.related_part == 'faculty') ||
                        (teacher.teaching_status == 'post-graduated' &&
                            teacher.related_part == 'faculty')
                    "
                >
                    <div class="label--dev--width">
                        <label class="form--label"
                            >فاکولته
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="select"
                            @change="getFaculty(teacher.faculty_id)"
                            :selectOptions="faculties"
                            v-model="teacher.faculty_id"
                            class="mb-2"
                            required="required"
                            label="فاکولته"
                        />
                    </div>
                </div>

                <div
                    class="wrapper--dev--input"
                    v-if="
                        ((teacher.teaching_status == 'bachelor' &&
                            teacher.related_part == 'faculty') ||
                            (teacher.teaching_status == 'both' &&
                                teacher.related_part == 'faculty')) &&
                        departments.length != ''
                    "
                >
                    <div class="w-2/12">
                        <label class="form--label"
                            >دیپارتمنت
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="w-6/12">
                        <CustomInput
                            type="select"
                            :selectOptions="departments"
                            v-model="teacher.department_id"
                            class="mb-2"
                            required="required"
                            label="دیپارتمنت"
                        />
                    </div>
                </div>

                <div
                    class="wrapper--dev--input"
                    v-if="
                        (teacher.teaching_status == 'bachelor' &&
                            teacher.related_part == 'common_department') ||
                        (teacher.teaching_status == 'both' &&
                            teacher.related_part == 'common_department') ||
                        (teacher.teaching_status == 'post-graduated' &&
                            teacher.related_part == 'common_department')
                    "
                >
                    <div class="w-2/12">
                        <label class="form--label"
                            >دیپارتمنت های عمومی
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="w-6/12">
                        <CustomInput
                            type="select"
                            :selectOptions="department_out_of_has_faculty"
                            v-model="teacher.department_id"
                            class="mb-2"
                            required="required"
                            label=" دیپارتمنت"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label class="form--label"
                            >رتبه عملمی
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="w-6/12">
                        <CustomInput
                            type="select"
                            :selectOptions="academic_ranks"
                            v-model="teacher.academic_rank"
                            class="mb-2"
                            required="required"
                            label="رتبه عملمی"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label class="form--label"
                            >فوتو
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="w-6/12">
                        <CustomInput
                            type="file"
                            @change="(file) => (teacher.photo = file)"
                            class="mb-2"
                            required="required"
                            label="فوتو"
                        />
                    </div>
                </div>
            </div>
            <footer class="bg-gray-100 py-4 md:flex gap-5">
                <button
                    type="submit"
                    :class="[
                        teacherStore.loading === true
                            ? 'footer--button--submit cursor-not-allowed'
                            : 'footer--button--submit cursor-pointer ',
                    ]"
                >
                    <span v-if="teacherStore.loading === true">
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
                    <span v-else> بعدی </span>
                </button>
                <router-link
                    :to="{ name: 'app.dashboard' }"
                    class="footer--button--cancel cursor-pointer"
                    >لغو ثبت</router-link
                >
            </footer>
        </form>
    </div>
</template>

<script setup>
import { computed, onMounted, ref, useSlots } from "vue";
import { useRoute } from "vue-router";
import Steper from "../../components/steps.vue";
import CustomInput from "../../components/core/CustomInput.vue";
import Message from "../../components/Message.vue";
import { useTeacherStore } from "../../stores/teachers/teacherStore";
import DatePicker from "vue3-persian-datetime-picker";
import { useFacultyStore } from "../../stores/faculties/facultyStore";
import useProgramStore from "../../stores/postgraduatedPrograms/programStore";
import useDepartmentStore from "../../stores/department/deparmentStore";
// import DatePicker from "vue3-persian-datetime-picker";
import DariLocalConfig from "../../stores/Dari";
const teacherStore = useTeacherStore();
const facultyStore = useFacultyStore();
const programStore = useProgramStore();
const departmetStore = useDepartmentStore();

const route = useRoute();
const teacher = computed(() => teacherStore.teacher);
const programs = computed(() =>
    programStore.listProgram.map((program) => ({
        key: program.id,
        text: program.program_name + " | " + program.degree_type,
    }))
);

onMounted(() => {
    facultyStore.getAllFaculty();
    programStore.getAllPrograms();
    if (
        teacher.value.faculty_id != "" &&
        teacher.related_part.value == "faculty"
    ) {
        teacherStore.getDepartments(teacher.value.faculty_id);
    } else {
        departmetStore.departmentHasOutFaculties();
    }
});

const departments = computed(() =>
    teacherStore.departments.map((c) => ({
        key: c.id,
        text: c.name,
    }))
);
const faculties = computed(() =>
    facultyStore.listFaculty.map((c) => ({ key: c.id, text: c.name }))
);

const department_out_of_has_faculty = computed(() =>
    departmetStore.department_has_out_facilities.map((c) => ({
        key: c.id,
        text: c.name,
    }))
);

// teaching status
const teaching_status = ref([
    {
        key: "bachelor",
        text: "تنها در دوره لیسانس تدریس می کند",
    },

    {
        key: "both",
        text: " در هر دو برنامه تدریس می کند",
    },
    {
        key: "post-graduated",
        text: "تنها در برنامه های فوق لیسانس تدریس می کند",
    },
]);

// part common department or faculties that has department

const parts = [
    {
        key: "faculty",
        text: "فاکولته ",
    },

    {
        key: "common_department",
        text: " دیپارتمنت های عمومی",
    },
];

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

function getFaculty(id) {
    teacherStore.getDepartments(id);
}

function onSubmit() {
    // let id = route.params.id;
    teacherStore.createTeacher(teacher.value);
}
</script>
