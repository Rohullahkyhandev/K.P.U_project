<!-- resources/views/reports/professional_report.blade.php -->
<table>
    <thead>
        <tr>
            @if ($type)
                @if ($type == 'base_on_commit')
                    <th colspan="7"
                        style="background-color: #3a543b; color: white; text-align: center;border: 1px solid gray;font-weight: bold;font-size: 25ch">
                        لیست اعضای کمیته {{ $commit_name }}
                    </th>
                @else
                    <th colspan="7"
                        style="background-color: #3a543b; color: white; text-align: center;border: 1px solid gray;font-weight: bold;font-size: 25ch">
                        لیست اعضای کمیته ها برای سال {{ $year }}
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
                style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                شماره تماس</th>
            <th
                style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                آدرس ایمیل</th>

            <th
                style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                آدرس</th>
            <th
                style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                کمیته مربوطه</th>

            <!-- Add more columns as needed -->
        </tr>
    </thead>
    <tbody>
        @if ($committeeMembers)
            @foreach ($committeeMembers as $commitMember)
                <tr>
                    <td
                        style="background: #4CAF50; color: #fff; text-align: center; font-weight: bold; border: 1px solid black">
                        {{ $loop->iteration }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $commitMember->name }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $commitMember->lname }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $commitMember->phone }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $commitMember->email }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $commitMember->address }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $commitMember->commit_name }}</td>
                    {{-- <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                   {{ $boardMember->commit_name }}</td> --}}
                    <!-- Add more data as needed -->
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
