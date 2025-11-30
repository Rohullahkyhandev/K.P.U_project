<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Data</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 20px; direction: rtl">

    <table style="direction: rtl !important">
        <tr>
            @if ($type == 'all')
                <th colspan="14">
                    <h2 style="text-align: center; font: bolder; font-size: 30px">جدول معلومات احصایوی استادان پوهنتون
                        پولی
                        تخنیک کابل</h2>
                </th>
            @endif
        </tr>
    </table>
    @foreach ($teachers_data as $teacher_data)
        <table>
            <tr>
                <th style="font-weight: bolder" colspan="14">اسم پوهنځی:
                    {{ $teacher_data->faculty_name }}</th>
            </tr>
        </table>
        <table style="width: 100%; border-collapse: collapse; margin: 10px 0;">
            <thead>
                <tr>
                    <th colspan="3">مجموع</th>
                    <th colspan="2">نامزاد پوهنیار</th>
                    <th colspan="2">پوهیالی</th>
                    <th colspan="2">پوهنیار</th>
                    <th colspan="2">پوهنمل</th>
                    <th colspan="2">پوهندوی</th>
                    <th colspan="2">پوهنوال</th>
                    <th colspan="2">پوهاند</th>
                    <th colspan="3">مجموع</th>
                    <th colspan="2">لیسانس</th>
                    <th colspan="2">ماستر</th>
                    <th colspan="2">داکتر</th>
                    <th colspan="3" rowspan="3">اسم دیپارتمنت</th>
                    {{-- <th>اسم پوهنځی</th> --}}
                    <th>شماره</th>
                </tr>
                <tr>
                    <th>اناث</th>
                    <th>ذکور</th>
                    <th>اناث</th>
                    <th>ذکور</th>
                    <th>اناث</th>
                    <th>ذکور</th>
                    <th>اناث</th>
                    <th>ذکور</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($teacher_data->departments as $department)
                    <tr>

                        <td style="border: 1px solid #ddd; padding: 8px;">{{ $department->department_name }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            {{ $department->total_male_teacher_in_department }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            {{ $department->total_female_teacher_in_department }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            {{ $department->total_doctor_male_teacher_in_department }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            {{ $department->total_doctor_female_teacher_in_department }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            {{ $department->total_master_male_teacher_in_department }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            {{ $department->total_master_female_teacher_in_department }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            {{ $department->total_bachelor_male_teacher_in_department }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            {{ $department->total_bachelor_female_teacher_in_department }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            {{ $department->total_pohand_male_teacher_in_department }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            {{ $department->total_pohand_female_teacher_in_department }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            {{ $department->total_pohandyar_male_teacher_in_department }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            {{ $department->total_pohandyar_female_teacher_in_department }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            {{ $department->total_pohanmal_male_teacher_in_department }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            {{ $department->total_pohanmal_female_teacher_in_department }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            {{ $department->total_namzadpohanyar_male_teacher_in_department }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            {{ $department->total_namzadpohanyar_female_teacher_in_department }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
    @endforeach

</body>

</html>
