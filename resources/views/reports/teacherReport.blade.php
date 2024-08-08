<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Data</title>
</head>

<body style="font-family: Arial, sans-serif; margin: 20px;">

    <table>
        <tr>
            <td colspan="14">
                <h2 style="text-align: center;">جدول معلومات احصایه وی استادان پوهنتون پولی تخنیک کابل</h2>
            </td>
        </tr>
    </table>
    @foreach ($teachers_data as $teacher_data)
        <h2 style="text-align: center;">پوهنځی: {{ $teacher_data->faculty_name }}</h2>
        <table style="width: 100%; border-collapse: collapse; margin: 10px 0;">
            <thead>
                <tr>
                    <td colspan="14">
                        <h2 style="text-align: center;">جدول معلومات احصایه وی استادان پوهنتون پولی تخنیک کابل</h2>
                    </td>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;"
                        rowspan="2">دیپارمنت</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;"
                        rowspan="2">مجموعه (ذکور)</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;"
                        rowspan="2">مجموعه (اناث)</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;"
                        colspan="2">داکتر</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;"
                        colspan="2">ماستر</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;"
                        colspan="2">لیسانس</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;"
                        colspan="2">پوهاند</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;"
                        colspan="2">پوهیالی</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;"
                        colspan="2">پوهنمل</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;"
                        colspan="2">پوهنیار</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;"
                        colspan="2">نامزاد پوهنیار</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;"
                        colspan="2">مصروف تدریس</th>
                </tr>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;">
                        مرد</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;">
                        زن</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;">
                        مرد</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;">
                        زن</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;">
                        مرد</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;">
                        زن</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;">
                        مرد</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;">
                        زن</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;">
                        مرد</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;">
                        زن</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;">
                        مرد</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;">
                        زن</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;">
                        مرد</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;">
                        زن</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;">
                        مرد</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;">
                        زن</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;">
                        مرد</th>
                    <th style="border: 1px solid #ddd; padding: 8px; background-color: #f4f4f4; text-align: center;">
                        زن</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teacher_data->departments as $department)
                    <tr>
                        <td style="border: 1px solid #ddd; padding: 8px;">{{ $department->department_name }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">{{ $department->total_teacher_in_department }}
                        </td>
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
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            {{ $department->total_male_teacher_scholarship }}</td>
                        <td style="border: 1px solid #ddd; padding: 8px;">
                            {{ $department->total_female_teacher_scholarship }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
    @endforeach

</body>

</html>
