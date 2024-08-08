<template>
    <div class="form--padding--top">
        <div class="flex items-center justify-between w-full">
            <div>
                <router-link
                    :to="{ name: 'app.post-graduated.student.list' }"
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
                    لیست تحقیقات محصیلن
                </router-link>
            </div>
            <div>
                <h1 class="text--header">فورم ثبت تحقیقات محصیلن</h1>
            </div>
        </div>

        <form @submit.prevent="onSubmit">
            <div class="w-full py-8 bg-white shadow mt-8 px-4">
                <!-- display message area -->
                <div
                    class="msg--success"
                    v-if="studentResearchStore.msg_success"
                >
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="studentResearchStore.msg_success = ''"
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
                            <span>{{ studentResearchStore.msg_success }}</span>
                        </div>
                    </div>
                </div>

                <div class="msg--warning" v-if="studentResearchStore.msg_wrang">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="studentResearchStore.msg_wrang = ''"
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
                            <span>{{ studentResearchStore.msg_wrang }}</span>
                        </div>
                    </div>
                </div>
                <!-- end of display message area -->

                <div class="mt-5">
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label class="form--label">
                                عنوان تحقیق
                                <span class="label--prefix">*</span>
                            </label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="text"
                                v-model="studentResearch.title"
                                class="mb-2"
                                required="required"
                                label="عنوان تحقیق"
                            />
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label class="form--label"
                                >تاریخ تحقیق
                                <span class="label--prefix">*</span>
                            </label>
                        </div>
                        <div class="input--dev--width">
                            <DatePicker
                                v-model="studentResearch.date"
                                class="mb-2"
                                required="required"
                                placeholder="تاریخ تحقیق"
                            />
                        </div>
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label class="form--label"
                            >برنامه ها
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="select"
                            @change="getTeachers(studentResearch.program_id)"
                            :selectOptions="programs"
                            v-model="studentResearch.program_id"
                            class="mb-2"
                            required="required"
                            label="برنامه  "
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label class="form--label"
                            >استاد رهنما
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="select"
                            :select-options="teachers"
                            v-model="studentResearch.teacher_id"
                            class="mb-2"
                            required="required"
                            label="استاد رهنما"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label class="form--label">
                            اسناد مربوط به تحقیق
                            <span class="label--prefix"></span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="file"
                            @change="
                                (file) => {
                                    studentResearch.attachment = file;
                                }
                            "
                            class="mb-2"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label class="form--label">
                            توضیحات
                            <span class="label--prefix"></span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="textarea"
                            v-model="studentResearch.description"
                            class="mb-2"
                            label="توضیحات"
                        />
                    </div>
                </div>
            </div>
            <footer class="bg-gray-100 py-4 md:flex gap-5">
                <button
                    type="submit"
                    :class="[
                        studentResearchStore.loading === true
                            ? 'footer--button--submit cursor-not-allowed'
                            : 'footer--button--submit cursor-pointer ',
                    ]"
                >
                    <span v-if="studentResearchStore.loading === true">
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
                <span
                    :to="{ name: 'app.post-graduated.student.list' }"
                    class="footer--button--cancel cursor-pointer"
                    >لغو ثبت</span
                >
            </footer>
        </form>
    </div>
</template>

<script setup>
import { computed, onMounted, ref, useSlots, watch } from "vue";
import { useRoute } from "vue-router";
import useProgramStore from "../../../stores/postgraduatedPrograms/programStore";
import CustomInput from "../../../components/core/CustomInput.vue";
import useStudentResearch from "../../../stores/postgraduatedPrograms/studentResearch";
import DatePicker from "vue3-persian-datetime-picker";

import router from "../../../routes";
// import DatePicker from "vue3-persian-datetime-picker";
const studentResearchStore = useStudentResearch();
const programStore = useProgramStore();

const route = useRoute();
const studentResearch = computed(() => studentResearchStore.studentResearch);

onMounted(() => {
    programStore.getAllPrograms();
});



const programs = computed(() =>
    programStore.listProgram.map((program) => ({
        key: program.id,
        text: program.program_name,
    }))
);

const teachers = computed(() =>
    studentResearchStore.teachers.map((teacher) => ({
        key: teacher.id,
        text: teacher.name + " " + teacher.lname,
    }))
);

function getTeachers(program_id) {
    studentResearchStore.getTeachers(program_id);
}

function onSubmit() {
    let id = route.params.id;
    studentResearchStore.createStudentResearch(studentResearch.value, id);
    setTimeout(() => {
        studentResearchStore.getStudentResearch();
    }, 1000);
}
</script>
