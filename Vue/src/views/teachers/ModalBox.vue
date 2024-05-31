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
                                                        type="text"
                                                        v-model="
                                                            promotion.last_academic_rank
                                                        "
                                                        class="mb-2"
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
                                                        رتبه علمی فعلی<span
                                                            class="label--prefix"
                                                            >*</span
                                                        ></label
                                                    >
                                                </div>
                                                <div class="input--dev--width">
                                                    <CustomInput
                                                        type="text"
                                                        v-model="
                                                            promotion.now_academic_rank
                                                        "
                                                        class="mb-2"
                                                        required="required"
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
                                                    <CustomInput
                                                        type="date"
                                                        v-model="promotion.date"
                                                        class="mb-2"
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
                                                    <CustomInput
                                                        type="file"
                                                        @change="
                                                            (file) =>
                                                                (promotion.attachment =
                                                                    file)
                                                        "
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
                                        <router-link
                                            :to="{ name: 'app.dashboard' }"
                                            class="footer--button--cancel"
                                            >لغو ثبت</router-link
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

function onSubmit() {
    teacherStore.createPromotion(promotion.value, props.teacher_id);
}
</script>
