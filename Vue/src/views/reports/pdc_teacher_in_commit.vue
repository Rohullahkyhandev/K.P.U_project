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
                <h1 class="text--header">فورم تهیه راپور اعضای کمیته ها</h1>
            </div>
        </div>

        <form>
            <div class="wrapper--dev--form">
                <!-- display message area -->
                <div class="msg--success" v-if="reportStore.msg_success">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="reportStore.msg_success = ''"
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
                            <span>{{ reportStore.msg_success }}</span>
                        </div>
                    </div>
                </div>

                <div class="msg--warning" v-if="reportStore.msg_wrang">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="reportStore.msg_wrang = ''"
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
                            <span>{{ reportStore.msg_wrang }}</span>
                        </div>
                    </div>
                </div>
                <!-- end of display message area -->

                <div>
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                انتخاب نوع راپور بر اساس<span
                                    class="label--prefix"
                                    >*</span
                                ></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="select"
                                v-model="reportData.type"
                                :select-options="types"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>

                    <div
                        class="wrapper--dev--input"
                        v-if="reportData.type == 'base_on_commit'"
                    >
                        <div class="label--dev--width">
                            <label for="" class="form--label"
                                >کمیته ها<span class="label--prefix"
                                    >*</span
                                ></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <custom-input
                                type="select"
                                v-model="reportData.report_data"
                                class="mb-2"
                                required="required"
                                :select-options="commits"
                                placeholder=" انتخاب کمیته"
                            />
                        </div>
                    </div>

                    <div
                        class="wrapper--dev--input"
                        v-if="reportData.type == 'base_on_year'"
                    >
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                انتخاب سال<span class="label--prefix"
                                    >*</span
                                ></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <select
                                v-if="reportData.type == 'base_on_year'"
                                class="appearance-none relative block w-full flex item-center justify-between text-left px-3 py-2.5 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                v-model="reportData.report_data"
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
                        <!-- <div class="label--dev--width">
                            <label for="" class="form--label">
                                فارمت راپور<span class="label--prefix"
                                    >*</span
                                ></label
                            >
                        </div> -->
                        <!-- <div class="input--dev--width">
                            <custom-input
                                type="select"
                                v-model="reportData.report_format"
                                class="mb-2"
                                required="required"
                                :select-options="report_format"
                                placeholder=" انتخاب فارمت"
                            />
                        </div> -->
                    </div>
                </div>
            </div>
            <footer class="bg-gray-100 py-4 md:flex gap-5">
                <a
                    v-if="reportData.report_data"
                    :href="
                        ExportUrl +
                        reportData.type +
                        '/' +
                        reportData.report_data
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
                    <span v-else>  تهیه راپور </span>
                </a>
                <button
                    class="bg-blue-400 text-white rounded-lg py-2 px-8 mr-6"
                    v-else
                >
                    تهیه راپور
                </button>
                <router-link
                    :to="{ name: 'app.pdc.plan.list' }"
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
import useCommitStore from "../../stores/pdc/commit/commitStore";
import useDateStore from "../../stores/dateStore";

const reportStore = usePdcTeacherInCommitReport();

const reportData = computed(() => reportStore.report_data);
const ExportUrl = `http://localhost/ViceChancellor/public/pdc/report/teacher_in_commit/`;

onMounted(() => {
    reportStore.getCommits();
});

// search student accroding ot the admission year
const dateStore = useDateStore();
const years = computed(() => dateStore.years);
const selectedYear = computed(() => dateStore.selectedYear);

const commits = computed(() =>
    reportStore.commits.map((commit) => ({
        key: commit.id,
        text: commit.name,
    }))
);

const types = ref([
    {
        key: "base_on_year",
        text: "بر اساس سال",
    },
    {
        key: "base_on_commit",
        text: "بر اساس نام کمیته",
    },
]);

const report_format = ref([
    {
        key: "pdf",
        text: "پی دی اف",
    },
    {
        key: "xls",
        text: "اکسل",
    },
]);

// function onSubmit() {
//     reportStore.createReport(reportData.value);
// }
</script>
