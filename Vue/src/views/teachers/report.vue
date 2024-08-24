<template>
    <main>
        <div class="table--wrapper">
            <table dir="rtl">
                <thead class="w-full">
                    <tr>
                        <th style="text-align: center; margin: auto;border: none;" colspan="3">
                            <div class="flex mr-10">
                                <img :src="EmirateLogo" width="80px" class="ml-5" alt="Islamic Emirtate">
                                <div>
                                    <p class="font-bold"> د افغانستان اسلامی امارت</p>
                                    <p class="font-bold">دلوړو زده کرو وزارت</p>
                                </div>
                            </div>
                        </th>
                        <th style="text-align: center; margin: auto; font-size: 20px !important;border: none;"
                            colspan="26">
                            <p>Islamic Emirate of Afghanistan</p>
                            <p class="font-bold">Ministry of Higher Education</p>
                            <p>ریاست پوهنتون پولی تخنیک کابل</p>
                            <p> معاونیت علمی</p>
                            <p> آمریت انسجام امور استادان</p>
                            <br>
                        </th>
                        <th style="text-align: center; margin-right:auto; position: relative; border: none;"
                            colspan="20">
                            <div class="flex text-center mr-32">
                                <div class="ml-5">
                                    <p class="font-bold">امارت اسلامی افغانستان</p>
                                    <p class="font-bold">وزارت تحصیلات عالی</p>
                                </div>
                                <img :src="HigherEducationLogo" width="80px" alt="KPU Logo">
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="49" style="text-align: start; border: none">جدول شماره ( )</th>
                    </tr>
                </thead>

                <thead>
                    <tr>
                        <th colspan="40" class="font-bold text-xl">
                            جدول احصایوی استادان پوهنتون پولی تخنیک کابل به تفکیک پوهنځی و دیپارتمنت سال {{ (new
                                Date().getFullYear()) - 621 }}
                        </th>
                        <th rowspan="2" colspan="10">مصروف تحصیل</th>
                    </tr>
                    <tr>
                        <th rowspan="3" style="rotate: 90deg;">شماره</th>
                        <th rowspan="3" style="text-align: center;">اسم پوهنځی</th>
                        <th rowspan="3" style="text-align: center;">دیپارتمنت</th>
                        <th colspan="9">تعداد استادان به تفکیک درجه تحصیل</th>
                        <th colspan="17">تعداد استادان به تفکیک رتبه علمی</th>
                        <th colspan="17">تعداد استادان به تفکیک بست کاری</th>
                    </tr>
                    <tr>
                        <th colspan="2">داکتر</th>
                        <th colspan="2">ماستر</th>
                        <th colspan="2">لیسانس</th>
                        <th colspan="3">مجموع</th>
                        <th colspan="2">پوهاند</th>
                        <th colspan="2">پوهنوال</th>
                        <th colspan="2">پوهندوی</th>
                        <th colspan="2">پوهنمل</th>
                        <th colspan="2">پوهنیار</th>
                        <th colspan="2">پوهیالی</th>
                        <th colspan="2">نامزاد پوهنیار</th>
                        <th colspan="3">مجموع</th>
                        <th colspan="2">اول</th>
                        <th colspan="2">دوم</th>
                        <th colspan="2">سوم</th>
                        <th colspan="2">جهارم</th>
                        <th colspan="3">مجموع</th>
                        <th colspan="2">داکتر</th>
                        <th colspan="2">ماستر</th>

                    </tr>
                    <tr>
                        <td>ذکور</td>
                        <td>اناث</td>
                        <td>ذکور</td>
                        <td>اناث</td>
                        <td>ذکور</td>
                        <td>اناث</td>
                        <td>ذکور</td>
                        <td>اناث</td>
                        <td>مجموع</td>
                        <td>ذکور</td>
                        <td>اناث</td>
                        <td>ذکور</td>
                        <td>اناث</td>
                        <td>ذکور</td>
                        <td>اناث</td>
                        <td>ذکور</td>
                        <td>اناث</td>
                        <td>ذکور</td>
                        <td>اناث</td>
                        <td>ذکور</td>
                        <td>اناث</td>
                        <td>ذکور</td>
                        <td>اناث</td>
                        <td>ذکور</td>
                        <td>اناث</td>
                        <td>مجموع</td>
                        <td>ذکور</td>
                        <td>اناث</td>
                        <td>ذکور</td>
                        <td>اناث</td>
                        <td>ذکور</td>
                        <td>اناث</td>
                        <td>ذکور</td>
                        <td>اناث</td>
                        <td>ذکور</td>
                        <td>اناث</td>
                        <td>مجموع</td>
                        <td>ذکور</td>
                        <td>اناث</td>
                        <td>ذکور</td>
                        <td>اناث</td>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="(faculty, index) in data" :key="index">
                        <tr v-for="(department, indexDep) in faculty.departments" :key="indexDep">
                            <td v-if="indexDep == 0" :rowspan="faculty.department_length">{{ index + 1 }}</td>
                            <td v-if="indexDep == 0" :rowspan="faculty.department_length" style="text-align: right;">{{
                                faculty.faculty_name
                            }} </td>
                            <td style="text-align: right;">{{ department.department_name }}</td>
                            <td>{{ department.total_doctor_male_teacher_in_department }}</td>
                            <td>{{ department.total_doctor_female_teacher_in_department }}</td>
                            <td>{{ department.total_master_male_teacher_in_department }}</td>
                            <td>{{ department.total_master_female_teacher_in_department }}</td>
                            <td>{{ department.total_bachelor_male_teacher_in_department }}</td>
                            <td>{{ department.total_bachelor_female_teacher_in_department }}</td>
                            <td>{{ department.total_male_teacher_in_department }}</td>
                            <td>{{ department.total_female_teacher_in_department }}</td>
                            <td>{{ department.total_teacher_in_department }}</td>
                            <!--  academic rank -->
                            <td>{{ department.total_pohand_male_teacher_in_department }}</td>
                            <td>{{ department.total_pohand_female_teacher_in_department }}</td>
                            <td>{{ department.total_pohandval_male_teacher_in_department }}</td>
                            <td>{{ department.total_pohandval_female_teacher_in_department }}</td>
                            <td>{{ department.total_pohandoie_male_teacher_in_department }}</td>
                            <td>{{ department.total_pohandoie_female_teacher_in_department }}</td>
                            <td>{{ department.total_pohanmal_male_teacher_in_department }}</td>
                            <td>{{ department.total_pohanmal_female_teacher_in_department }}</td>
                            <td>{{ department.total_poh‌nyar_male_teacher_in_department }}</td>
                            <td>{{ department.total_poh‌nyar_female_teacher_in_department }}</td>
                            <td>{{ department.total_poh‌yali_male_teacher_in_department }}</td>
                            <td>{{ department.total_poh‌yali_female_teacher_in_department }}</td>
                            <td>{{ department.total_namzadpohanyar_male_teacher_in_department }}</td>
                            <td>{{ department.total_namzadpohanyar_female_teacher_in_department }}</td>
                            <td>{{ department.total_dmb_male_in_department }}</td>
                            <td>{{ department.total_dmb_female_in_department }}</td>
                            <td>{{ department.total_dmb_in_department }}</td>
                            <td>{{ department.total_first_bast_male_teacher_in_department }}</td>
                            <td>{{ department.total_first_bast_female_teacher_in_department }}</td>
                            <td>{{ department.total_second_bast_male_teacher_in_department }}</td>
                            <td>{{ department.total_second_bast_female_teacher_in_department }}</td>
                            <td>{{ department.total_third_bast_male_teacher_in_department }}</td>
                            <td>{{ department.total_third_bast_female_teacher_in_department }}</td>
                            <td>{{ department.total_forth_bast_male_teacher_in_department }}</td>
                            <td>{{ department.total_forth_bast_female_teacher_in_department }}</td>
                            <td>{{ department.total_dmb_male_in_department }}</td>
                            <td>{{ department.total_dmb_female_in_department }}</td>
                            <td>{{ department.total_dmb_in_department }}</td>
                            <td>{{ department.total_doctor_male_teacher_scholarship }}</td>
                            <td>{{ department.total_doctor_female_teacher_scholarship }}</td>
                            <td>{{ department.total_master_male_teacher_scholarship }}</td>
                            <td>{{ department.total_master_female_teacher_scholarship }}</td>

                        </tr>
                        <tr id="total">
                            <th colspan="2">مجموعه</th>
                            <th colspan="1"></th>
                            <th>{{ faculty.total_doctor_male_teacher_entire_faculty }}</th>
                            <th>{{ faculty.total_doctor_female_teacher_entire_faculty }}</th>
                            <th>{{ faculty.total_master_male_teacher_entire_faculty }}</th>
                            <th>{{ faculty.total_master_female_teacher_entire_faculty }}</th>
                            <th>{{ faculty.total_bachelor_male_teacher_entire_faculty }}</th>
                            <th>{{ faculty.total_bachelor_female_teacher_entire_faculty }}</th>
                            <th>{{ faculty.total_male_teacher_entire_faculty }}</th>
                            <th>{{ faculty.total_female_teacher_entire_faculty }}</th>
                            <th>{{ faculty.total_teacher_entire_faculty }}</th>

                            <!-- total calculation -->
                            <th>{{ faculty.total_pohand_male_teacher_in_faculty }}</th>
                            <th>{{ faculty.total_pohand_female_teacher_in_faculty }}</th>
                            <th>{{ faculty.total_pohandval_male_teacher_in_faculty }}</th>
                            <th>{{ faculty.total_pohandval_female_teacher_in_faculty }}</th>
                            <th>{{ faculty.total_pohandoie_male_teacher_in_faculty }}</th>
                            <th>{{ faculty.total_pohandoie_female_teacher_in_faculty }}</th>
                            <th>{{ faculty.total_pohanmal_male_teacher_in_faculty }}</th>
                            <th>{{ faculty.total_pohanmal_female_teacher_in_faculty }}</th>
                            <th>{{ faculty.total_poh‌nyar_male_teacher_in_faculty }}</th>
                            <th>{{ faculty.total_poh‌nyar_female_teacher_in_faculty }}</th>
                            <th>{{ faculty.total_poh‌yali_male_teacher_in_faculty }}</th>
                            <th>{{ faculty.total_poh‌yali_female_teacher_in_faculty }}</th>
                            <th>{{ faculty.total_namzadpohanyar_male_teacher_in_faculty }}</th>
                            <th>{{ faculty.total_namzadpohanyar_female_teacher_in_faculty }}</th>
                            <th>{{ faculty.total_dmb_male_in_faculty }}</th>
                            <th>{{ faculty.total_dmb_female_in_faculty }}</th>
                            <th>{{ faculty.total_dmb_in_faculty }}</th>
                            <th>{{ faculty.total_first_bast_male_teacher_in_faculty }}</th>
                            <th>{{ faculty.total_first_bast_female_teacher_in_faculty }}</th>
                            <th>{{ faculty.total_second_bast_male_teacher_in_faculty }}</th>
                            <th>{{ faculty.total_second_bast_female_teacher_in_faculty }}</th>
                            <th>{{ faculty.total_third_bast_male_teacher_in_faculty }}</th>
                            <th>{{ faculty.total_third_bast_female_teacher_in_faculty }}</th>
                            <th>{{ faculty.total_forth_bast_male_teacher_in_faculty }}</th>
                            <th>{{ faculty.total_forth_bast_female_teacher_in_faculty }}</th>
                            <th>{{ faculty.total_dmb_male_in_faculty }}</th>
                            <th>{{ faculty.total_dmb_female_in_faculty }}</th>
                            <th>{{ faculty.total_dmb_in_faculty }}</th>
                            <th>{{ faculty.total_doctor_male_teacher_scholarship }}</th>
                            <th>{{ faculty.total_doctor_female_teacher_scholarship }}</th>
                            <th>{{ faculty.total_master_male_teacher_scholarship }}</th>
                            <th>{{ faculty.total_master_female_teacher_scholarship }}</th>
                        </tr>
                    </template>
                    <template v-for="(total, index) in total_data" :key="index">
                        <tr id="total">
                            <th colspan="1">#</th>
                            <th colspan="2">مجموعه کلی پوهنځی ها</th>
                            <th>{{ total.total_doctor_male_teacher }}</th>
                            <th>{{ total.total_doctor_female_teacher }}</th>
                            <th>{{ total.total_master_male_teacher }}</th>
                            <th>{{ total.total_master_female_teacher }}</th>
                            <th>{{ total.total_bachelor_male_teacher }}</th>
                            <th>{{ total.total_bachelor_female_teacher }}</th>
                            <th>{{ total.total_male_teacher }}</th>
                            <th>{{ total.total_female_teacher }}</th>
                            <th>{{ total.total_teacher_in_university }}</th>
                            <th>{{ total.total_pohand_male_teacher }}</th>
                            <th>{{ total.total_pohand_female_teacher }}</th>
                            <th>{{ total.total_pohandval_male_teacher }}</th>
                            <th>{{ total.total_pohandval_female_teacher }}</th>
                            <th>{{ total.total_pohandoie_male_teacher }}</th>
                            <th>{{ total.total_pohandoie_female_teacher }}</th>
                            <th>{{ total.total_pohanmal_male_teacher }}</th>
                            <th>{{ total.total_pohanmal_female_teacher }}</th>
                            <th>{{ total.total_poh‌nyar_male_teacher }}</th>
                            <th>{{ total.total_poh‌nyar_female_teacher }}</th>
                            <th>{{ total.total_poh‌yali_male_teacher }}</th>
                            <th>{{ total.total_poh‌yali_female_teacher }}</th>
                            <th>{{ total.total_namzadpohanyar_male_teacher }}</th>
                            <th>{{ total.total_namzadpohanyar_female_teacher }}</th>
                            <th>{{ total.total_male_teacher }}</th>
                            <th>{{ total.total_female_teacher }}</th>
                            <th>{{ total.total_teacher_in_university }}</th>
                            <th>{{ total.total_first_bast_male_teacher }}</th>
                            <th>{{ total.total_first_bast_female_teacher }}</th>
                            <th>{{ total.total_second_bast_male_teacher }}</th>
                            <th>{{ total.total_second_bast_female_teacher }}</th>
                            <th>{{ total.total_third_bast_male_teacher }}</th>
                            <th>{{ total.total_third_bast_female_teacher }}</th>
                            <th>{{ total.total_forth_bast_male_teacher }}</th>
                            <th>{{ total.total_forth_bast_female_teacher }}</th>
                            <th>{{ total.total_male_teacher }}</th>
                            <th>{{ total.total_female_teacher }}</th>
                            <th>{{ total.total_teacher_in_university }}</th>
                            <th>{{ total.total_doctor_male_teacher_scholarship }}</th>
                            <th>{{ total.total_doctor_female_teacher_scholarship }}</th>
                            <th>{{ total.total_master_male_teacher_scholarship }}</th>
                            <th>{{ total.total_master_female_teacher_scholarship }}</th>
                        </tr>
                    </template>
                    <br>
                    <tr>
                        <td style="border: 0px;" colspan="15">
                            <span>امضاء</span>
                            <span>..................................</span>
                        </td>

                        <td style="border: 0px;" colspan="15">
                            <span>امضاء</span>
                            <span>..................................</span>
                        </td>

                        <td style="border: 0px;" colspan="15">
                            <span>امضاء</span>
                            <span>..................................</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</template>
<script setup>
import { onMounted, ref } from "vue";
import axiosClient from "../../axios";
import HigherEducationLogo from "../../../public/higer_education_logo.png"
import EmirateLogo from "../../../public/emirate_logo.png"

const data = ref([]);
const total_data = ref([]);
const itemPerpage = 1;


onMounted(() => {
    getData();

});

function getData() {
    axiosClient.get('/teacher/test')
        .then((res) => {
            data.value = res.data.faculty_department_teacher_data;
            total_data.value = res.data.total_data;
        });
}


// const paginatedData = computed(() => {
//     const result = [];
//     const teachersCopy = [...data.value];
//     for (let i = 0; i < teachersCopy.length; i += itemPerpage) {
//         result.push(teachersCopy.slice(i, i + itemPerpage));
//     }

//     return result;
// });




</script>

<style scoped>
.table--wrapper {
    padding: 3px 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th,
td,
#total {
    font-size: 12px;
    border: 1px solid black;
    padding: 2px;
    text-align: center;
}


th[colspan] {
    text-align: center;
}
</style>
