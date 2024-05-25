<template>
    <div class="form--padding--top">
        <div class="flex items-center justify-between w-full">
            <div>
                <router-link
                    :to="{ name: 'app.pdc.teacher_in_scholarship.list' }"
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
                    لیست استادان در بورسیه
                </router-link>
            </div>
            <div>
                <h1 class="text--header">
                    فورم ویرایش اطلاعات استادان شامل بورسیه
                </h1>
            </div>
        </div>

        <form @submit.prevent="onSubmit">
            <div class="wrapper--dev--form">
                <!-- display message area -->
                <div
                    class="msg--success"
                    v-if="teacherInScholarshipStore.msg_success"
                >
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="
                                    teacherInScholarshipStore.msg_success = ''
                                "
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
                                teacherInScholarshipStore.msg_success
                            }}</span>
                        </div>
                    </div>
                </div>

                <div
                    class="msg--wrang"
                    v-if="teacherInScholarshipStore.msg_wrang"
                >
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="
                                    teacherInScholarshipStore.msg_wrang = ''
                                "
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
                                teacherInScholarshipStore.msg_wrang
                            }}</span>
                        </div>
                    </div>
                </div>
                <!-- end of display message area -->

                <div class="mt-5">
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label class="form--label"
                                >کشور
                                <span class="label--prefix">*</span>
                            </label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="text"
                                v-model="teacherInScholarship.country_name"
                                class="mb-2"
                                required="required"
                                label="کشور"
                            />
                        </div>
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label class="form--label"
                            >ریشته تحصیلی
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="text"
                            v-model="teacherInScholarship.edu_degree"
                            class="mb-2"
                            required="required"
                            label="ریشته تحصیلی"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="w-2/12">
                        <label class="form--label">
                            مقطع تحصیلی
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="w-6/12">
                        <CustomInput
                            type="text"
                            v-model="teacherInScholarship.edu_maqta"
                            class="mb-2"
                            required="required"
                            label="مقطع تحصیلی"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="w-2/12">
                        <label class="form--label">
                            تاریخ رفت
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="w-6/12">
                        <CustomInput
                            type="date"
                            v-model="teacherInScholarship.sent_date"
                            class="mb-2"
                            required="required"
                            label="تاریح رفت "
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="w-2/12">
                        <label class="form--label"
                            >تاریخ برگشت
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="w-6/12">
                        <CustomInput
                            type="date"
                            v-model="teacherInScholarship.back_date"
                            class="mb-2"
                            required="required"
                            label="تاریخ برگشت"
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
                            @change="
                                getFaculty(teacherInScholarship.faculty_id)
                            "
                            :selectOptions="faculties"
                            v-model="teacherInScholarship.faculty_id"
                            class="mb-2"
                            required="required"
                            label="فاکولته"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label class="form--label"
                            >استادان
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="select"
                            :selectOptions="teachers"
                            v-model="teacherInScholarship.teacher_id"
                            class="mb-2"
                            required="required"
                            label=" استاد"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
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
                            v-model="teacherInScholarship.department_id"
                            class="mb-2"
                            required="required"
                            label="دیپارتمنت"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label class="form--label"
                            >آپلود اسناد
                            <span class="label--prefix"></span>
                        </label>
                    </div>
                    <div class="w-6/12">
                        <CustomInput
                            type="file"
                            @change="
                                (file) => (teacherInScholarship.document = file)
                            "
                            class="mb-2"
                            label=" اسناد"
                        />
                    </div>
                </div>
            </div>
            <footer class="bg-gray-100 py-4 md:flex gap-5">
                <button
                    type="submit"
                    :class="[
                        teacherInScholarshipStore.loading === true
                            ? 'footer--button--submit cursor-not-allowed'
                            : 'footer--button--submit cursor-pointer ',
                    ]"
                >
                    <span v-if="teacherInScholarshipStore.loading === true">
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
                    class="footer--button--cancel cursor-pointer"
                    >لغو ویرایش</router-link
                >
            </footer>
        </form>
    </div>
</template>

<script setup>
import { computed, onMounted, ref, useSlots } from "vue";
import { useRoute } from "vue-router";
import CustomInput from "../../../components/core/CustomInput.vue";
import { useTeacherStore } from "../../../stores/teachers/teacherStore";
import useTeacherInScholarship from "../../../stores/pdc/teacher_in_scholarship/teacherInScholarshipStore";
import useTeacherInCommit from "../../../stores/pdc/teacherInCommit/teacherInCommitStore";

// import DatePicker from "vue3-persian-datetime-picker";
const teacherStore = useTeacherStore();
const teacherInScholarshipStore = useTeacherInScholarship();
const teacherInCommitStore = useTeacherInCommit();
const route = useRoute();
const teacherInScholarship = computed(
    () => teacherInScholarshipStore.teacherInScholarship
);

onMounted(() => {
    teacherInCommitStore.getTeachers();
    teacherInScholarshipStore.editTeacherInScholarship(route.params.id);
    teacherStore.getFaculties();
    teacherStore.getDepartments(route.params.f_id);
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

const teachers = computed(() =>
    teacherInCommitStore.teachers.map((c) => ({
        key: c.id,
        text: c.name + " " + c.lname,
    }))
);

// function getFaculty(id) {
//     teacherStore.getDepartments(id);
// }

function onSubmit() {
    teacherInScholarshipStore.updateTeacherInScholarship(
        teacherInScholarship.value
    );
}
</script>
