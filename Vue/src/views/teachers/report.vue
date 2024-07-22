<template>
    <div class="p-6">
        <table>
            <thead>
                <tr>
                    <th colspan="15">
                        جدول احصایه وی استادان پولی تخنیک کابل به تفکیک درجه
                        تحصیل و سویه علمی
                    </th>
                </tr>
                <tr>
                    <th>شماره</th>
                    <th>دانشکده</th>
                    <!-- <th>مجموع (ذکور)</th>
                    <th>مجموع (اناث)</th>
                    <th>تعداد دیپارتمنت</th> -->
                    <th>دیپارتمنت</th>
                    <th>مجموع</th>
                    <th>مجموع (ذکور)</th>
                    <th>مجموع (اناث)</th>
                    <th>مجموع داکتر (ذکور)</th>
                    <th>مجموع داکتر (اناث)</th>
                    <th>مجموع ماستر (ذکور)</th>
                    <th>مجموع ماستر (ذکور)</th>
                    <th>مجموع لیسانس (ذکور)</th>
                    <th>مجموع لیسانس (ذکور)</th>
                </tr>
            </thead>

            <tbody>
                <template
                    v-for="(faculties, counter) in reportStore.teacherlist"
                >
                    <tr
                        v-for="(department, index) in faculties.departments"
                        :key="index"
                    >
                        <template v-if="index == 0">
                            <td :rowspan="faculties.faculty_departments_length">
                                {{ counter + 1 }}
                            </td>
                            <td
                                style="width: 15%; font-weight: bold"
                                :rowspan="faculties.faculty_departments_length"
                                v-if="faculties.faculty_name != null"
                            >
                                {{ faculties.faculty_name }}
                            </td>
                            <!-- <td
                                style="width: 15%; font-weight: bold"
                                :rowspan="faculties.faculty_departments_length"
                                v-else
                            ></td> -->
                            <!-- <td :rowspan="faculties.faculty_departments_length">
                                {{ faculties.total_teacher_entire_faculty }}
                            </td>
                            <td :rowspan="faculties.faculty_departments_length">
                                {{
                                    faculties.total_male_teacher_entire_faculty
                                }}
                            </td>
                            <td :rowspan="faculties.faculty_departments_length">
                                {{
                                    faculties.total_female_teacher_entire_faculty
                                }}
                            </td>
                            <td :rowspan="faculties.faculty_departments_length">
                                {{ faculties.faculty_departments_length }}
                            </td> -->
                        </template>

                        <td style="width: 15%; font-weight: bold">
                            {{ department.department_name }}
                        </td>
                        <td>{{ department.total_teacher_in_department }}</td>
                        <td>
                            {{ department.total_male_teacher_in_department }}
                        </td>
                        <td>
                            {{ department.total_female_teacher_in_department }}
                        </td>
                        <td>
                            {{
                                department.total_doctor_male_teacher_in_department
                            }}
                        </td>
                        <td>
                            {{
                                department.total_doctor_female_teacher_in_department
                            }}
                        </td>
                        <td>
                            {{
                                department.total_master_male_teacher_in_department
                            }}
                        </td>
                        <td>
                            {{
                                department.total_master_female_teacher_in_department
                            }}
                        </td>
                        <td>
                            {{
                                department.total_bachelor_male_teacher_in_department
                            }}
                        </td>
                        <td>
                            {{
                                department.total_bachelor_female_teacher_in_department
                            }}
                        </td>
                        <!-- <td>
                             {{ teachers }}
                        </td> -->
                    </tr>
                </template>
                <tr
                    v-for="(faculties, index) in reportStore.teacherlist"
                    :key="index"
                ></tr>
            </tbody>
        </table>
    </div>
</template>
<script setup>
import { computed, onMounted, ref } from "vue";
import useRportStore from "../../stores/report/pdcTeacherInCommitStore";
const reportStore = useRportStore();

onMounted(() => {
    reportStore.getTeacherList();
});
const teachers = computed(() =>
    reportStore.teacherlist.map((teacher) => teacher.departments)
);
</script>

<style scoped>
table {
    direction: rtl;
    border: 1px silver solid;
}
th,
td {
    border: 1px silver solid;
    padding: 8px;
    text-align: center;
}
</style>
