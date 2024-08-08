<template>
    <div class="grid gap-3 mt-4 mb-3">
        <div class="bg-white shadow-lg rounded-lg">
            <div class="w-full font-bold text-xl border-b py-3 px-4">
                نمایش گرافیکی تعداد استادان بر اساس درجه تحصیل
            </div>
            <Chart
                type="bar"
                class="h-[30rem]"
                :data="chartTeacher"
                :options="chartOptions"
            />
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import Chart from "primevue/chart";
import axiosClient from "../../axios";

const chartTeacher = ref(null);

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
                text: "درجه تحصیل",
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
            "/teacher_department/report/teachaers"
        );
        const data = response.data;
        const teachers = [];
        teachers.push(data.total_master_teacher);
        teachers.push(data.total_doctor_teacher);
        const colors=["#3b82f6","#757575"]
        chartTeacher.value = {
            labels: ["ماستر", "داکتر"],
            datasets: [
                {
                    label: "استادان تعداد",
                    backgroundColor: colors,
                    data: teachers,
                },
            ],
        };
    } catch (error) {
        console.error("Error fetching data:", error);
    }
};


onMounted(() => {
    fetchChartTeacherData();
});
</script>

<style>
/* Add any styles you need for your chart */
</style>
