<template>
    <div class="mt-8 px-8">
        <div class="flex items-center justify-between w-full">
            <div>
                <router-link :to="{
                    name: 'app.teacher.details',
                    params: { id: $route.params.id },
                }" class="header--button">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    برگشت به صفحه قبل
                </router-link>
            </div>
            <div>
                <h1 class="">&nbsp;</h1>
            </div>
        </div>

        <form @submit.prevent="onSubmit">
            <div class="w-full py-8 bg-white shadow mt-8 px-4">
                <!-- display message area -->
                <div class="msg--success" v-if="teacherStore.msg_success">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" @click="teacherStore.msg_success = ''" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div>
                            <span>{{ teacherStore.msg_success }}</span>
                        </div>
                    </div>
                </div>

                <div class="msg--warning" v-if="teacherStore.msg_wrang">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" @click="teacherStore.msg_wrang = ''" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div>
                            <span>{{ teacherStore.msg_wrang }}</span>
                        </div>
                    </div>
                </div>
                <!-- end of display message area -->

                <div>
                    <div class="border-b py-2">
                        <h1 class="font-bold text-xl">
                            فورم ثبت اسناد تحصلی استادان
                        </h1>
                    </div>
                </div>
                <!-- <div class="w-full flex items-center justify-center">
                    <Steper
                        :step-one="teacherStore.stepOne"
                        :step-two="teacherStore.stepTwo"
                        :step-three="teacherStore.stepThree"
                    />
                </div> -->
                <br />
                <div class="">
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label class="form--label">نوع سند
                                <span class="label--prefix">*</span>
                            </label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput type="select" :select-options="documentTypes" v-model="teacher_document.type"
                                class="mb-2" required="required" />
                        </div>
                    </div>
                </div>

                <div class="">
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label class="form--label">سند
                                <span class="label--prefix">*</span>
                            </label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput type="file" @change="(file) => (teacher_document.document = file)
                                " class="mb-2" required="required" />
                        </div>
                    </div>
                </div>

                <div class="">
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label class="form--label">توضیحات
                                <span class="label--prefix">*</span>
                            </label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput type="textarea" v-model="teacher_document.description" class="mb-2"
                                required="required" />
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-gray-100 py-4 md:flex gap-5">
                <button type="submit" :class="[
                    teacherStore.loading === true
                        ? 'footer--button--submit cursor-not-allowed'
                        : 'footer--button--submit cursor-pointer rounded-lg',
                ]">
                    <span v-if="teacherStore.loading === true">
                        <svg class="animate-spin -ml-1 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </span>
                    <span v-else> ثبت </span>
                </button>
                <router-link :to="{
                    name: 'app.teacher.details',
                    params: { id: $route.params.t_id },
                }" class="footer--button--cancel">لغو ویرایش</router-link>
            </footer>
        </form>
    </div>
</template>

<script setup>
import { computed, onMounted, ref, useSlots } from "vue";
import { useRoute } from "vue-router";
import Steper from "../../components/steps.vue";
import CustomInput from "../../components/core/CustomInput.vue";
import { useTeacherStore } from "../../stores/teachers/teacherStore";
// import { EMDatePicker } from '@cafebazaar/emrooz';
const teacherStore = useTeacherStore();
const route = useRoute();

onMounted(() => {
    teacherStore.editDocument(route.params.d_id);
});


const documentTypes = ref([
    {
        key: 'دیپلوم لیسانس',
        text: 'دیپلوم لیسانس'
    },
    {
        key: 'دیپلوم ماستری',
        text: 'دیپلوم ماستری'
    },
    {
        key: 'دیپلوم دوکتورا',
        text: 'دیپلوم دوکتورا'
    }
])

const teacher_document = computed(() => teacherStore.teacher_document);

function onSubmit() {
    let id = route.params.id;
    teacherStore.createDocument(teacher_document.value, id);
}
</script>
