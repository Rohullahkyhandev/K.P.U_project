<template>
    <div class="w-full">
        <form @submit.prevent="onSubmit">
            <div class="w-full">
                <!-- display message area -->
                <div class="msg--success" v-if="archiveStore.msg_success">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="archiveStore.msg_success = ''"
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
                            <span>{{ archiveStore.msg_success }}</span>
                        </div>
                    </div>
                </div>

                <div class="msg--warning" v-if="archiveStore.msg_wrang">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="archiveStore.msg_wrang = ''"
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
                            <span>{{ archiveStore.msg_wrang }}</span>
                        </div>
                    </div>
                </div>
                <!-- end of display message area -->
                <div class="mt-5">
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label"
                                >نوع اطلاعات<span class="label--prefix"
                                    >*</span
                                ></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="select"
                                v-model="archive.type"
                                :select-options="data_type"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label"
                                >تاریخ<span class="label--prefix"
                                    >*</span
                                ></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <DatePicker
                                type="date"
                                v-model="archive.date"
                                class="mb-2"
                                required="required"
                                placeholder=" انتخاب تاریخ"
                            />
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label"
                                >فایل<span class="label--prefix">*</span></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="file"
                                class="mb-2"
                                @change="(file) => (archive.attachment = file)"
                                required="required"
                            />
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label"
                                >خلاصه مطلب<span class="label--prefix"></span
                            ></label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="textarea"
                                v-model="archive.description"
                                class="mb-2"
                            />
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-gray-100 py-4 mt-8 md:flex gap-5">
                <button
                    type="submit"
                    :class="[
                        archiveStore.loading === true
                            ? 'footer--button--submit cursor-not-allowed '
                            : 'footer--button--submit cursor-pointer',
                    ]"
                >
                    <span v-if="archiveStore.loading === true">
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
                <span @click="inputClear" class="footer--button--cancel"
                    >لغو ثبت</span
                >
            </footer>
        </form>
    </div>
</template>

<script setup>
import { computed, ref, useSlots } from "vue";
import DatePicker from "vue3-persian-datetime-picker";
import CustomInput from "../../components/core/CustomInput.vue";
import useQualityStore from "../../stores/quality_archive/qualityArchiveStore";

const archiveStore = useQualityStore();

const archive = computed(() => archiveStore.archive);
const data_type = ref([
    { key: "plan", text: "پلان ها کاری" },
    { key: "gaols", text: "اهداف" },
    { key: "job_roles", text: "لاحیه وظایف" },
]);

function inputClear() {
    if (!confirm("آیا شما می خواهید دیتا فورم را خالی نماید؟")) {
        return;
    }

    archive.value.date = "";
    archive.value.type = "";
    archive.value.attachment = "";
    archive.value.description = "";
}

function onSubmit() {
    archiveStore.createArchive(archive.value);
}
</script>
