<template>
    <div class="form--padding--top">
        <!-- main  -->
        <MainCriteria />

        <!-- sub criteria -->
        <div>
            <TransitionRoot appear :show="isOpen" as="template">
                <Dialog
                    as="div"
                    @close="closeModal"
                    class="relative z-10"
                    dir="rtl"
                >
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
                                    class="w-full max-w-4xl mr-24 mt-5 transform overflow-hidden rounded-2xl bg-white p-6 text-left align-middle shadow-xl transition-all"
                                >
                                    <div
                                        class="flex items-center justify-between mb-6"
                                    >
                                        <button
                                            class="header--button"
                                            @click="toggleModal"
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
                                                    d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                                                />
                                            </svg>
                                            <span v-if="isOpenList">
                                                ثبت معیار فرعی
                                            </span>
                                            <span v-else> لیست معیار فرعی</span>
                                        </button>
                                        <DialogTitle
                                            as="h3"
                                            class="font-semibold text-xl text-right mr-6"
                                        >
                                            <span v-if="isOpenForm">
                                                فورم ثبت معیارات فرعی
                                            </span>
                                            <span v-else>
                                                لیست معیارات فرعی
                                            </span>
                                        </DialogTitle>
                                    </div>
                                    <div class="mt-2" v-if="isOpenForm">
                                        <form @submit.prevent="onSubmit">
                                            <div class="">
                                                <!-- display message area -->
                                                <div
                                                    class="msg--success"
                                                    v-if="
                                                        subCriteriaStore.msg_success
                                                    "
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
                                                                    subCriteriaStore.msg_success =
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
                                                                subCriteriaStore.msg_success
                                                            }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div
                                                    class="msg--warning"
                                                    v-if="
                                                        subCriteriaStore.msg_wrang
                                                    "
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
                                                                    subCriteriaStore.msg_wrang =
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
                                                                subCriteriaStore.msg_wrang
                                                            }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end of display message area -->
                                                <div class="text-right">
                                                    <span
                                                        >معیار اصلی شماره
                                                        :</span
                                                    >
                                                    <span>
                                                        {{
                                                            subCriteriaStore
                                                                .criteria
                                                                .number +
                                                            "  -" +
                                                            subCriteriaStore
                                                                .criteria.year
                                                        }}
                                                    </span>
                                                </div>
                                                <div>
                                                    <div
                                                        class="wrapper--dev--input"
                                                    ></div>

                                                    <div
                                                        class="wrapper--dev--input"
                                                    >
                                                        <div
                                                            class="label--dev--width"
                                                        >
                                                            <label
                                                                for=""
                                                                class="form--label"
                                                                >شماره معیار
                                                                <span
                                                                    class="label--prefix"
                                                                    >*</span
                                                                ></label
                                                            >
                                                        </div>
                                                        <div
                                                            class="input--dev--width"
                                                        >
                                                            <CustomInput
                                                                type="number"
                                                                v-model="
                                                                    subCriteria.number
                                                                "
                                                                class="mb-2"
                                                                required="required"
                                                                label=" شماره معیار"
                                                            />
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="wrapper--dev--input"
                                                    >
                                                        <div
                                                            class="label--dev--width"
                                                        >
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
                                                        <div
                                                            class="input--dev--width"
                                                        >
                                                            <CustomInput
                                                                type="file"
                                                                @change="
                                                                    (file) =>
                                                                        (subCriteria.attachment =
                                                                            file)
                                                                "
                                                                class="mb-2"
                                                                required="required"
                                                            />
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="wrapper--dev--input"
                                                    >
                                                        <div
                                                            class="label--dev--width"
                                                        >
                                                            <label
                                                                for=""
                                                                class="form--label"
                                                            >
                                                                خلاصه مطلب<span
                                                                    class="label--prefix"
                                                                ></span
                                                            ></label>
                                                        </div>
                                                        <div
                                                            class="input--dev--width"
                                                        >
                                                            <CustomInput
                                                                type="textarea"
                                                                v-model="
                                                                    subCriteria.description
                                                                "
                                                                class="mb-2"
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
                                                        subCriteriaStore.loading ===
                                                        true
                                                            ? 'footer--button--submit cursor-not-allowed'
                                                            : 'footer--button--submit cursor-pointer rounded ',
                                                    ]"
                                                >
                                                    <span
                                                        v-if="
                                                            subCriteriaStore.loading ===
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
                                                    :to="{
                                                        name: 'app.dashboard',
                                                    }"
                                                    class="footer--button--cancel"
                                                    >لغو ثبت</router-link
                                                >
                                            </footer>
                                        </form>
                                    </div>

                                    <!-- list of the sub Criteria -->
                                    <div class="" v-if="isOpenList">
                                        <SubCriteriaList :id="criteria_id" />
                                    </div>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </div>
                </Dialog>
            </TransitionRoot>
        </div>
        <!-- main criteria list  -->
        <listMainCriteria :openModal="openModal" />
    </div>
</template>

<script setup>
import SubCriteriaList from "./subIndex.vue";
import CustomInput from "../../components/core/CustomInput.vue";
import useSubCriteriaStore from "../../stores/pdc/quality_assurance/suCriteriaStore";
import { computed, onMounted, ref } from "vue";
import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogPanel,
    DialogTitle,
} from "@headlessui/vue";
import MainCriteria from "./mainModel.vue";
import listMainCriteria from "./index.vue";

const subCriteriaStore = useSubCriteriaStore();
const subCriteria = computed(() => subCriteriaStore.subCriteria);

const criteria_id = ref("");
// sub criteria modal
const isOpen = ref(false);
const isOpenForm = ref(false);
const isOpenList = ref(true);
function closeModal() {
    isOpen.value = false;
}
function openModal(id) {
    if (id) {
        criteria_id.value = id;
        isOpen.value = true;
        subCriteriaStore.getCriteria(id);
    }
}

function toggleModal() {
    if (isOpenForm.value == false) {
        isOpenForm.value = true;
        isOpenList.value = false;
    } else {
        isOpenForm.value = false;
        isOpenList.value = true;
    }
}

function onSubmit() {
    subCriteriaStore.createSubCriteria(subCriteria.value, criteria_id.value);
}
</script>
