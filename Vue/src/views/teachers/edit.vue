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
                <h1 class="text--header">فورم ویرایش اطلاعات استادان</h1>
            </div>
        </div>

        <form @submit.prevent="onSubmit">
            <div class="wrapper--dev--form">
                <!-- display message area -->
                <div class="msg--success" v-if="teacherStore.msg_success">
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
                            <span>{{ teacherStore.msg_wrang }}</span>
                        </div>
                    </div>
                </div>
                <!-- end of display message area -->

                <div class="mt-5">
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label class="form--label"
                                >نام
                                <span class="label--prefix">*</span>
                            </label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="text"
                                v-model="teacher.name"
                                class="mb-2"
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
                    <div class="label--dev--width">
                        <label class="form--label"
                            >نام پدر
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
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
                    <div class="label--dev--width">
                        <label class="form--label"
                            >ایمل آدرس
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
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
                    <div class="label--dev--width">
                        <label class="form--label"
                            >شماره تماس
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="text"
                            v-model="teacher.phone"
                            class="mb-2"
                            required="required"
                            label="شماره تماس "
                        />
                    </div>
                </div>

                <div class="md:flex md:items-center md:justify-center">
                    <div class="w-2/12">
                        <label
                            class="block text-gray-500 md:text-left mb-1 md:mb-0"
                            >جنسیت
                            <span class="text-red-500 px-2">*</span>
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
                    <div class="label--dev--width">
                        <label class="form--label"
                            >تاریخ تولد
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="date"
                            v-model="teacher.birth_date"
                            class="mb-2"
                            required="required"
                            label=" تاریخ تولد "
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
                        <!-- <EMDatePicker v-model="teacher.hire_date" /> -->
                        <CustomInput
                            type="date"
                            v-model="teacher.hire_date"
                            class="mb-2"
                            required="required"
                            label="تاریخ استخدام"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label class="form--label"
                            >فاکولته
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="select"
                            :selectOptions="faculties"
                            v-model="teacher.faculty_id"
                            class="mb-2"
                            required="required"
                            label="فاکولته"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label class="form--label"
                            >دیپارتمنت
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
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

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label class="form--label"
                            >رتبه عملمی
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
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
                    <div class="input--dev--width">
                        <CustomInput
                            type="file"
                            @change="(file) => (teacher.photo = file)"
                            class="mb-2"
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
                            : 'footer--button--submit cursor-pointer',
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
                    <span v-else> ویرایش </span>
                </button>
                <router-link
                    :to="{ name: 'app.teacher.list' }"
                    class="footer--button--cancel"
                    >لغو ویرایش</router-link
                >
            </footer>
        </form>
    </div>
</template>

<script setup>
import { computed, onMounted, ref, useSlots } from "vue";
import { useRoute } from "vue-router";
import CustomInput from "../../components/core/CustomInput.vue";
import { useTeacherStore } from "../../stores/teachers/teacherStore";
// import { EMDatePicker } from '@cafebazaar/emrooz';
const teacherStore = useTeacherStore();
const route = useRoute();

const teacher = computed(() => teacherStore.teacher);

onMounted(() => {
    teacherStore.getFaculties();
    teacherStore.getDepartments(teacher.value.faculty_id);
    teacherStore.editTeacher(route.params.id);
});

const departments = computed(() =>
    teacherStore.departments.map((c) => ({
        key: c.department_id,
        text: c.department_name,
    }))
);
const faculties = computed(() =>
    teacherStore.faculties.map((c) => ({ key: c.faculty_id, text: c.fname }))
);

const academic_ranks = ref([
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
    let id = route.params.id;
    if (teacher.value.faculty_id != "") {
        teacherStore.updateTeacher(teacher.value, id);
        // teacher.value.name = "";
        // teacher.value.lname = "";
        // teacher.value.fatherName = "";
        // teacher.value.email = "";
        // teacher.value.phone = "";
        // teacher.value.gender = "";
        // teacher.value.birth_date = "";
        // teacher.value.main_address = "";
        // teacher.value.current_address = "";
        // teacher.value.hire_date = "";
        // teacher.value.nic = "";
        // teacher.value.photo = "";
        // teacher.value.academic_rank = "";
        // teacher.value.faculty_id = "";
        // teacher.value.department_id = "";
    }
}
</script>
