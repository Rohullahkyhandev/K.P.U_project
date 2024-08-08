<!-- resources/views/reports/professional_report.blade.php -->
<table>
    <thead>
        <tr>
            @if ($type && $board_name)
                @if ($type == 'base_on_board')
                    <th
                        style="background-color: #3a543b; color: white; text-align: center;border: 1px solid gray;font-weight: bold;font-size: 25ch">
                        لیست اعضای بورد {{ $board_name }}
                    </th>
                @else
                    <th
                        style="background-color: #3a543b; color: white; text-align: center;border: 1px solid gray;font-weight: bold;font-size: 25ch">
                        لیست اعضای بورد سال {{ $year }}
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
                شماره تماس</th>
            <th
                style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                آدرس ایمیل</th>

            <th
                style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                آدرس</th>
            <th
                style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                بورد مربوطه</th>

            <!-- Add more columns as needed -->
        </tr>
    </thead>
    <tbody>
        @foreach ($boardMembers as $boardMember)
            <tr>
                <td
                    style="background: #4CAF50; color: #fff; text-align: center; font-weight: bold; border: 1px solid black">
                    {{ $loop->iteration }}</td>
                <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                    {{ $boardMember->name }}</td>
                <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                    {{ $boardMember->lname }}</td>
                <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                    {{ $boardMember->fname }}</td>
                <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                    {{ $boardMember->phone }}</td>
                <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                    {{ $boardMember->email }}</td>
                <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                    {{ $boardMember->address }}</td>
                <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                    {{ $boardMember->board_name }}</td>
                {{-- <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $boardMember->commit_name }}</td> --}}
                <!-- Add more data as needed -->
            </tr>
        @endforeach
    </tbody>
</table>
