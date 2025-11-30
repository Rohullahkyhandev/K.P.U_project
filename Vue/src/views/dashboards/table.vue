<template>
    <div class="grid grid-cols-2 gap-3 mb-3">
        <div class="bg-white rounded-lg shadow-lg">
            <h1 class="border-b-gray-300 mt-3 mb-3 mx-5 font-bold text-xl">
                لیست پلان ها سال {{ new Date().getFullYear() - 621 }}
            </h1>
            <table class="table-auto w-full text-center">
                <thead class="bg-gray-200 border-t-4 border-gray-400 rounded-md">
                    <tr>
                        <th class="py-3">شماره</th>
                        <th class="py-3">موضوع پلان</th>
                        <th class="py-3">تاریخ</th>
                        <th class="py-3">فایل</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in plans" :key="index">
                        <td class="border-b p-4">{{ index + 1 }}</td>
                        <td class="border-b p-4">{{ item.subject }}</td>
                        <td class="border-b p-4">
                            {{ item.year }}
                        </td>
                        <td class="border-b p-4">
                            <a :href="item.document_path"
                                class="bg-blue-500 inline-block py-2 rounded-lg cursor-pointer text-white px-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="bg-white rounded-lg shadow-lg">
            <h1 class="border-b-gray-300 mt-3 mb-3 mx-5 font-bold text-xl">
                لیست کمته ها سال {{ new Date().getFullYear() - 621 }}
            </h1>
            <table class="table w-full text-center">
                <thead class="bg-gray-200 border-t-4 border-gray-400 rounded-md">
                    <tr>
                        <th class="py-3">شماره</th>
                        <th class="py-3">نام کمیته</th>
                        <th class="py-3">تعداد اعضای</th>
                        <th class="py-3">فایل</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(item, index) in committee" :key="index">
                        <td class="border-b p-4">{{ index + 1 }}</td>
                        <td class="border-b p-4">{{ item.name }}</td>
                        <td class="border-b p-4">{{ item.members_count }}</td>
                        <td class="border-b p-4">
                            <a :href="item.attachment_path"
                                class="bg-blue-500 inline-block py-2 rounded-lg cursor-pointer text-white px-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from "vue";
import axiosClient from "../../axios";

const plans = ref([]);
const committee = ref([]);

const fetchData = async () => {
    try {
        const response = await axiosClient.get(`/pdc/report/plans_commit`);
        plans.value = response.data.new_plan;
        committee.value = response.data.committee;
    } catch (errors) {
        console.error(errors);
    }
};

onMounted(() => {
    fetchData();
});
</script>
