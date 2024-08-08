<template>
    <div class="form--padding--top">
        <form @submit.prevent="onSubmit">
            <div>
                <!-- display message area -->
                <div class="msg--success" v-if="resProjectStore.msg_success">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="resProjectStore.msg_success = ''"
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
                            <span>{{ resProjectStore.msg_success }}</span>
                        </div>
                    </div>
                </div>

                <div class="msg--warning" v-if="resProjectStore.msg_wrang">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="resProjectStore.msg_wrang = ''"
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
                            <span>{{ resProjectStore.msg_wrang }}</span>
                        </div>
                    </div>
                </div>
                <!-- end of display message area -->

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label for="" class="form--label">
                            نام پروژه
                            <span class="label--prefix">*</span></label
                        >
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="text"
                            v-model="resProject.project_name"
                            class="mb-2"
                            required="required"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label for="" class="form--label">
                            وسعت پروژه<span class="label--prefix"
                                >*</span
                            ></label
                        >
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="text"
                            v-model="resProject.scope_of_project"
                            class="mb-2"
                            required="required"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label for="" class="form--label">
                            تصاویر مرتبط
                            <span class="label--prefix">*</span></label
                        >
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="file"
                            @change="
                                (file) => (resProject.related_image = file)
                            "
                            class="mb-2"
                            required="required"
                        />
                    </div>
                </div>
                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label for="" class="form--label">
                            تاریخ <span class="label--prefix">*</span></label
                        >
                    </div>
                    <div class="input--dev--width">
                        <DatePicker
                            v-model="resProject.date"
                            class="mb-2"
                            required="required"
                            placeholder=" انتخاب تاریخ"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label for="" class="form--label">
                            لابراتوار
                            <span class="label--prefix">*</span></label
                        >
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="select"
                            :select-options="labs"
                            v-model="resProject.lab_id"
                            class="mb-2"
                            required="required"
                            label=" لابرتوار"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label for="" class="form--label">
                            توضیحات <span class="label--prefix"></span
                        ></label>
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="textarea"
                            v-model="resProject.description"
                            class="mb-2"
                        />
                    </div>
                </div>

                <footer class="bg-gray-100 mt-5 py-4 md:flex gap-5">
                    <button
                        type="submit"
                        :class="[
                            resProjectStore.loading === true
                                ? 'footer--button--submit cursor-not-allowed'
                                : 'footer--button--submit cursor-pointer rounded ',
                        ]"
                    >
                        <span v-if="resProjectStore.loading === true">
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
                    <button @click="closeModal" class="footer--button--cancel">
                        لغو ثبت
                    </button>
                </footer>
            </div>
        </form>
    </div>
</template>

<script setup>
import { computed, onMounted, ref, useSlots } from "vue";
import CustomInput from "../../../components/core/CustomInput.vue";
import useResProjectStore from "../../../stores/researchDepartment/resProjectStore";
import DatePicker from "vue3-persian-datetime-picker";
import useLabStore from "../../../stores/researchDepartment/labStore";

const resProjectStore = useResProjectStore();
const labStore = useLabStore();

onMounted(() => {
    labStore.getAllLabs();
});

const labs = computed(() =>
    labStore.allLabs.map((lab) => ({ key: lab.id, text: lab.lab_name }))
);

const resProject = computed(() => resProjectStore.resProject);

const props = defineProps({
    closeModal: {
        type: Function,
        required: true,
    },
});

function onSubmit() {
    resProjectStore.createResProject(resProject.value);

    // for refreshing the res project
    resProjectStore.getResProject();
}
</script>
