<!-- resources/views/reports/professional_report.blade.php -->
<table dir="rtl">

    <thead dir="rtl">
        <tr>
            <th colspan="10"
                style="background-color: #3a543b; color: white; text-align: center;border: 1px solid gray;font-weight: bold;font-size: 25ch">
                لسیت استادان که در سال {{ $year }} به بورسیه اعزام شده اند
            </th>
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
                style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                آدرس ایمیل</th>
            <th
                style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                فاکولته</th>
            <th
                style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                دیپارتمنت</th>

            <th
                style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                کشور </th>

            <th
                style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                ریشته تحصلی</th>
            <th
                style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                مقطع تحصلی </th>

            <th
                style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                تاریخ اعزام </th>


            <!-- Add more columns as needed -->
        </tr>
    </thead>

    <tbody dir="rtl">
        @foreach ($teacher_in_scholarships as $teacher)
            <tr>
                <td style="background: #8dd990; color: #fff; text-align: center;  border: 1px solid black">
                    {{ $loop->iteration }}</td>
                <td style="background: #8dd990; color: #fff; text-align: center; border: 1px solid black">
                    {{ $teacher->tname }}</td>
                <td style="background: #8dd990; color: #fff; text-align: center; border: 1px solid black">
                    {{ $teacher->lname }}</td>

                <td style="background: #8dd990; color: #fff; text-align: center; border: 1px solid black">
                    {{ $teacher->email }}</td>
                <td style="background: #8dd990; color: #fff; text-align: center; border: 1px solid black">
                    {{ $teacher->faculty_name }}</td>
                <td style="background: #8dd990; color: #fff; text-align: center; border: 1px solid black">
                    {{ $teacher->department_name }}</td>
                <td style="background: #8dd990; color: #fff; text-align: center; border: 1px solid black">
                    {{ $teacher->country_name }}</td>

                <td style="background: #8dd990; color: #fff; text-align: center; border: 1px solid black">
                    {{ $teacher->edu_degree }}</td>
                <td style="background: #8dd990; color: #fff; text-align: center; border: 1px solid black">
                    {{ $teacher->edu_maqta }}</td>
                <td style="background: #8dd990; color: #fff; text-align: center; border: 1px solid black">
                    {{ $teacher->sent_date }}</td>

            </tr>
        @endforeach


    </tbody>

</table>
