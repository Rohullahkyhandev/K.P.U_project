<template>
    <div class="card grid grid-cols-2 gap-3">
        <div class="m-3 bg-white rounded-lg p-4">
            <h1 class="font-semibold mb-3 flex items-center gap-2">
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
                        d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18"
                    />
                </svg>
                نمایش گرافیکی دیتای استادان
            </h1>
            <Chart
                type="bar"
                :data="chartData"
                :options="chartOptions"
                class="h-[30rem]"
            />
        </div>
        <div class="m-3 bg-white rounded-lg p-4">
            <h1 class="font-semibold mb-3 flex items-center gap-2">
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
                        d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18"
                    />
                </svg>
                محاثبه گرافیکی تعداد مکتوب های صادره و وراده ماه وار
            </h1>
            <Chart
                type="bar"
                :data="chartData"
                :options="chartOptions"
                class="h-[30rem]"
            />
        </div>
    </div>
</template>

<script setup>
import Chart from "primevue/chart";
import { ref, onMounted } from "vue";

onMounted(() => {
    chartData.value = setChartData();
    chartOptions.value = setChartOptions();
});

const chartData = ref();
const chartOptions = ref();

const setChartData = () => {
    const documentStyle = getComputedStyle(document.documentElement);

    return {
        labels: [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
        ],
        datasets: [
            {
                label: "تعداد مکتوب های صادره ",
                backgroundColor: documentStyle.getPropertyValue("--p-cyan-500"),
                borderColor: documentStyle.getPropertyValue("--p-cyan-500"),
                data: [65, 59, 80, 81, 56, 55, 40],
            },
            {
                label: "تعداد مکتوب های وارده",
                backgroundColor: documentStyle.getPropertyValue("--p-gray-500"),
                borderColor: documentStyle.getPropertyValue("--p-gray-500"),
                data: [28, 48, 40, 19, 86, 27, 90],
            },

            {
                label: "تعداد مکتوب های وارده",
                backgroundColor: documentStyle.getPropertyValue("--p-gray-500"),
                borderColor: documentStyle.getPropertyValue("--p-gray-500"),
                data: [28, 48, 40, 19, 86, 27, 90],
            },
        ],
    };
};
const setChartOptions = () => {
    const documentStyle = getComputedStyle(document.documentElement);
    const textColor = documentStyle.getPropertyValue("--p-text-color");
    const textColorSecondary = documentStyle.getPropertyValue(
        "--p-text-muted-color"
    );
    const surfaceBorder = documentStyle.getPropertyValue(
        "--p-content-border-color"
    );

    return {
        maintainAspectRatio: false,
        aspectRatio: 0.8,
        plugins: {
            legend: {
                labels: {
                    color: textColor,
                },
            },
        },
        scales: {
            x: {
                ticks: {
                    color: textColorSecondary,
                    font: {
                        weight: 500,
                    },
                },
                grid: {
                    display: false,
                    drawBorder: false,
                },
            },
            y: {
                ticks: {
                    color: textColorSecondary,
                },
                grid: {
                    color: surfaceBorder,
                    drawBorder: false,
                },
            },
        },
    };
};
</script>
