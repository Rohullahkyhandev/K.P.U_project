<!-- <template>
    <div class="container mx-auto my-10">
        <div class="flex flex-col items-center">
            <StaffNode name="CEO" imgSrc="https://via.placeholder.com/150" />
            <div class="line-vertical my-2"></div>
            <div class="flex justify-around w-full">
                <div class="flex flex-col items-center">
                    <StaffNode
                        name="CTO"
                        imgSrc="https://via.placeholder.com/150"
                    />
                    <div class="line-vertical my-2"></div>
                    <div class="flex justify-around w-full">
                        <div class="flex flex-col items-center">
                            <StaffNode
                                name="Lead Developer"
                                imgSrc="https://via.placeholder.com/150"
                            />
                            <div class="line-vertical my-2"></div>
                            <div class="flex justify-around w-full">
                                <StaffNode
                                    name="Developer"
                                    imgSrc="https://via.placeholder.com/150"
                                />
                                <StaffNode
                                    name="Developer"
                                    imgSrc="https://via.placeholder.com/150"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col items-center">
                    <StaffNode
                        name="CFO"
                        imgSrc="https://via.placeholder.com/150"
                    />
                    <div class="line-vertical my-2"></div>
                    <div class="flex justify-around w-full">
                        <StaffNode
                            name="Accountant"
                            imgSrc="https://via.placeholder.com/150"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { defineComponent } from "vue";

const StaffNode = defineComponent({
    props: {
        name: String,
        imgSrc: String,
    },
    template: `
      <div class="flex flex-col items-center">
        <img :src="imgSrc" alt="staff image" class="w-24 h-24 rounded-full border-4 border-blue-500" />
        <div class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-2 w-32 text-center">
          {{ name }}
        </div>
      </div>
    `,
});
</script>

<style scoped>
.container {
    max-width: 800px;
}

.line-vertical {
    width: 2px;
    height: 50px;
    background-color: #000;
}

.line-horizontal {
    width: 100%;
    height: 2px;
    background-color: #000;
    position: relative;
    top: -1px;
}
</style> -->

<!--  year selector -->

<!-- <template>
    <div class="container mx-auto py-10">
        <div class="flex flex-col items-center">
            <div class="flex items-center space-x-4">
                <button
                    @click="prevYear"
                    class="bg-blue-500 text-white px-3 py-1 rounded-lg shadow hover:bg-blue-600 transition"
                >
                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 19l-7-7 7-7"
                        ></path>
                    </svg>
                </button>
                <div class="text-lg font-semibold">{{ persianYear }}</div>
                <button
                    @click="nextYear"
                    class="bg-blue-500 text-white px-3 py-1 rounded-lg shadow hover:bg-blue-600 transition"
                >
                    <svg
                        class="w-6 h-6"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5l7 7-7 7"
                        ></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";

let currentDate = new Date();
let currentYear = currentDate.getFullYear();
let currentMonth = currentDate.getMonth();
let currentDay = currentDate.getDate();

let persianYear = ref(
    gregorianToJalali(currentYear, currentMonth + 1, currentDay)[0]
);

function gregorianToJalali(gy, gm, gd) {
    const g_d_m = [0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334];
    let jy = gy <= 1600 ? 0 : 979;
    gy -= gy <= 1600 ? 621 : 1600;
    let gy2 = gm > 2 ? gy + 1 : gy;
    let days =
        365 * gy +
        Math.floor((gy2 + 3) / 4) -
        Math.floor((gy2 + 99) / 100) +
        Math.floor((gy2 + 399) / 400) -
        80 +
        gd +
        g_d_m[gm - 1];
    jy += 33 * Math.floor(days / 12053);
    days %= 12053;
    jy += 4 * Math.floor(days / 1461);
    days %= 1461;
    if (days > 365) {
        jy += Math.floor((days - 1) / 365);
        days = (days - 1) % 365;
    }
    const jm =
        days < 186
            ? 1 + Math.floor(days / 31)
            : 7 + Math.floor((days - 186) / 30);
    const jd = 1 + (days < 186 ? days % 31 : (days - 186) % 30);
    return [jy, jm, jd];
}

const prevYear = () => {
    persianYear.value--;
};

const nextYear = () => {
    persianYear.value++;
};
</script>

 <style scoped>
.container { max-width: 400px; }
</style> -->
<template>
    <div class="container mx-auto py-10">

        <select
            id="time"
            v-model="selectedTime"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
            @input="filterTimes"
        >
            <option v-for="time in filteredTimes" :key="time" :value="time">
                {{ time }}
            </option>
        </select>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";

// Generate arrays for hours (1-12), minutes (00-59), and AM/PM
const hours = [...Array(12).keys()].map((hour) => (hour === 0 ? 12 : hour));
const minutes = [...Array(60).keys()].map((minute) =>
    minute < 10 ? "0" + minute : minute
);
const amPm = ["AM", "PM"];

// Combine hours and minutes with AM/PM options
const times = ref([]);
hours.forEach((hour) => {
    minutes.forEach((minute) => {
        amPm.forEach((period) => {
            times.value.push(`${hour}:${minute} ${period}`);
        });
    });
});

// Selected time state
const selectedTime = ref(null);

// Search query state
const searchQuery = ref("");

// Filter times based on search query
const filteredTimes = computed(() => {
    if (!searchQuery.value) return times.value;
    return times.value.filter((time) =>
        time.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

// Function to update filtered times when search query changes
const filterTimes = () => {
    // Trigger computed property recalculation
};
</script>

<style scoped>
.container {
    max-width: 400px;
}
</style>

<!-- <template>
    <div class="container mx-auto py-10">
        <label for="date" class="block text-sm font-medium text-gray-700"
            >Select Date</label
        >
        <select
            id="date"
            v-model="selectedDate"
            class="block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
        >
            <option v-for="date in dates" :key="date" :value="date">
                {{ date }}
            </option>
        </select>
    </div>
</template>

<script setup>
import { ref } from "vue";

// Generate arrays for Persian years, months, and days
const years = [...Array(151).keys()].map((year) => 1300 + year);
const months = [
    "Farvardin",
    "Ordibehesht",
    "Khordad",
    "Tir",
    "Mordad",
    "Shahrivar",
    "Mehr",
    "Aban",
    "Azar",
    "Dey",
    "Bahman",
    "Esfand",
];
const days = [...Array(31).keys()].map((day) => day + 1);

// Generate all possible Persian dates
const dates = ref([]);
years.forEach((year) => {
    months.forEach((month, monthIndex) => {
        const daysInMonth = getDaysInMonth(year, monthIndex);
        for (let day = 1; day <= daysInMonth; day++) {
            dates.value.push(`${year}/${monthIndex + 1}/${day}`);
        }
    });
});

// Selected date state
const selectedDate = ref(null);

// Function to get the number of days in a month
function getDaysInMonth(year, month) {
    return month < 6 ? 31 : month < 11 ? 30 : (year % 33) % 4 === 1 ? 30 : 29;
}
</script>

<style scoped>
.container {
    max-width: 400px;
}
</style> -->


