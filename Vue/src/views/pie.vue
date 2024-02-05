
<template>
    <Pie :data="chertData" :options="options" />
</template>

<script>
import { Pie } from 'vue-chartjs'
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
ChartJS.register(ArcElement, Tooltip, Legend)

export default {
    name: 'App',
    components: {
        Pie
    },
    data() {
        return {
            chertData: {
                labels: ['January', 'February', 'March', 'April', 'Jun'],
                datasets: [
                    {
                        backgroundColor: ['#41B883', '#E46651', '#00D8FF', '#DD1B16'],
                        data: [40, 20, 80, 10],
                        label: ['Customer Sales Internet '],
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        }

    }

}
</script>
