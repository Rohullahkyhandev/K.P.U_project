<!-- resources/views/reports/professional_report.blade.php -->
<table>
    <thead>
        <tr>
            <th @if ($type == 'base_on_commit') colspan="7" @else colspan="8" @endif
                style="background-color: #3a543b; color: white; text-align: center;border: 1px solid gray;font-weight: bold;font-size: 25ch">
                لیست استادان در کمته {{ $commit->name }} عضو هستند
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
                شماره تماس</th>
            <th
                style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                آدرس ایمیل</th>
            <th
                style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                فاکولته</th>
            <th
                style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                دیپارتمنت</th>
            @if ($type == 'base_on_year')
                <th
                    style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                    کمیته مربوطه</th>
            @endif
            <!-- Add more columns as needed -->
        </tr>
    </thead>
    @if ($type == 'base_on_commit')
        <tbody>
            @foreach ($teacher_in_commits as $teacher)
                <tr>
                    <td
                        style="background: #4CAF50; color: #fff; text-align: center; font-weight: bold; border: 1px solid black">
                        {{ $loop->iteration }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher->tname }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher->lname }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher->phone }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher->email }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher->faculty_name }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher->department_name }}</td>
                    {{-- <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $teacher->commit_name }}</td> --}}
                    <!-- Add more data as needed -->
                </tr>
            @endforeach
        </tbody>
    @endif
</table>
