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
                    لیست محصیلن
                </router-link>
            </div>
            <div>
                <h1 class="text--header">فورم ویرایش اطلاعات محصیلن</h1>
            </div>
        </div>

        <form @submit.prevent="onSubmit">
            <div class="w-full py-8 bg-white shadow mt-8 px-4">
                <!-- display message area -->
                <div class="msg--success" v-if="studentStore.msg_success">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="studentStore.msg_success = ''"
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
                            <span>{{ studentStore.msg_success }}</span>
                        </div>
                    </div>
                </div>

                <div class="msg--warning" v-if="studentStore.msg_wrang">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="studentStore.msg_wrang = ''"
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
                            <span>{{ studentStore.msg_wrang }}</span>
                        </div>
                    </div>
                </div>
                <!-- end of display message area -->

                <div class="mt-5">
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label class="form--label">
                                نام
                                <span class="label--prefix">*</span>
                            </label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="text"
                                v-model="student.name"
                                class="mb-2"
                                required="required"
                                label="نام"
                            />
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
                                v-model="student.lname"
                                class="mb-2"
                                required="required"
                                label="تخلص"
                            />
                        </div>
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
                            v-model="student.fname"
                            class="mb-2"
                            required="required"
                            label="نام پدر"
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
                            v-model="student.email"
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
                            v-model="student.phone"
                            class="mb-2"
                            required="required"
                            label="شماره تماس "
                        />
                    </div>
                </div>

                <!-- <div class="wrapper--dev--input">
                    <div class="w-2/12">
                        <label class="form--label"
                            >آدی کانکور
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
                                    v-model="student.gender"
                                    value="مرد"
                                />
                            </div>
                            <div class="flex items-center justify-start gap-4">
                                <b> زن</b>
                                <input
                                    type="radio"
                                    name="gander"
                                    v-model="student.gender"
                                    class="rounded-full focus:ring focus:bg-indigo-500"
                                    value="زن"
                                />
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="wrapper--dev--input">
                    <div class="w-2/12">
                        <label class="form--label">
                            آدی کانکور
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="w-6/12">
                        <CustomInput
                            type="text"
                            v-model="student.kankor_id"
                            class="mb-2"
                            required="required"
                            label="آدی کانکور"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="w-2/12">
                        <label class="form--label">
                            نمره کانکور
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="w-6/12">
                        <CustomInput
                            type="text"
                            v-model="student.kankor_mark"
                            class="mb-2"
                            required="required"
                            label="نمره کانکور "
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="w-2/12">
                        <label class="form--label">
                            ریشته تحصلی
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="w-6/12">
                        <CustomInput
                            type="text"
                            v-model="student.bachelor_field"
                            class="mb-2"
                            required="required"
                            label="ریشته تحصلی  "
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="w-2/12">
                        <label class="form--label">
                            تاریخ ثبت نام
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <DatePicker
                            v-model="student.admission_year"
                            required
                            placeholder="تاریخ را انتخاب نماید"
                        />

                        <!-- <CustomInput
                            type="date"
                            v-model="student.admission_year"
                            class="mb-2"
                            required="required"
                            label="تاریخ ثبت نام"
                        /> -->
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
                            v-model="student.nic"
                            class="mb-2"
                            required="required"
                            label="نمر تذکره"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label class="form--label">
                            گروپ خون
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="text"
                            v-model="student.blood_group"
                            class="mb-2"
                            required="required"
                            label="AB,B,A,O"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label class="form--label"
                            >آدرس
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="text"
                            v-model="student.address"
                            class="mb-2"
                            required="required"
                            label="آدرس "
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label class="form--label"
                            >برنامه ماستر
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="select"
                            :selectOptions="programs"
                            v-model="student.program_id"
                            class="mb-2"
                            required="required"
                            label="برنامه ماستری "
                        />
                    </div>
                </div>
            </div>
            <footer class="bg-gray-100 py-4 md:flex gap-5">
                <button
                    type="submit"
                    :class="[
                        studentStore.loading === true
                            ? 'footer--button--submit cursor-not-allowed'
                            : 'footer--button--submit cursor-pointer ',
                    ]"
                >
                    <span v-if="studentStore.loading === true">
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
import { computed, onMounted, ref, useSlots, watch } from "vue";
import { useRoute } from "vue-router";
import useProgramStore from "../../../stores/postgraduatedPrograms/programStore";
import CustomInput from "../../../components/core/CustomInput.vue";
import useStudentStore from "../../../stores/postgraduatedPrograms/studentStore";
import DatePicker from "vue3-persian-datetime-picker";
import router from "../../../routes";
// import DatePicker from "vue3-persian-datetime-picker";
const studentStore = useStudentStore();
const programStore = useProgramStore();
const route = useRoute();

onMounted(() => {
    programStore.getAllPrograms();
    if (route.params.id) {
        studentStore.editStudent(route.params.id);
    }
});

const student = computed(() => studentStore.student);

const program_id = ref("");
const getProgramId = () => {
    if (!localStorage.getItem("program_id")) {
        router.push({ name: "app.post_select_program" });
    }
    return localStorage.getItem("program_id");
};

const programs = computed(() =>
    programStore.listProgram.map((program) => ({
        key: program.id,
        text: program.program_name,
    }))
);

function onSubmit() {
    program_id.value = getProgramId();
    studentStore.updateStudent(student.value, program_id.value);
}

// internal code

// get just the year

// Helper function to calculate the current Persian year
</script>
