<template>
    <div class="form--padding--top">
        <form @submit.prevent="onSubmit">
            <div>
                <!-- display message area -->
                <div class="msg--success" v-if="labEquipmentStore.msg_success">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="labEquipmentStore.msg_success = ''"
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
                            <span>{{ labEquipmentStore.msg_success }}</span>
                        </div>
                    </div>
                </div>

                <div class="msg--warning" v-if="labEquipmentStore.msg_wrang">
                    <div class="flex items-center justify-between px-10">
                        <div
                            class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                @click="labEquipmentStore.msg_wrang = ''"
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
                            <span>{{ labEquipmentStore.msg_wrang }}</span>
                        </div>
                    </div>
                </div>
                <!-- end of display message area -->

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label for="" class="form--label">
                            نام <span class="label--prefix">*</span></label
                        >
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="text"
                            v-model="labEquipment.name"
                            class="mb-2"
                            required="required"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label for="" class="form--label">
                            تعداد <span class="label--prefix">*</span></label
                        >
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="text"
                            v-model="labEquipment.quantity"
                            class="mb-2"
                            required="required"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label for="" class="form--label">
                            تاریخ ثبت<span class="label--prefix">*</span></label
                        >
                    </div>
                    <div class="input--dev--width">
                        <DatePicker
                            v-model="labEquipment.entry_date"
                            placeholder="تاریخ ثبت سیستم"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label for="" class="form--label">
                            توضیحات
                            <span class="label--prefix"></span
                        ></label>
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="textarea"
                            v-model="labEquipment.description"
                            class="mb-2"
                        />
                    </div>
                </div>

                <div class="wrapper--dev--input">
                    <div class="label--dev--width">
                        <label for="" class="form--label">
                            لابرتورا مربوطه
                            <span class="label--prefix">*</span></label
                        >
                    </div>
                    <div class="input--dev--width">
                        <CustomInput
                            type="select"
                            :select-options="labs"
                            v-model="labEquipment.lab_id"
                            class="mb-2"
                            required="required"
                            label=" لابرتورا"
                        />
                    </div>
                </div>

                <footer class="bg-gray-100 py-4 md:flex gap-5">
                    <button
                        type="submit"
                        :class="[
                            labEquipmentStore.loading === true
                                ? 'footer--button--submit cursor-not-allowed'
                                : 'footer--button--submit cursor-pointer rounded ',
                        ]"
                    >
                        <span v-if="labEquipmentStore.loading === true">
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
                        :to="{ name: 'app.dashboard' }"
                        class="footer--button--cancel"
                        >لغو ثبت</router-link
                    >
                </footer>
            </div>
        </form>
    </div>
</template>

<script setup>
import { computed, onMounted, ref, useSlots } from "vue";
import DatePicker from "vue3-persian-datetime-picker";
import CustomInput from "../../../components/core/CustomInput.vue";
import useLabEquipmentStore from "../../../stores/postgraduatedPrograms/labEquipment";

const labEquipmentStore = useLabEquipmentStore();

onMounted(() => {
    labEquipmentStore.getAllLab();
});

const labEquipment = computed(() => labEquipmentStore.lab_equipment);
const labs = computed(() =>
    labEquipmentStore.listLabs.map((lab) => ({
        key: lab.id,
        text: lab.name,
    }))
);

onMounted(() => {
    labEquipmentStore.getAllLab();
});

function onSubmit() {
    labEquipmentStore.createEquipment(labEquipment.value);
    labEquipmentStore.getEquipment();
}
</script>
