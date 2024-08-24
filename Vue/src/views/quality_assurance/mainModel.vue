<template>
    <div>
        <!-- main criteria -->
        <button type="button" @click="openModal" class="header--button"
            v-if="create_quality_assurance || administrator">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z" />
            </svg>

            ثبت معیار اصلی
        </button>
        <TransitionRoot appear :show="isOpen" as="template">
            <Dialog as="div" @close="closeModal" class="relative z-10" dir="rtl">
                <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0"
                    enter-to="opacity-100" leave="duration-200 ease-in" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-black/25" />
                </TransitionChild>

                <div class="fixed inset-0 overflow-y-auto">
                    <div class="flex min-h-full items-center justify-center p-4 text-center">
                        <TransitionChild as="template" enter="duration-300 ease-out" enter-from="opacity-0 scale-95"
                            enter-to="opacity-100 scale-100" leave="duration-200 ease-in"
                            leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">
                            <DialogPanel
                                class="w-full max-w-4xl mr-24 mt-5 transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all">
                                <DialogTitle as="h3" class="text--header text-right mr-6">
                                    فورم ثبت معیارات اصلی
                                </DialogTitle>
                                <div class="mt-2">
                                    <form @submit.prevent="onSubmit">
                                        <div class="">
                                            <!-- display message area -->
                                            <!-- <div
                                                class="msg--success"
                                                v-if="criteriaStore.msg_success"
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
                                                                criteriaStore.msg_success =
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
                                                            criteriaStore.msg_success
                                                        }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                class="msg--warning"
                                                v-if="criteriaStore.msg_wrang"
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
                                                                criteriaStore.msg_wrang =
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
                                                            criteriaStore.msg_wrang
                                                        }}</span>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <!-- end of display message area -->

                                            <div>
                                                <div class="wrapper--dev--input">
                                                    <div class="label--dev--width">
                                                        <label for="" class="form--label">
                                                            سال<span class="label--prefix">*</span></label>
                                                    </div>
                                                    <div class="input--dev--width">
                                                        <CustomInput type="text" v-model="criteria.year" class="mb-2"
                                                            required="required" />
                                                    </div>
                                                </div>

                                                <div class="wrapper--dev--input">
                                                    <div class="label--dev--width">
                                                        <label for="" class="form--label"> بخش مربوط
                                                            <span class="label--prefix">*</span></label>
                                                    </div>
                                                    <div class="input--dev--width">
                                                        <CustomInput type="textarea" v-model="criteria.related_part"
                                                            class="mb-2" required="required" label=" بخش مربوط" />
                                                    </div>
                                                </div>

                                                <div class="wrapper--dev--input">
                                                    <div class="label--dev--width">
                                                        <label for="" class="form--label">شماره معیار
                                                            <span class="label--prefix">*</span></label>
                                                    </div>
                                                    <div class="input--dev--width">
                                                        <CustomInput type="select" :selectOptions="criteria_number"
                                                            v-model="criteria.number" class="mb-2" required="required"
                                                            label=" شماره معیار" />
                                                    </div>
                                                </div>

                                                <div class="wrapper--dev--input">
                                                    <div class="label--dev--width">
                                                        <label for="" class="form--label">
                                                            آپلود فایل<span class="label--prefix">*</span></label>
                                                    </div>
                                                    <div class="input--dev--width">
                                                        <CustomInput type="file"
                                                            @change="(file) => (criteria.attachment = file)"
                                                            class="mb-2" required="required" />
                                                    </div>
                                                </div>

                                                <div class="wrapper--dev--input">
                                                    <div class="label--dev--width">
                                                        <label for="" class="form--label">
                                                            خلاصه مطلب<span class="label--prefix"></span></label>
                                                    </div>
                                                    <div class="input--dev--width">
                                                        <CustomInput type="textarea" v-model="criteria.description"
                                                            class="mb-2" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <footer class="bg-gray-100 py-4 md:flex gap-5">
                                            <button type="submit" :class="[
                                                criteriaStore.loading === true
                                                    ? 'footer--button--submit cursor-not-allowed'
                                                    : 'footer--button--submit cursor-pointer rounded ',
]">
                                                <span v-if="criteriaStore.loading === true">
                                                    <svg class="animate-spin -ml-1 h-5 w-5 text-white"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24">
                                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                                            stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-75" fill="currentColor"
                                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                        </path>
                                                    </svg>
                                                </span>
                                                <span v-else> ثبت </span>
                                            </button>
                                            <span @click="closeModal" class="footer--button--cancel">لغو ثبت</span>
                                        </footer>
                                    </form>
                                </div>
                            </DialogPanel>
                        </TransitionChild>
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>
    </div>
</template>

<script setup>
import CustomInput from "../../components/core/CustomInput.vue";
import useCriteriaStore from "../../stores/pdc/quality_assurance/qualityAssuranceStore";
import { computed, onMounted, ref } from "vue";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from "@headlessui/vue";
import { useUserStore } from "../../stores/user/userStore";

const criteria_number = [
    {
        key: "1",
        text: "اول",
    },

    {
        key: "2",
        text: "دوم",
    },

    {
        key: "3",
        text: "سوم",
    },

    {
        key: "4",
        text: "چهارم",
    },

    {
        key: "5",
        text: "پنجم",
    },

    {
        key: "6",
        text: "ششم",
    },

    {
        key: "7",
        text: "هفتم",
    },

    {
        key: "8",
        text: "هشتم",
    },

    {
        key: "9",
        text: "نهم",
    },

    {
        key: "10",
        text: "دهم",
    },

    {
        key: "11",
        text: "یازدهم",
    },
];

const criteriaStore = useCriteriaStore();
const userStore = useUserStore();
const criteria = computed(() => criteriaStore.criteria);
const isOpen = ref(false);

// part subcriteria
function closeModal() {
    isOpen.value = false;
}
function openModal() {
    isOpen.value = true;
}

onMounted(() => {
    criteriaStore.getCriteria();
    userStore.getCurrentPermission();
});

// permissions
const administrator = computed(() => userStore.permission_current.administrator)
const create_quality_assurance = computed(() => userStore.permission_current.create_quality_assurance)


function onSubmit() {
    criteriaStore.createCriteria(criteria.value);
    isOpen.value = false;
    criteriaStore.getCriteria();
}
</script>
