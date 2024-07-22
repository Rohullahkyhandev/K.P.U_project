<template>
    <div class="form--padding--top">
        <div class="flex items-center justify-between w-full">
            <div>
                <router-link
                    :to="{ name: 'app.research.interpub.list' }"
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
                    لیست نشرات 
                </router-link>
            </div>
            <div>
                <h1 class="text--header">فورم ثبت  نشرات</h1>
            </div>
        </div>

        <form @submit.prevent="onSubmit">
            <div class="bg-white p-8 mt-6">
                <!-- display message area -->
                <div class="msg--success" v-if="interpubStore.msg_success">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="interpubStore.msg_success = ''"
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
                            <span>{{ interpubStore.msg_success }}</span>
                        </div>
                    </div>
                </div>

                <div class="msg--warning" v-if="interpubStore.msg_wrang">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="interpubStore.msg_wrang = ''"
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
                            <span>{{ interpubStore.msg_wrang }}</span>
                        </div>
                    </div>
                </div>
                <!-- end of display message area -->

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label for="" class="form--label">
                             نویسنده<span class="label--prefix">*</span></label
                        >
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="text"
                            v-model="publishment.author"
                            class="mb-2"
                            required="required"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label for="" class="form--label">
                            همکار نویسنده<span class="label--prefix">*</span></label
                        >
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="text"
                            v-model="publishment.author_assesstance"
                            class="mb-2"
                            required="required"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label for="" class="form--label">
                             عنوان
                            <span class="label--prefix">*</span></label
                        >
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="text"
                            v-model="publishment.title"
                            class="mb-2"
                            required="required"
                        />
                    </div>
                </div>

                <div>
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                نام جورنال
                                <span class="label--prefix">*</span></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="text"
                                v-model="publishment.journal_name"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>
                </div>
                <div>
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                لینک جورنال
                                <span class="label--prefix">*</span></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="text"
                                v-model="publishment.journal_link_website"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>
                </div>

                <div>
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                دیپارتمنت ها
                                <span class="label--prefix">*</span></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <select
                                v-model="publishment.departments"
                                multiple
                                class="block w-full px-3 py-2.5 border rounded shadow border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                            >
                                <option
                                    v-for="(department, index) in departments"
                                    :key="index"
                                    :value="department.name"
                                >
                                    {{ department.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                 ابلود فایل
                                <span class="label--prefix">*</span></label
                            >
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="file"
                                v-model="publishment.attachments"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>
                </div>


                <footer class="bg-gray-100 mt-5 py-4 md:flex gap-5">
                    <button
                        type="submit"
                        :class="[
                            interpubStore.loading === true
                                ? 'footer--button--submit cursor-not-allowed'
                                : 'footer--button--submit cursor-pointer rounded ',
                        ]"
                    >
                        <span v-if="interpubStore.loading === true">
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
                        <span v-else> ویرایش </span>
                    </button>
                    <button @click="closeModal" class="footer--button--cancel">
                        لغو ویرایش
                    </button>
                </footer>
            </div>
        </form>
    </div>
</template>

<script setup>
import { computed, onMounted, ref, useSlots } from "vue";
import { useRoute } from "vue-router";
import CustomInput from "../../../components/core/CustomInput.vue";
import useDepartmentStore from "../../../stores/department/deparmentStore";
import useInterpubStore from "../../../stores/researchDepartment/interpublishmentStore";

const interpubStore = useInterpubStore();
const route = useRoute();
onMounted(() => {
    interpubStore.getAllDepartments();
    interpubStore.editPublishment(route.params.id);
});

const publishment = computed(() => interpubStore.publishment);
const departments = computed(() => interpubStore.listDepartments);

const props = defineProps({
    closeModal: {
        type: Function,
        required: true,
    },
});



function onSubmit() {
    interpubStore.updatePublishment(publishment.value);

    // for refreshing  publishment
    interpubStore.getPublishment();
}
</script>
