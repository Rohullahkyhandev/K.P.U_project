<!-- resources/views/reports/professional_report.blade.php -->
<table>
    <thead>
        <tr>
            @if ($type)
                @if ($type == 'all')
                    <th colspan="9"
                        style="background-color: #3a543b; color: white; text-align: center;border: 1px solid gray;font-weight: bold;font-size: 25ch">
                        لیست عمومی تحقیقات استادان
                    </th>
                @elseif($type == 'faculty')
                    <th colspan="8"
                        style="background-color: #3a543b; color: white; text-align: center;border: 1px solid gray;font-weight: bold;font-size: 25ch">
                        لسیت تحقیقات استادان پوهنحی {{ $faculty_name }}
                    </th>
                @elseif($type == 'department')
                    <th colspan="8"
                        style="background-color: #3a543b; color: white; text-align: center;border: 1px solid gray;font-weight: bold;font-size: 25ch">
                        لسیت تحقیقات استادان دیپارتمنت {{ $department_name }}
                    </th>
                @endif
            @endif
        </tr>
        <tr>
            <th
                style="background-color: #4CAF50; border: 1px solid black; color: white; text-align: center; width: 100px">
                شماره </th>
            <th
                style="background-color: #4CAF50; border: 1px solid black; color: white; text-align: center; width: 100px">
                نام </th>
            <th
                style="background-color: #4CAF50; border: 1px solid black; color: white; text-align: center; width: 100px">
                تخلص</th>

            <th
                style="background-color: #4CAF50; border: 1px solid black; color: white; text-align: center; width: 100px">
                نام پدر</th>

            <th
                style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                رتبه علمی
            </th>
            <th
                style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                درجه تحصیل</th>

            <th
                style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                عنوان تحقیق</th>
            <th
                style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                پوهنحی</th>

            @if ($type == 'department')
                <th
                    style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                    دیپارتمنت</th>
            @endif

            <!-- Add more columns as needed -->
        </tr>
    </thead>
    <tbody>
        @if ($teacher_researches && $type == 'all')
            @foreach ($teacher_researches as $teacher_research)
                <tr>
                    <td
                        style="background: #4CAF50; color: #fff; text-align: center; font-weight: bold; border: 1px solid black">
                        {{ $loop->iteration }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher_research->name }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher_research->lname }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher_research->fname }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher_research->academic_rank }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher_research->education_degree }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher_research->research_title }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher_research->faculty_name }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher_research->department_name }}</td>

                </tr>
            @endforeach
        @endif
        @if ($teacher_researches && $type == 'faculty')
            @foreach ($teacher_researches as $teacher_research)
                <tr>
                    <td
                        style="background: #4CAF50; color: #fff; text-align: center; font-weight: bold; border: 1px solid black">
                        {{ $loop->iteration }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher_research->name }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher_research->lname }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher_research->fname }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher_research->academic_rank }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher_research->education_degree }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher_research->research_title }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher_research->faculty_name }}</td>


                </tr>
            @endforeach
        @endif

        @if ($teacher_researches && $type == 'department')
            @foreach ($teacher_researches as $teacher_research)
                <tr>
                    <td
                        style="background: #4CAF50; color: #fff; text-align: center; font-weight: bold; border: 1px solid black">
                        {{ $loop->iteration }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher_research->name }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher_research->lname }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher_research->fname }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher_research->academic_rank }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher_research->education_degree }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher_research->research_title }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher_research->faculty_name }}</td>

                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher_research->department_name }}</td>

                </tr>
            @endforeach
        @endif
    </tbody>
</table>
