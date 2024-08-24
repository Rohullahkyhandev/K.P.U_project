<template>
    <div class="form--padding--top">
        <div class="flex items-center justify-between w-full">
            <div>
                <router-link
                    :to="{ name: 'app.document.list' }"
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
                    لیست مکتوب ها
                </router-link>
            </div>
            <div>
                <h1 class="text--header">فورم ثبت مکتوب جدید</h1>
            </div>
        </div>

        <form @submit.prevent="onSubmit">
            <div class="wrapper--dev--form">
                <!-- display message area -->
                <div class="msg--success" v-if="documentStore.msg_success">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="documentStore.msg_success = ''"
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
                            <span>{{ documentStore.msg_success }}</span>
                        </div>
                    </div>
                </div>

                <div class="msg--warning" v-if="documentStore.msg_wrang">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="documentStore.msg_wrang = ''"
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
                            <span>{{ documentStore.msg_wrang }}</span>
                        </div>
                    </div>
                </div>
                <!-- end of display message area -->

                <div>
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                شماره مکتوب<span class="label--prefix"
                                    >*</span
                                ></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="number"
                                v-model="document.number"
                                class="mb-2"
                                required="required"
                                placeholder="0044339988"
                            />
                            <!-- <InputMask
                                id="basic"
                                v-model="document.number"
                                mask="0089445566778899"
                                placeholder="0089445566778899"
                                class="  placeholder:text-gray-200"
                            /> -->
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                عنوان<span class="label--prefix">*</span></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="text"
                                v-model="document.title"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                مبداء مکتوب<span class="label--prefix"
                                    >*</span
                                ></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="text"
                                v-model="document.source"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                مرجع مکتوب<span class="label--prefix"
                                    >*</span
                                ></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="text"
                                v-model="document.destination"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label"
                                >تاریخ ثبت<span class="label--prefix"
                                    >*</span
                                ></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <DatePicker
                                v-model="document.date"
                                class="mb-2"
                                required="required"
                                placeholder=" تاریخ ثبت"
                            />
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                نوع مکتوب<span class="label--prefix"
                                    >*</span
                                ></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="select"
                                :select-options="document_types"
                                v-model="document.type"
                                class="mb-2"
                                required="required"
                                label=" نوع مکتوب"
                            />
                        </div>
                    </div>

                    <div
                        class="wrapper--dev--input"
                        v-if="document.type == 'صادره'"
                    >
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                تکثر<span class="label--prefix">*</span></label
                            >
                        </div>
                        <div class="input--dev--width mb-2">
                            <span> می شود</span>
                            <span
                                @click="checkbox = true"
                                class="cursor-pointer text-green-400 font-semibold"
                            >
                                &check;
                            </span>
                            &nbsp; &nbsp; &nbsp;
                            <span> یا خیر</span>
                            <span
                                @click="checkbox = false"
                                class="cursor-pointer text-red-500 font-semibold"
                            >
                                &cross;
                            </span>
                        </div>
                    </div>

                    <div class="wrapper--dev--input" v-if="checkbox == true">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                بخش ها<span class="label--prefix"
                                    >*</span
                                ></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="select"
                                :select-options="parts"
                                v-model="document.department_part"
                                class="mb-2"
                                required="required"
                                label="  بخش"
                            />
                        </div>
                    </div>

                    <div
                        class="wrapper--dev--input"
                        v-if="
                            document.department_part == 'faculty' &&
                            checkbox == true
                        "
                    >
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                پوهنځی ها<span class="label--prefix"
                                    >*</span
                                ></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <MultiSelect
                                v-model="document.farwarded_parts"
                                :options="faculties"
                                optionLabel="name"
                                filter
                                placeholder=" انتخاب پوهنځی"
                                :maxSelectedLabels="5"
                                class="w-full mb-2 shadow-sm border-gray-300 focus:ring focus:ring-indigo-500"
                            />
                        </div>
                    </div>

                    <div
                        class="wrapper--dev--input"
                        v-if="
                            document.department_part == 'chanceDepartments' &&
                            checkbox == true
                            //authStore.user.data.user_type != 'faculty_user'
                        "
                    >
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                آمریت ها پنچگانه<span class="label--prefix"
                                    >*</span
                                ></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <!-- <select
                                v-model="document.farwarded_parts"
                                multiple
                                class="block w-full rounded shadow px-3 py-2.5 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm mb-2"
                            >
                                <option
                                    v-for="(
                                        chanceDepartment, index
                                    ) in chanceDepartments"
                                    :value="chanceDepartment.id"
                                    :key="index"
                                >
                                    {{ chanceDepartment.display_name }}
                                </option>
                            </select> -->
                            <MultiSelect
                                v-model="document.farwarded_parts"
                                :options="chanceDepartments"
                                optionLabel="name"
                                filter
                                placeholder=" انتخاب آمریت"
                                :maxSelectedLabels="5"
                                class="w-full mb-2 shadow-sm border-gray-300 focus:ring focus:ring-indigo-500"
                            />
                        </div>
                    </div>

                    <div
                        class="wrapper--dev--input"
                        v-if="
                            document.department_part == 'department' &&
                            checkbox == true
                            //authStore.user.data.user_type != 'faculty_user'
                        "
                    >
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                دیپارتمنت ها عمومی
                                <span class="label--prefix">*</span></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <MultiSelect
                                v-model="document.farwarded_parts"
                                :options="departments"
                                optionLabel="name"
                                filter
                                placeholder=" انتخاب دیپارتمنت"
                                :maxSelectedLabels="5"
                                class="w-full mb-2 shadow-sm border-gray-300 focus:ring focus:ring-indigo-500"
                            />
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                اسکن مکتوب<span class="label--prefix"
                                    >*</span
                                ></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="file"
                                @change="(file) => (document.attachment = file)"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                ملاحظات<span class="label--prefix"
                                    >*</span
                                ></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="textarea"
                                v-model="document.remark"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>

                    {{ userStore.user.data.name }}

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                خلاصه مطلب<span class="label--prefix"></span
                            ></label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="textarea"
                                v-model="document.description"
                                class="mb-2"
                            />
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-gray-100 py-4 md:flex gap-5">
                <button
                    :disabled="documentStore.loading === true"
                    type="submit"
                    :class="[
                        documentStore.loading === true
                            ? 'footer--button--submit cursor-not-allowed'
                            : 'footer--button--submit cursor-pointer rounded ',
                    ]"
                >
                    <span v-if="documentStore.loading === true">
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
                    :to="{ name: 'app.document.list' }"
                    class="footer--button--cancel"
                    >لغو ثبت</router-link
                >
            </footer>
        </form>
    </div>
