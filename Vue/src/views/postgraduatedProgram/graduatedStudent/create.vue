<template>
    <div class="w-full">
        <form @submit.prevent="onSubmit">
            <div class="w-full bg-white mt-2 px-4">
                <!-- display message area -->
                <div
                    class="msg--success"
                    v-if="graduatedStudentStore.msg_success"
                >
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="graduatedStudentStore.msg_success = ''"
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
                            <span>{{ graduatedStudentStore.msg_success }}</span>
                        </div>
                    </div>
                </div>

                <div
                    class="msg--warning"
                    v-if="graduatedStudentStore.msg_wrang"
                >
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="graduatedStudentStore.msg_wrang = ''"
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
                            <span>{{ graduatedStudentStore.msg_wrang }}</span>
                        </div>
                    </div>
                </div>
                <!-- end of display message area -->

                <div>
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label class="form--label w-full">
                                {{ student.name }} {{ student.lname }}
                            </label>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label class="form--label">
                                فصدی کلی
                                <span class="label--prefix">*</span>
                            </label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="text"
                                v-model="graduatedStudent.percentage"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label class="form--label"
                                >آدی دیپلوم
                                <span class="label--prefix">*</span>
                            </label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="text"
                                v-model="graduatedStudent.diploma_id"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label class="form--label">
                            نمره تیزیس
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="text"
                            v-model="graduatedStudent.thesis_mark"
                            class="mb-2"
                            required="required"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="w-2/12">
                        <label class="form--label">
                            استاد رهنمایی تیزیس
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="w-6/12">
                        <CustomInput
                            type="text"
                            v-model="graduatedStudent.thesis_guide_teacher"
                            class="mb-2"
                            required="required"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="w-2/12">
                        <label class="form--label"
                            >خوصیات
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="w-6/12">
                        <CustomInput
                            type="textarea"
                            v-model="graduatedStudent.attribute"
                            class="mb-2"
                            required="required"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="w-2/12">
                        <label class="form--label">
                            سال فراغت
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <select
                            class="block rounded-lg shadow w-full px-3 py-2.5 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            v-model="selectYear"
                            @change="getStudent(null)"
                        >
                            <option
                                value=""
                                selected
                                class="flex items-center text-end justify-between"
                            >
                                {{ selectedYear }}
                                ه,ش
                            </option>
                            <option
                                class="flex items-center justify-between text-end"
                                v-for="year in years"
                                :key="year"
                                :value="year"
                            >
                                {{ year }} ه,ش
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <footer class="bg-gray-100 mt-4 py-4 md:flex gap-5">
                <button
                    type="submit"
                    :class="[
                        graduatedStudentStore.loading === true
                            ? 'footer--button--submit cursor-not-allowed'
                            : 'footer--button--submit cursor-pointer ',
                    ]"
                >
                    <span v-if="graduatedStudentStore.loading === true">
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
                    :to="{ name: 'app.post-graduated.student.list' }"
                    class="footer--button--cancel cursor-pointer"
                    >لغو ثبت</router-link
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
import DatePicker from "vue3-persian-datetime-picker";
import useGraduatedStudent from "../../../stores/postgraduatedPrograms/graudatedStudent";
import router from "../../../routes";
import useDateStore from "../../../stores/dateStore";
import useStudentStore from "../../../stores/postgraduatedPrograms/studentStore";
// import DatePicker from "vue3-persian-datetime-picker";
const graduatedStudentStore = useGraduatedStudent();
const studentStore = useStudentStore();

const route = useRoute();
const graduatedStudent = computed(() => graduatedStudentStore.graduatedStudent);

function onSubmit() {
    graduatedStudentStore.createGraduatedStudent(graduatedStudent.value);
}

const dateStore = useDateStore();
const years = computed(() => dateStore.years);
const selectedYear = computed(() => dateStore.selectedYear);
let selectYear = ref("");

// internal code

const props = defineProps({
    student_id: {
        type: String,
        required: true,
    },
});

onMounted(() => {
    studentStore.editStudent(props.student_id);
});

const student = computed(() => studentStore.student);

// get just the year

// Helper function to calculate the current Persian year
</script>
