<template>
    <Bar id="my-chart-id" :options="chartOptions" :data="chartData" />
</template>

<script>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
import { ref } from 'vue'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

export default {
    name: 'BarChart',
    components: { Bar },
    data() {
        return {
            chartData: {
                labels: ['January', 'February', 'March', 'April', 'Jun'],
                datasets: [
                    {
                        data: [40, 20, 12, 90, 56.6],
                        backgroundColor: ['#326854', '#2A5286', '#862A2A'],
                        label: "Send Documents"
                    },
                ],
            },
            chartOptions: {
                responsive: true
            }
        }
    }
}
</script>
