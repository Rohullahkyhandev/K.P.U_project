<template>
    <div class="bg-white rounded-lg w-full">
        <!-- display message area -->
        <div class="msg--success" v-if="msg_success">
            <div class="flex items-center justify-between px-10">
                <div
                    class="hover:bg-green-400 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        @click="msg_success = ''"
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
                    <span>{{ msg_success }}</span>
                </div>
            </div>
        </div>

        <div class="msg--warning" v-if="msg_wrang">
            <div class="flex items-center justify-between px-10">
                <div
                    class="hover:bg-red-300 text-white rounded-full h-8 w-8 cursor-pointer flex items-center justify-center"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        @click="msg_wrang = ''"
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
                    <span>{{ msg_wrang }}</span>
                </div>
            </div>
        </div>
        <!-- end of display message area -->
        <table class="w-full table text-center">
            <thead class="bg-gray-200 border-t-4 border-gray-400">
                <tr>
                    <th class="py-3">شماره</th>
                    <th class="py-3">رتبه علمی قبلی</th>
                    <th class="py-3">رتبه علمی فعلی</th>
                    <th class="py-3">تاریح ترفع</th>
                    <th class="py-3">اسناد</th>
                    <th class="py-3">عملیات</th>
                </tr>
            </thead>
            <tbody v-if="teacherPromotion.data?.length > 0 && loading == false">
                <tr
                    v-for="(promotion, index) in teacherPromotion.data"
                    :key="index"
                >
                    <td class="border-b p-3">{{ index + 1 }}</td>
                    <td class="border-b p-3">{{ promotion.last_rank }}</td>
                    <td class="border-b p-3">{{ promotion.now_rank }}</td>
                    <td class="border-b p-3">{{ promotion.date }}</td>
                    <td class="border-b p-3 text-center">
                        <ul class="flex whitespace-nowrap gap-3 text-center">
                            <li
                                class="bg-blue-600 px-3 p-2 text-white rounded-md d-block"
                                v-for="(
                                    attachment, index
                                ) in promotion.attachment_path"
                                :key="index"
                            >
                                <a :href="attachment">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor"
                                        class="size-6"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"
                                        />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </td>
                    <td class="border-b p-3">
                        <button @click="deletePromotion(promotion.id)">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="1.5"
                                stroke="currentColor"
                                class="size-6 text-red-500"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                />
                            </svg>
                        </button>
                    </td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr v-if="loading == true">
                    <td colspan="4" class="py-8 text-center'">
                        <Spinner />
                    </td>
                </tr>
                <tr v-else>
                    <td colspan="6" class="py-8 text-center'">
                        دیتا یافت نشد!
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import Spinner from "../../components/core/Spnnier.vue";
import axiosClient from "../../axios";

const teacherPromotion = ref([]);
let msg_success = ref("");
let msg_wrang = ref("");
let loading = ref(false);

onMounted(() => {
    getTeacherPromotion();
});

const props = defineProps({
    closeModal: {
        type: Function,
        required: true,
    },
    id: {
        type: String,
        required: true,
    },
});

function getTeacherPromotion() {
    loading.value = true;
    axiosClient
        .get(`/teacher/promotion/list/${props.id}`)
        .then((res) => {
            loading.value = false;
            teacherPromotion.value = res.data;
        })
        .catch((err) => {
            loading.value = false;
            msg_wrang.value = err.response.data.message;
        });
}

function deletePromotion(id) {
    if (!confirm("آیا شما مطمین هستید می خواهید این دیتا را حذف نماید؟")) {
        return 0;
    }
    loading.value = true;
    axiosClient
        .get(`/teacher/promotion/delete/${id}`)
        .then((res) => {
            loading.value = false;
            msg_success.value = "دیتا موفقانه حذف گردید";
        })
        .catch((err) => {
            loading.value = false;
            msg_wrang.value = err.response.data.message;
            // msg_wrang.value = "دیتا حذف نشد دورباره تلاش نماید";
        });

    getTeacherPromotion();
}
</script>
