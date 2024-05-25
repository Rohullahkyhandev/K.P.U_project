<template>
    <div class="form--padding--top">
        <div class="flex items-center justify-between w-full">
            <div>
                <router-link
                    :to="{ name: 'app.pdc.teacher_in_workshop.list' }"
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
                    لیست استادان در ورکشاپ ها
                </router-link>
            </div>
            <div>
                <h1 class="text--header">فورم ویرایش استاد در ورکشاپ</h1>
            </div>
        </div>
        <form @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="wrapper--dev--form">
                <!-- display message area -->
                <div
                    class="msg--success"
                    v-if="teacherInWorkshopStore.msg_success"
                >
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="teacherInWorkshopStore.msg_success = ''"
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
                                teacherInWorkshopStore.msg_success
                            }}</span>
                        </div>
                    </div>
                </div>

                <div
                    class="msg--warning"
                    v-if="teacherInWorkshopStore.msg_wrang"
                >
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="teacherInWorkshopStore.msg_wrang = ''"
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
                            <span>{{ teacherInWorkshopStore.msg_wrang }}</span>
                        </div>
                    </div>
                </div>
                <!-- end of display message area -->

                <!-- <div>
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                موضوع
                                <span class="label--prefix">*</span>
                            </label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="text"
                                v-model="workshop.topic"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                تایم شروع
                                <span class="label--prefix">*</span>
                            </label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="time"
                                v-model="workshop.start_time"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                تایم ختم
                                <span class="label--prefix">*</span>
                            </label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="time"
                                v-model="workshop.end_time"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                توضیحات
                                <span class="label--prefix">*</span>
                            </label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="textarea"
                                v-model="workshop.description"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                آپلود فایل<span class="label--prefix"></span
                            ></label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="file"
                                @change="(file) => (workshop.document = file)"
                                class="mb-2"
                            />
                        </div>
                    </div>
                </div> -->

                <div>
                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                استادان
                                <span class="label--prefix">*</span>
                            </label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="select"
                                :selectOptions="teachers"
                                v-model="teacherInWorkshop.teacher_id"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                ورکشاپ ها
                                <span class="label--prefix">*</span>
                            </label>
                        </div>
                        <div class="input--dev--width">
                            <CustomInput
                                type="select"
                                :selectOptions="workshops"
                                v-model="teacherInWorkshop.workshop_id"
                                class="mb-2"
                                required="required"
                            />
                        </div>
                    </div>

                    <div class="wrapper--dev--input">
                        <div class="label--dev--width">
                            <label for="" class="form--label">
                                آپلود فایل<span class="label--prefix"></span
                            ></label>
                        </div>
                        <div class="input--dev--width">
                            <!-- <input type="file" multiple @change="handelFiles" /> -->
                            <CustomInput
                                type="file"
                                @change="
                                    (file) => {
                                        teacherInWorkshop.document = file;
                                    }
                                "
                                class="mb-2"
                            />
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-gray-100 py-4 md:flex gap-5">
                <button
                    type="submit"
                    :class="[
                        teacherInWorkshopStore.loading === true
                            ? 'footer--button--submit cursor-not-allowed'
                            : 'footer--button--submit cursor-pointer rounded ',
                    ]"
                >
                    <span v-if="teacherInWorkshopStore.loading === true">
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
                <router-link
                    :to="{ name: 'app.dashboard' }"
                    class="footer--button--cancel"
                    >لغو ویرایش</router-link
                >
            </footer>
        </form>
    </div>
</template>

<script setup>
import { computed, onMounted, ref, useSlots } from "vue";
import { useRoute } from "vue-router";
import CustomInput from "../../../components/core/CustomInput.vue";
import useCommitStore from "../../../stores/pdc/commit/commitStore";
import useTeacherInCommit from "../../../stores/pdc/teacherInCommit/teacherInCommitStore";
import useTeacherInWorkshop from "../../../stores/pdc/teacherInWorshop/teacherInWorkshopStore";
const teacherInWorkshopStore = useTeacherInWorkshop();
const teacherInCommitStore = useTeacherInCommit();

const teacherInWorkshop = computed(
    () => teacherInWorkshopStore.teacherInWorkshop
);

const route = useRoute();

onMounted(() => {
    teacherInCommitStore.getTeachers();
    teacherInWorkshopStore.getWorkshops();
    teacherInWorkshopStore.editTeacherInWorkshop(route.params.id);
});

const teachers = computed(() =>
    teacherInCommitStore.teachers.map((teacher) => ({
        key: teacher.id,
        text: teacher.name + " " + teacher.lname,
    }))
);

const workshops = computed(() =>
    teacherInWorkshopStore.workshops.map((workshop) => ({
        key: workshop.id,
        text:
            workshop.topic +
            "  " +
            workshop.start_time +
            "  " +
            workshop.end_time,
    }))
);

const selectFiles = ref([]);

function onSubmit() {
    let formData = new FormData();
    selectFiles.value.forEach((item) => formData.append("files[]", item));
    teacherInWorkshopStore.updateTeacherInWorkshop(teacherInWorkshop.value);
}

function handelFiles(event) {
    selectFiles.value = Array.from(event.target.files);
}
</script>
