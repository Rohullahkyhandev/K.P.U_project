import { defineStore } from "pinia";
import { ref } from "vue";

let useDateStore = defineStore("date", () => {
    let getCurrentPersianYear = () => {
        let now = new Date();
        let gYear = now.getFullYear();
        let gMonth = now.getMonth() + 1;
        let gDay = now.getDate();

        let persianDate = toPersianDate(gYear, gMonth, gDay);
        return persianDate.year;
    };

    // Conversion function from Gregorian to Persian
    let toPersianDate = (gYear, gMonth, gDay) => {
        let gDaysInMonth = [
            31,
            (gYear % 4 === 0 && gYear % 100 !== 0) || gYear % 400 === 0
                ? 29
                : 28,
            31,
            30,
            31,
            30,
            31,
            31,
            30,
            31,
            30,
            31,
        ];
        let pDaysInMonth = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29];
        let gDayNo =
            gDay + gDaysInMonth.slice(0, gMonth - 1).reduce((a, b) => a + b, 0);
        let pDayNo = gDayNo - 79;
        let pYear = gYear - 621;
        let pMonth, pDay;

        if (pDayNo <= 186) {
            pMonth = Math.ceil(pDayNo / 31);
            pDay = pDayNo % 31 || 31;
        } else {
            pMonth = Math.ceil((pDayNo - 186) / 30);
            pDay = (pDayNo - 186) % 30 || 30;
            pYear += 1;
        }

        return { year: pYear, month: pMonth, day: pDay };
    };

    // Generate an array of years, e.g., from 1300 to 1500
    let currentYear = getCurrentPersianYear();
    let years = Array.from({ length: 101 }, (_, i) => currentYear - 50 + i);

    let selectedYear = ref(currentYear);

    return {
        selectedYear,
        years,
    };
});

export default useDateStore;
