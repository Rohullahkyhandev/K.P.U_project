<template>
    <div class="form--padding--top">
        <div class="flex items-center justify-between w-full">
            <!-- <div>
                <router-link
                    :to="{ name: 'app.pdc.plan.list' }"
                    class="header--button"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke-width="1.5"
                        stroke="currentColor"
                        class="w-5 h-5 text-white"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"
                        />
                    </svg>
                    لیست پلان ها
                </router-link>
            </div> -->
            <div>
                <h1 class="text--header">
                    فورم تهیه راپور استادان که در بورسیه هستند
                </h1>
            </div>
        </div>

        <form>
            <div class="wrapper--dev--form">
                <div>
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                انتخاب سال<span class="label--prefix"
                                    >*</span
                                ></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <select
                                class="appearance-none relative mb-3 shadow-sm block w-full item-center justify-between text-left px-3 py-2.5 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                v-model="reportData.year"
                            >
                                <option
                                    value=""
                                    selected
                                    class="flex items-center font-bold justify-between float-end"
                                >
                                    انتخاب سال
                                </option>
                                <option
                                    v-for="year in years"
                                    :key="year"
                                    :value="year"
                                >
                                    {{ year }} ه,ش
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                فارمت راپور<span class="label--prefix"
                                    >*</span
                                ></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <custom-input
                                type="select"
                                v-model="reportData.format_type"
                                class="mb-2"
                                required="required"
                                :select-options="report_format"
                                placeholder=" انتخاب فارمت"
                            />
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-gray-100 py-4 md:flex gap-5">
                <a
                    v-if="reportData.year"
                    :href="
                        ExportUrl +
                        reportData.format_type +
                        '/' +
                        reportData.year
                    "
                    :class="[
                        reportStore.loading === true
                            ? 'footer--button--submit cursor-not-allowed'
                            : 'footer--button--submit cursor-pointer rounded ',
                    ]"
                >
                    <span v-if="reportStore.loading === true">
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
                    <span v-else> تهیه راپور </span>
                </a>
                <button
                    class="bg-blue-400 text-white rounded-lg py-2 px-8 mr-6 "
                    v-else
                >
                    تهیه راپور
                </button>
                <router-link
                    :to="{ name: 'app.dashboard' }"
                    class="footer--button--cancel"
                    >لغو ثبت</router-link
                >
            </footer>
        </form>
    </div>
</template>

<script setup>
import { computed, onMounted, ref, useSlots } from "vue";
import CustomInput from "../../components/core/CustomInput.vue";
import usePdcTeacherInCommitReport from "../../stores/report/pdcTeacherInCommitStore";
import DatePicker from "vue3-persian-datetime-picker";
import useDateStore from "../../stores/dateStore";
import useTeacherInCommit from "../../stores/pdc/teacherInCommit/teacherInCommitStore";

const ExportUrl = `http://localhost/ViceChancellor/public/pdc/report/teacher_in_scholarship/`;

// search student accroding ot the admission year
const reportStore = useTeacherInCommit();
const dateStore = useDateStore();
const years = computed(() => dateStore.years);
const selectedYear = computed(() => dateStore.selectedYear);

const reportData = ref({
    year: "",
    format_type: "",
});

const report_format = ref([
    {
        key: "xlsx",
        text: "xlsx",
    },
    {
        key: "xls",
        text: "xls",
    },
]);
</script>
