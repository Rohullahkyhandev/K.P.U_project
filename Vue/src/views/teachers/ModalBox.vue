<template>
    <TransitionRoot appear :show="props.isProOpen" as="template">
        <Dialog as="div" @close="props.closeProModal" class="relative z-10">
            <TransitionChild
                as="template"
                enter="duration-300 ease-out"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="duration-200 ease-in"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-black/25" />
            </TransitionChild>

            <div class="fixed inset-0 overflow-y-auto">
                <div
                    class="flex min-h-full items-center justify-center p-4 text-center"
                >
                    <TransitionChild
                        as="template"
                        enter="duration-300 ease-out"
                        enter-from="opacity-0 scale-95"
                        enter-to="opacity-100 scale-100"
                        leave="duration-200 ease-in"
                        leave-from="opacity-100 scale-100"
                        leave-to="opacity-0 scale-95"
                    >
                        <DialogPanel
                            class="w-full max-w-3xl transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                        >
                            <DialogTitle
                                as="h3"
                                class="text-lg mr-5 font-bold text-2xl text-end leading-6 text-gray-900"
                            >
                                فورم ثبت ترفیع
                            </DialogTitle>
                            <div class="mt-2" dir="rtl">
                                <form @submit.prevent="onSubmit">
                                    <div class="py-6 px-6">
                                        <!-- display message area -->
                                        <div
                                            class="msg--success"
                                            v-if="teacherStore.msg_psuccess"
                                        >
                                            <div
                                                class="flex items-center justify-between px-10"
                                            >
                                                <div
                                                    class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        @click="
                                                            teacherStore.msg_psuccess =
                                                                ''
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
                                                        teacherStore.msg_psuccess
                                                    }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="msg--warning"
                                            v-if="teacherStore.msg_pwrang"
                                        >
                                            <div
                                                class="flex items-center justify-between px-10"
                                            >
                                                <div
                                                    class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                                                >
                                                    <svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        @click="
                                                            teacherStore.msg_pwrang =
                                                                ''
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
                                                        teacherStore.msg_pwrang
                                                    }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end of display message area -->

                                        <div>
                                            <div class="wrapper--dev--input">
                                                <div class="label--dev--width">
                                                    <label
                                                        for=""
                                                        class="form--label"
                                                    >
                                                        رتبه قبلی<span
                                                            class="label--prefix"
                                                            >*</span
                                                        ></label
                                                    >
                                                </div>
                                                <div class="input--dev--width">
                                                    <CustomInput
                                                        type="select"
                                                        :select-options="
                                                            academic_ranks
                                                        "
                                                        v-model="
                                                            promotion.last_academic_rank
                                                        "
                                                        class="mb-2"
                                                        required="required"
                                                        label=" رتبه علمی"
                                                    />
                                                </div>
                                            </div>

                                            <div class="wrapper--dev--input">
                                                <div class="label--dev--width">
                                                    <label
                                                        for=""
                                                        class="form--label"
                                                    >
                                                        رتبه علمی فعلی<span
                                                            class="label--prefix"
                                                            >*</span
                                                        ></label
                                                    >
                                                </div>
                                                <div class="input--dev--width">
                                                    <CustomInput
                                                        type="select"
                                                        :select-options="
                                                            academic_ranks
                                                        "
                                                        v-model="
                                                            promotion.now_academic_rank
                                                        "
                                                        class="mb-2"
                                                        required="required"
                                                        label=" رتبه علمی"
                                                    />
                                                </div>
                                            </div>

                                            <div class="wrapper--dev--input">
                                                <div class="label--dev--width">
                                                    <label
                                                        for=""
                                                        class="form--label"
                                                        >تاریخ
                                                        <span
                                                            class="label--prefix"
                                                            >*</span
                                                        ></label
                                                    >
                                                </div>
                                                <div class="input--dev--width">
                                                    <DatePicker
                                                        v-model="promotion.date"
                                                        class="mb-2"
                                                        placeholder=" تاریخ ترفیع"
                                                        required="required"
                                                    />
                                                </div>
                                            </div>

                                            <div class="wrapper--dev--input">
                                                <div class="label--dev--width">
                                                    <label
                                                        for=""
                                                        class="form--label"
                                                    >
                                                        آپلود فایل<span
                                                            class="label--prefix"
                                                            >*</span
                                                        ></label
                                                    >
                                                </div>
                                                <div class="input--dev--width">
                                                    <!-- <CustomInput
                                                        type="file"
                                                        @change="
                                                            (file) =>
                                                                (promotion.attachment =
                                                                    file)
                                                        "
                                                        class="mb-2"
                                                        required="required"
                                                    /> -->
                                                    <label
                                                        for="link"
                                                        class="w-full flex items-center flex-col justify-center py-4 cursor-pointer transition-all duration-75 hover:bg-green-300 border border-dashed border-blue-400"
                                                    >
                                                        <span
                                                            class="mb-2 font-semibold"
                                                            >برای آپلود فایل
                                                            کلیک نماید</span
                                                        >
                                                        <svg
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            fill="none"
                                                            viewBox="0 0 24 24"
                                                            stroke-width="1.5"
                                                            stroke="currentColor"
                                                            class="size-5"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"
                                                            />
                                                        </svg>

                                                        <span
                                                            v-if="
                                                                files_length !=
                                                                null
                                                            "
                                                        >
                                                            تعداد فایل ها
                                                            {{ files_length }}
                                                        </span>
                                                    </label>

                                                    <input
                                                        id="link"
                                                        type="file"
                                                        multiple
                                                        hidden
                                                        @change="handleOnChange"
                                                        class="mb-2"
                                                        required="required"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <footer
                                        class="bg-gray-100 py-4 md:flex gap-5"
                                    >
                                        <button
                                            type="submit"
                                            :class="[
                                                teacherStore.loading === true
                                                    ? 'footer--button--submit cursor-not-allowed'
                                                    : 'footer--button--submit cursor-pointer rounded ',
                                            ]"
                                        >
                                            <span
                                                v-if="
                                                    teacherStore.loading ===
                                                    true
                                                "
                                            >
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
                                            @click="closeProModal"
                                            class="footer--button--cancel"
                                            >لغو ثبت</span
                                        >
                                    </footer>
                                </form>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
    Switch,
} from "@headlessui/vue";
import CustomInput from "../../components/core/CustomInput.vue";
import { computed, ref } from "vue";
import { useTeacherStore } from "../../stores/teachers/teacherStore";
import DatePicker from "vue3-persian-datetime-picker";
const teacherStore = useTeacherStore();

const promotion = computed(() => teacherStore.promotion);

const teacher_id = ref("");

const props = defineProps({
    teacher_id: {
        type: String,
        required: true,
        default: "",
    },
    isProOpen: {
        type: Boolean,
        required: true,
        default: false,
    },
    openProModal: {
        type: Function,
        required: true,
        default: () => {
            console.log("clicked on the toggle button");
        },
    },
    closeProModal: {
        type: Function,
        required: true,
        default: (id) => {},
    },
});

const files_length = ref();
function handleOnChange(event) {
    if (event) {
        promotion.value.attachment = event.target.files;
        files_length.value = promotion.value.attachment.length;
    }
}

function onSubmit() {
    teacherStore.createPromotion(promotion.value, props.teacher_id);
    teacherStore.getPromotions();
}

const academic_ranks = ref([
    {
        text: "نامزاد پوهنیار",
        key: "نامزاد پوهنیار",
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
</script>
