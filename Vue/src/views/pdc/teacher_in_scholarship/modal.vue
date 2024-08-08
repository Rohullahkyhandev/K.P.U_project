<template>
    <div class="form--padding--top">
        <form @submit.prevent="onSubmit">
            <div class="py-10">
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
                <div class="wrapper--dev--input">
                    <div class="w-2/12">
                        <label class="form--label"
                            >تاریخ برگشت
                            <span class="label--prefix">*</span>
                        </label>
                    </div>
                    <div class="w-6/12">
                        <DatePicker
                            v-model="data.back_date"
                            class="mb-2"
                            required="required"
                            placeholder="تاریخ برگشت"
                        />
                    </div>
                </div>
            </div>
            <footer class="bg-gray-100 py-4 mt-4 md:flex gap-5">
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
                <button
                    @click="closeModal"
                    class="footer--button--cancel cursor-pointer"
                >
                    لغو ویرایش
                </button>
            </footer>
        </form>
    </div>
</template>

<script setup>
import { computed, onMounted, ref, useSlots } from "vue";
import DatePicker from "vue3-persian-datetime-picker";
import CustomInput from "../../../components/core/CustomInput.vue";
import useTeacherInScholarship from "../../../stores/pdc/teacher_in_scholarship/teacherInScholarshipStore";

const teacherInScholarshipStore = useTeacherInScholarship();

const props = defineProps({
    closeModal: {
        type: Function,
        required: true,
    },
    id: {
        type: String,
        required: true,
    },
});
const data = ref({
    id: props.id,
    back_date: "",
});

function onSubmit() {
    teacherInScholarshipStore.updateTeacherinfo(data.value);
    teacherInScholarshipStore.getTeacherInScholarship();
}
</script>
