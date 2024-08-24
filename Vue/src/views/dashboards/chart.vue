<template>
    <div class="grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1 gap-3 mb-3">
        <div class="bg-white shadow-lg rounded-lg">
            <div class="w-full font-bold text-xl border-b py-3 px-4">
                نمایش گرافیکی تعداد استادان که مصروف تحصیل هستند
            </div>
            <Chart type="bar" class="h-[30rem]" :data="chartTeacher" :options="chartOptions" />
        </div>

        <div class="bg-white shadow-lg rounded-lg">
            <div class="w-full font-bold text-xl border-b py-3 px-4">
                نمایش گرافیکی تعداد مکتوب های صادره و وارده
            </div>
            <div class="w-full">
                <div class="mr-12 mb-4">
                    <Chart type="pie" class="h-[30rem]" :data="chartDocument" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import Chart from "primevue/chart";
import axiosClient from "../../axios";

const chartTeacher = ref(null);
const chartDocument = ref(null);

const chartOptions = {
    maintainAspectRatio: false,
    plugins: {
        legend: {
            display: true,
        },
        tooltip: {
            enabled: true,
        },
    },
    scales: {
        x: {
            display: true,
            title: {
                display: true,
                text: "سال",
            },
        },
        y: {
            display: true,
            title: {
                display: true,
                text: "تعداد",
            },
        },
    },
};

const fetchChartTeacherData = async () => {
    try {
        const response = await axiosClient.get(
            "/pdc/report/teacher_in_scholarship"
        );
        const data = response.data;

        const years = Array.from(
            new Set([
                ...data.masters.map((d) => d.year),
                ...data.doctors.map((d) => d.year),
            ])
        );

        const mastersCounts = years.map((year) => {
            const record = data.masters.find((d) => d.year === year);
            return record ? record.count : 0;
        });

        const doctorsCounts = years.map((year) => {
            const record = data.doctors.find((d) => d.year === year);
            return record ? record.count : 0;
        });

        chartTeacher.value = {
            labels: years,
            datasets: [
                {
                    label: "تعداد استادان در مقطع ماستری",
                    backgroundColor: "#42A5F5",
                    data: mastersCounts,
                },
                {
                    label: "تعداد استادان در مقطع دوکتورا",
                    backgroundColor: "#66BB6A",
                    data: doctorsCounts,
                },
            ],
        };
    } catch (error) {
        console.error("Error fetching data:", error);
    }
};

const fetchChartDocuments = async () => {
    try {
        const response = await axiosClient.get("/pdc/report/total");
        const data = response.data;

        const sendDocs = Array.from(
            new Set([data.total_send_docs])
        );
        const recDocs = Array.from(
            new Set([data.total_rec_docs])
        );

        chartDocument.value = {
            labels: ["مکتوب های صادره", "مکتوب های وارده"],
            datasets: [
                {
                    label: "تعداد مکتوب های صادره",
                    backgroundColor: "#42A5F5",
                    data: sendDocs,
                },
                {
                    label: "تعداد مکتوب های وارده",
                    backgroundColor: "#F97316",
                    data: recDocs,
                },
            ],
        };
    } catch (error) {
        console.error("Error fetching data:", error);
    }
};

onMounted(() => {
    fetchChartTeacherData();
    fetchChartDocuments();
});
</script>

<style>
/* Add any styles you need for your chart */
</style>
