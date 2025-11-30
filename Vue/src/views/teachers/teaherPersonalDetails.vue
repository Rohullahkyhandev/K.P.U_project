<template>
    <div class="container">
        <table>
            <thead class="w-full">
                <tr>
                    <th style="text-align: center; margin: auto" colspan="3">
                        <img :src="KPU_LOGO" width="80px" class="ml-8" alt="KPU Logo">
                    </th>
                    <th style="text-align: center; margin: auto; font-size: 20px !important;" colspan="24">
                        هر استاد باید از صحت بودن شهرت و معلومات کادری خویش اطمینان دهدو کالم های که خالی هستند خانه
                        پری
                        نماید.
                    </th>
                    <th style="text-align: center; margin: auto;" colspan="3">
                        <img :src="EMIRATE_LOGO" width="80px" class="ml-5" alt="Islamic Emirtate">
                    </th>
                </tr>
            </thead>
            <thead>
                <tr>
                    <th class="2" rowspan="3">
                        لیسان های خارجی</th>
                    <th colspan="12">تحصیلات</th>
                    <th rowspan="3">موقف اداری</th>
                    <th colspan="2">شیوه ارتباط</th>
                    <th colspan="4">بورس طول المدت
                    </th>
                    <th colspan="7">ملومات کادری
                    </th>
                    <th colspan="3">َشهرت</th>
                </tr>
                <tr>
                    <th colspan="4">لیسانس</th>
                    <th colspan="4">ماستری</th>
                    <th colspan="4">دوکتورا</th>
                    <th rowspan="2">ایمیل ادرس</th>
                    <th rowspan="2">شماره تماس</th>
                    <th rowspan="2">تاریخ برگشت</th>
                    <th rowspan="2">تاریخ اعزام</th>
                    <th rowspan="2">کشور</th>
                    <th rowspan="2">مقطع</th>
                    <th rowspan="2">جنسیت</th>
                    <th rowspan="2">دیپارتمنت</th>
                    <th rowspan="2">پوهنځی</th>
                    <th rowspan="2">تاریخ آخرین ترفیع</th>
                    <th rowspan="2">تاریخ تقرر در کادر علمی</th>
                    <th rowspan="2">سال تولد</th>
                    <th rowspan="2">رتبه علمی</th>
                    <th rowspan="2">ولد</th>
                    <th rowspan="2">تخلص</th>
                    <th rowspan="2">اسم</th>
                </tr>
                <tr>
                    <th>ریشته تحصیلی</th>
                    <th>سال فراغت</th>
                    <th>سال شمولیت</th>
                    <th>کشور</th>
                    <th>ریشته تحصیلی</th>
                    <th>سال فراغت</th>
                    <th>سال شمولیت</th>
                    <th>کشور</th>
                    <th>ریشته تحصیلی</th>
                    <th>سال فراغت</th>
                    <th>سال شمولیت</th>
                    <th>کشور</th>
                </tr>
            </thead>
            <tbody>

                <tr v-for="(data, index) in teacher_data" :key="index">

                    <td>
                        <ul v-if="data.languages">
                            <li v-for="(language, index) in data.languages" :key="index">{{ language }}</li>
                        </ul>
                    </td>
                    <template v-for="(teacher_qualification, index) in data.qualifications" :key="index">

                        <template v-if="data.qualifications.length == 1">
                            <td>{{ teacher_qualification.edu_field }}</td>
                            <td>{{ teacher_qualification.grad_year }}</td>
                            <td>{{ teacher_qualification.admission_year }}</td>
                            <td>{{ teacher_qualification.cname }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </template>
                        <template v-else-if="data.qualifications.length == 2">
                            <template v-if='index === 0'>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </template>
                            <td>{{ teacher_qualification.edu_field }}</td>
                            <td>{{ teacher_qualification.grad_year }}</td>
                            <td>{{ teacher_qualification.admission_year }}</td>
                            <td>{{ teacher_qualification.cname }}</td>
                        </template>
                        <template v-else>
                            <td>{{ teacher_qualification.edu_field }}</td>
                            <td>{{ teacher_qualification.grad_year }}</td>
                            <td>{{ teacher_qualification.admission_year }}</td>
                            <td>{{ teacher_qualification.cname }}</td>
                        </template>
                    </template>

                    <td>
                        <span v-if="data.code_bast_in_letter == 2">
                            آمر دیپارتمنت
                        </span>
                        <span v-else>
                            ندارد
                        </span>
                    </td>
                    <td>{{ data.phone }}</td>
                    <td>{{ data.email }}</td>
                    <td>
                        <span v-if="data.scholarships.back_date != null">
                            {{ data.scholarships.back_date }}
                        </span>
                        <span v-else-if="data.scholarships != null && data.scholarships.back_date == null">
                            مصروف تحصیل
                        </span>
                    </td>
                    <td>{{ data.scholarships.sent_date }}</td>
                    <td>{{ data.scholarships.country_name }}</td>
                    <td>{{ data.scholarships.edu_maqta }}</td>
                    <td>{{ data.gender }}</td>
                    <td>{{ data.department }}</td>
                    <td>{{ data.faculty }}</td>
                    <td>{{ data.p_date }}</td>
                    <td>{{ data.hire_date }}</td>
                    <td>{{ data.birth_date }}</td>
                    <td>{{ data.academic_rank }}</td>
                    <td>{{ data.fname }}</td>
                    <td>{{ data.lname }}</td>
                    <td>{{ data.name }}</td>
                </tr>

                <!-- print area button  -->
                <div class="absolute print--hide flex gap-4  bottom-3 right-20 bg-gray-600/20 w-64 py-3 px-2 ">
                    <router-link :to="{ name: 'app.teacher.list' }" class="header--button" @click="printPage">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                        Cancel
                    </router-link>
                    <button class="header--button" @click="printPage">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                        </svg>
                        Print
                    </button>
                </div>
            </tbody>
        </table>
    </div>
</template>
<script setup>
import { onMounted, ref } from "vue";
import axiosClient from "../../axios";
import KPU_LOGO from "../../../public/kpu_logo.png"
import EMIRATE_LOGO from "../../../public/emirate_logo.png"


const teacher_data = ref([]);
let counter = 1;
const itemsPerPage = 50;

onMounted(() => {
    getTeacherData();  // Call the function to fetch data on mounting the component.
})

const getTeacherData = async () => {
    try {
        const response = await axiosClient.get('/teacher/personal_info')
        console.log(response.data);

        teacher_data.value = response.data;
    } catch (e) {
        console.log(e);
    }
}



// Print the current page
const printPage = () => {
    window.print();
};

</script>

<style scoped>
.container {
    margin: 5px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th {
    font-size: 8px;
    background-color: #b7b4b4;

}

span {
    font-size: 7px !important;
}

td {
    font-size: 7px;
}

th,
td {
    border: 1px solid black;
    text-align: center;

}

@media print {
    @page {
        size: landscape !important;
    }

    .print--hide {
        display: none;

    }

    th {
        background-color: #b7b4b4;
    }
}
</style>
