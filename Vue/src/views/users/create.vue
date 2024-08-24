<template>
    <div class="form--padding--top">
        <div class="flex items-center justify-between w-full">
            <div>
                <router-link :to="{ name: 'app.user.list' }" class="header--button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    لیست کابران
                </router-link>
            </div>
            <div>
                <h1 class="text--header">فورم راجستر کابر</h1>
            </div>
        </div>

        <form @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="wrapper--dev--form">
                <!-- start of alert message -->
                <div class="msg--success" v-if="userStore.msg_success">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" @click="userStore.msg_success = ''" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div>
                            <div
                                class="bg-white absolute left-4 top-4 flex items-center justify-center w-10 h-10 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 text-green-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </div>
                            <span>{{ userStore.msg_success }}</span>
                        </div>
                    </div>
                </div>

                <div class="msg--warning" v-if="userStore.msg_wrang">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" @click="teacherStore.msg_wrang = ''" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div>
                            <div
                                class="bg-white absolute left-4 top-4 flex items-center justify-center w-10 h-10 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 text-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                </svg>
                            </div>
                            <span>{{ userStore.msg_wrang }}</span>
                        </div>
                    </div>
                </div>
                <!-- end of alert message -->
                <div class="mt-5">
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">نام کامل کابر<span class="label--prefix">*</span></label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput type="text" v-model="user.name" class="mb-2" required="required" />
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">آدرس ایمل<span class="text-red-500 px-2">*</span></label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput type="text" v-model="user.email" class="mb-2" required="required" />
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">جایگاه کاری<span class="label--prefix">*</span></label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput type="text" v-model="user.position" class="mb-2" required="required" />
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                نوع یوزر<span class="label--prefix">*</span></label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput type="select" :select-options="user_type" v-model="user.user_type" class="mb-2"
                                required="required" label=" نوع یوزر" />
                        </div>
                    </div>

                    <div class="md:flex md:items-center md:justify-center" v-if="user.user_type == 'fifth_department'">
                        <div class="w-2/12">
                            <label for="" class="block text-gray-500 md:text-left mb-1 md:mb-0">بخش مربوط<span
                                    class="text-red-500 px-2">*</span></label>
                        </div>
                        <div class="w-6/12">
                            <CustomInput type="select" v-model="user.dep_id" :select-options="chanceDepartments"
                                class="mb-2" label="بخش مربوط" required="required" />
                        </div>
                    </div>

                    <div class="md:flex md:items-center md:justify-center" v-if="user.user_type == 'faculty_user'">
                        <div class="w-2/12">
                            <label for="" class="block text-gray-500 md:text-left mb-1 md:mb-0">پوهنځی مربوط<span
                                    class="text-red-500 px-2">*</span></label>
                        </div>
                        <div class="w-6/12">
                            <CustomInput type="select" v-model="user.faculty_id" :select-options="faculties"
                                class="mb-2" label=" پوهنځی مربوط" required="required" />
                        </div>
                    </div>

                    <div class="md:flex md:items-center md:justify-center" v-if="user.user_type == 'department_user'">
                        <div class="w-2/12">
                            <label for="" class="block text-gray-500 md:text-left mb-1 md:mb-0">پوهنځی مربوط<span
                                    class="text-red-500 px-2">*</span></label>
                        </div>
                        <div class="w-6/12">
                            <CustomInput type="select" v-model="user.faculty_id"
                                @change="getFacultyDepartment(user.faculty_id)" :select-options="faculties" class="mb-2"
                                label=" پوهنځی مربوط" required="required" />
                        </div>
                    </div>

                    <div class="md:flex md:items-center md:justify-center" v-if="user.user_type == 'department_user'">
                        <div class="w-2/12">
                            <label for="" class="block text-gray-500 md:text-left mb-1 md:mb-0">
                                دیپارتمنت ها<span class="text-red-500 px-2">*</span></label>
                        </div>
                        <div class="w-6/12">
                            <CustomInput type="select" v-model="user.department_id" :select-options="departments"
                                class="mb-2" label="دیپارتمنت " required="required" />
                        </div>
                    </div>



                    <div class="md:flex md:items-center md:justify-center">
                        <div class="w-2/12">
                            <label for="" class="block text-gray-500 md:text-left mb-1 md:mb-0">رمز عبور<span
                                    class="text-red-500 px-2">*</span></label>
                        </div>
                        <div class="w-6/12">
                            <CustomInput type="password" v-model="user.password" class="mb-2" required="required" />
                        </div>
                    </div>

                    <div class="md:flex md:items-center md:justify-center">
                        <div class="w-2/12">
                            <label for="" class="block text-gray-500 md:text-left mb-1 md:mb-0">تا‌ید رمز عبور<span
                                    class="text-red-500 px-2">*</span></label>
                        </div>
                        <div class="w-6/12">
                            <CustomInput type="password" v-model="user.password_confirmation" class="mb-2"
                                required="required" />
                        </div>
                    </div>

                    <div class="md:flex md:items-center md:justify-center">
                        <div class="w-2/12">
                            <label for="" class="block text-gray-500 md:text-left mb-1 md:mb-0">عکس<span
                                    class="text-red-500 px-2"></span></label>
                        </div>
                        <div class="w-6/12">
                            <CustomInput type="file" class="mb-2" @change="(file) => (user.photo = file)" />
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-gray-100 py-4 md:flex gap-5">
                <button type="submit" class="footer--button--submit">
                    <span v-if="!userStore.loading"> ثبت </span>
                    <span v-else>
                        <svg class="animate-spin -ml-1 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </span>
                </button>

                <router-link :to="{ name: 'app.user.list' }" class="footer--button--cancel">لغو ثبت</router-link>
            </footer>
        </form>
    </div>
</template>

<script setup>
import { computed, onMounted, ref, useSlots } from "vue";
import CustomInput from "../../components/core/CustomInput.vue";
import useDepartmentStore from "../../stores/department/deparmentStore";
import { useFacultyStore } from "../../stores/faculties/facultyStore";
import { useUserStore } from "../../stores/user/userStore";

const userStore = useUserStore();
const facultyStore = useFacultyStore();
const departmentStore = useDepartmentStore();

const user_type = ref([
    { key: "admin", text: " مدیر سیستم " },
    { key: "faculty_user", text: " یوزر پوهنځی" },
    // { key: "common_department_user", text: "یوزر دیپارمنت های عمومی " },
    { key: "department_user", text: "یوزر دیپارتمنت   " },
    { key: "fifth_department", text: "آمریت های پنج گانه" },
]);

onMounted(() => {
    facultyStore.getAllFaculty();
    userStore.getChanceDepartments();
    if (
        user.value.user_type == "department_user" &&
        user.value.faculty_id != null
    ) {
        getFacultyDepartment(user.value.faculty_id);
    }
});

const faculties = computed(() =>
    facultyStore.listFaculty.map((f) => ({ key: f.id, text: f.name }))
);



const departments = computed(() =>
    departmentStore.faculty_department.map((f) => ({
        key: f.id,
        text: f.name,
    }))
);

const user = computed(() => userStore.user_data);

let chanceDepartments = computed(() =>
    userStore.chanceDepartments.map((c) => ({
        key: c.id,
        text: c.display_name,
    }))
);

function getFacultyDepartment(id) {
    if (id) {
        departmentStore.getFacultyDepartment(id);
    }
}

function onSubmit() {
    userStore.createUser(user.value);
}
</script>
