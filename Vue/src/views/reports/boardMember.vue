<template>
    <div class="form--padding--top">
        <div class="flex items-center justify-between w-full">
            <div>
                <h1 class="text--header">فورم تهیه نمودن راپور اعضای بورد</h1>
            </div>
        </div>

        <form>
            <div class="wrapper--dev--form">
                <div>
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                انتخاب راپور بر اساس<span class="label--prefix"
                                    >*</span
                                ></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <select
                                class="appearance-none relative mb-3 shadow-sm block w-full item-center justify-between text-left px-3 py-2.5 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                v-model="reportData.type"
                            >
                                <option
                                    value=""
                                    selected
                                    class="flex items-center font-bold justify-between float-end"
                                >
                                    انتخاب راپور بر اساس
                                </option>
                                <option
                                    v-for="(type, index) in types"
                                    :key="index"
                                    :value="type.key"
                                >
                                    {{ type.text }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div
                        class="wrapper--dev--input"
                        v-if="reportData.type == 'base_on_board'"
                    >
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                انتخاب بورد<span class="label--prefix"
                                    >*</span
                                ></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <custom-input
                                type="select"
                                :select-options="boards"
                                v-model="reportData.report_data"
                                :placeholder="`انتخاب بورد...`"
                                class="mb-2"
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
                                class="appearance-none relative mb-3 shadow-sm block w-full item-center justify-between text-left px-3 py-2.5 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
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
                </div>
            </div>
            <footer class="bg-gray-100 py-4 md:flex gap-5">
                <a
                    v-if="reportData.type != '' && reportData.report_data != ''"
                    :href="
                        ExportUrl +
                        reportData.type +
                        '/' +
                        reportData.report_data
                    "
                    :class="[
                        reportData.report_data == ''
                            ? 'footer--button--submit cursor-not-allowed'
                            : 'footer--button--submit cursor-pointer rounded ',
                    ]"
                >
                    <span> تهیه راپور </span>
                </a>
                <button
                    class="bg-blue-400 text-white rounded-lg py-2 px-8 mr-6"
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
import useBoradMemberStore from "../../stores/postgraduatedPrograms/boardMemberStore";

const ExportUrl = `http://localhost/ViceChancellor/public/postgraduated/report/board_member/`;

// search student accroding ot the admission year
const boardStore = useBoradMemberStore();
const dateStore = useDateStore();
const years = computed(() => dateStore.years);
const selectedYear = computed(() => dateStore.selectedYear);

onMounted(() => {
    boardStore.getAllBoard();
});

const reportData = ref({
    type: "",
    report_data: "",
});

const boards = computed(() =>
    boardStore.boardList.map((board) => ({
        key: board.id,
        text: board.name,
    }))
);

const types = ref([
    {
        key: "base_on_year",
        text: "بر اساس سال",
    },
    {
        key: "base_on_board",
        text: "بر اساس بورد ",
    },
]);

const statuses = ref([
    {
        key: "1",
        text: "محصیلن بر حال",
    },
    {
        key: "2",
        text: "محصیلن فارغ شده",
    },
]);
</script>