</template>

<script setup>
import { computed, onMounted, ref, useSlots } from "vue";
import InputMask from "primevue/inputmask";
import CustomInput from "../../components/core/CustomInput.vue";
import useDocumentStore from "../../stores/documents/documentStore";
import DatePicker from "vue3-persian-datetime-picker";
import { useFacultyStore } from "../../stores/faculties/facultyStore";
import { useUserStore } from "../../stores/user/userStore";
import { useAuthStore } from "../../stores/auth";
import useDepartmentStore from "../../stores/department/deparmentStore";
// import Multiselect from "../../components/Combox.vue";
import MultiSelect from "primevue/multiselect";

const document_types = ref([
    {
        key: "صادره",
        text: "صادره",
    },
    {
        key: "وارده",
        text: "وارده",
    },
]);

const parts = ref([
    {
        key: "all",
        text: "همه",
    },
    {
        key: "faculty",
        text: "پوهنځی ها",
    },

    // {
    //     key: "department",
    //     text: " دیپارتمنت های عمومی",
    // },

    {
        key: "chanceDepartments",
        text: "آمریت های پنجگانه",
    },
]);

const checkbox = ref(false);
const documentStore = useDocumentStore();
const facultyStore = useFacultyStore();
const userStore = useUserStore();
const authStore = useAuthStore();
const departmentStore = useDepartmentStore();

onMounted(() => {
    facultyStore.getAllFaculty();
    userStore.getChanceDepartments();
    authStore.getUser();
    departmentStore.departmentHasOutFaculties();
});

const faculties = computed(() =>
    facultyStore.listFaculty.map((faculty) => ({
        id: faculty.id,
        name: faculty.name,
    }))
);

const chanceDepartments = computed(() =>
    userStore.chanceDepartments.map((chanceDepartment) => ({
        id: chanceDepartment.id,
        name: chanceDepartment.name,
    }))
);

const document = computed(() => documentStore.document);

const departments = computed(() =>
    departmentStore.department_has_out_facilities.map((department) => ({
        id: department.id,
        name: department.name,
    }))
);

// const departments = ["option1", "option2", "option3", "option4"];

function onSubmit() {
    documentStore.createDocument(document.value);
}
</script>
