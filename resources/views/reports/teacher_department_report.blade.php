<style>
    body {
        padding: 10px !important;
    }

    table {
        direction: rtl;
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
    }

    th[colspan] {
        text-align: center;
    }
</style>

<table>
    <thead>
        <tr>
            <span style="display: inline-block; float: right">شماره جدول()</span>
        </tr>
    </thead>
    <thead>
        <tr>
            <th colspan="26" style="font-size: bolder; font-weight: 900; font-size: 24px">
                جدول احصایه وی استادان پوهنتون پولی تخنیک کابل به تفکیک
                دانشکده و دیپارتمنت
            </th>
        </tr>
    </thead>
    <thead>
        <tr>
            <th rowspan="3">#</th>
            <th rowspan="3">دانشکده</th>
            <th rowspan="3">دیپارتمنت</th>
            <th colspan="2" rowspan="2">مجموع</th>
            <th colspan="6"
                style="
                        font-size: 20px;
                        font-weight: 900;
                        font-weight: bolder;
                    ">
                تعداد استادان به تفکیک درجه تحصیل
            </th>
            <th colspan="12"
                style="
                        font-size: 20px;
                        font-weight: 900;
                        font-weight: bolder;
                    ">
                تعداد استادان به تفکیک رتبه علمی
            </th>
            <!-- <th
                    colspan="12"
                    style="
                        font-size: 20px;
                        font-weight: 900;
                        font-weight: bolder;
                    "
                >
                    مصروف تحصیل
                </th> -->
        </tr>
        <tr>
            <th colspan="2">داکتر</th>
            <th colspan="2">ماستر</th>
            <th colspan="2">لیسانس</th>
            <th colspan="2">پوهاند</th>
            <th colspan="2">پوهنیار</th>
            <th colspan="2">پوهنمل</th>
            <th colspan="2">پوهیالی</th>
            <th colspan="2">نامزاد پوهنیار</th>
            <!-- <th></th>
                <th></th>
                <th>ماستر</th>
                <th>داکتر</th> -->
        </tr>
        <tr>
            <th>ذکور</th>
            <th>اناث</th>
            <th>ذکور</th>
            <th>اناث</th>
            <th>ذکور</th>
            <th>اناث</th>

            <th>ذکور</th>
            <th>اناث</th>
            <th>ذکور</th>
            <th>اناث</th>
            <th>ذکور</th>
            <th>اناث</th>
            <th>ذکور</th>
            <th>اناث</th>
            <th>ذکور</th>
            <th>اناث</th>
            <th>ذکور</th>
            <th>اناث</th>
            <!-- <th></th>
                <th></th>
                <th>ذکور</th>
                <th>اناث</th> -->
        </tr>
    </thead>
    <tbody>
        <!-- Crutail point  -->
        @foreach ($teachers_data as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                @if ($loop->iteration == 1)
                    <td rowspan="{{ $data->faculty_departments_length }}">
                        {{ $data->faculty_name }}
                    </td>
                @endif
                @if ($data->faculty_name == '')
                    <td></td>
                @else
                    <td>{{ $data->department_name }}</td>
                @endif
                <td>{{ $data->total_male_teacher_entire_department }}</td>
                <td>{{ $data->total_female_teacher_entire_department }}</td>
                <td>{{ $data->total_doctor_male_teacher_in_department }}</td>
                <td>{{ $data->total_doctor_female_teacher_in_department }}</td>
                <td>{{ $data->total_master_male_teacher_in_department }}</td>
                <td>{{ $data->total_master_female_teacher_in_department }}</td>
                <td>{{ $data->total_bachelor_male_teacher_in_department }}</td>
                <td>{{ $data->total_bachelor_female_teacher_in_department }}</td>

                <td>{{ $data->total_pohand_male_teacher_in_department }}</td>
                <td>{{ $data->total_pohand_female_teacher_in_department }}</td>
                <td>{{ $data->total_pohyali_male_teacher_in_department }}</td>
                <td>{{ $data->total_pohyali_female_teacher_in_department }}</td>
                <td>{{ $data->total_pohanmal_male_teacher_in_department }}</td>
                <td>{{ $data->total_pohanmal_female_teacher_in_department }}</td>
                <td>
                    {{ $data->total_namzadPohanyar_male_teacher_in_department }}
                </td>
                <td>
                    {{ $data->total_namzadPohanyar_female_teacher_in_department }}
                </td>
                <td>{{ $data->total_pohanyar_male_teacher_in_department }}</td>
                <td>{{ $data->total_pohanyar_female_teacher_in_department }}</td>
                <!-- <td></td>
                <td></td>
                <td>23</td>
                <td>23</td> -->
            </tr>
            <!-- end of that -->
        @endforeach
        <tr>
            <th colspan="26"
                style="
                        font-size: 20px;
                        font-weight: 900;
                        font-weight: bolder;
                    ">
                مجموعه کلی دانشکده ها
            </th>
        </tr>
        <tr>
            <th colspan="13">ذکور</th>
            <th colspan="13">اناث</th>
        </tr>
        <tr>
            <td colspan="13">10</td>
            <td colspan="13">40</td>
        </tr>
        <tr>
            <td colspan="26" style="font-size: bold; font-weight: 600">
                تعداد استادان 200 :
            </td>
        </tr>
        <!-- Additional rows can be added here -->
    </tbody>
</table>
