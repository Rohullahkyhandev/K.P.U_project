<!-- resources/views/reports/professional_report.blade.php -->

<table>
    <thead>
        <tr>
            @if ($type && $program_name && $year)
                @if ($type == 'base_on_year' && $status == 1)
                    <th colspan="13"
                        style="background-color: #3a543b; color: white; text-align: center;border: 1px solid gray;font-weight: bold;font-size: 25ch">
                        لیست محصیلن برحال برنامه {{ $year }}
                    </th>
                @elseif ($type == 'base_on_year' && $status == 2)
                    <th colspan="14"
                        style="background-color: #3a543b; color: white; text-align: center;border: 1px solid gray;font-weight: bold;font-size: 25ch">
                        لیست محصیلن که در سال {{ $year }} فارغ شده اند
                    </th>
                @elseif($type == 'base_on_program' && $status == 1)
                    <th colspan="14"
                        style="background-color: #3a543b; color: white; text-align: center;border: 1px solid gray;font-weight: bold;font-size: 25ch">
                        لیست محصیلن برحال برنامه {{ $program_name }}
                    </th>
                @elseif($type == 'base_on_program' && $status == 2)
                    <th colspan="14"
                        style="background-color: #3a543b; color: white; text-align: center;border: 1px solid gray;font-weight: bold;font-size: 25ch">
                        لیست محصیلن فارغ شده برنامه {{ $program_name }}
                    </th>
                @endif
            @endif
        </tr>
        @if ($status == 1)
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
                    آی دی کانکور</th>
                <th
                    style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                    نمره کانکور</th>
                <th
                    style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                    ریشته دروه لیسانس</th>
                <th
                    style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                    نمبر تذکره</th>
                <th
                    style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                    آدرس</th>
                <th
                    style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                    تایخ ثبت نام</th>
                <th
                    style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                    گروپ خون</th>
                <th
                    style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                    برنامه </th>

                <!-- Add more columns as needed -->
            </tr>
        @else
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
                    نمبر تذکره</th>
                <th
                    style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                    فیصدی کلی
                </th>
                <th
                    style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                    آی دی دیپلوم
                </th>

                <th
                    style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                    نمره تیزیس
                </th>

                <th
                    style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                    استاد رهنمای تیزیس
                </th>

                <th
                    style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                    خوصوصیات
                </th>

                <th
                    style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                    آدرس</th>

                <th
                    style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                    سال فراغت</th>

                <th
                    style="background-color: #4CAF50; font-weight: bold; border: 1px solid black; color: white; text-align: center; width: 100px">
                    برنامه </th>

                <!-- Add more columns as needed -->
            </tr>
        @endif
    </thead>
    <tbody>
        @if ($status == 1)
            @foreach ($students as $student)
                <tr>
                    <td
                        style="background: #4CAF50; color: #fff; text-align: center; font-weight: bold; border: 1px solid black">
                        {{ $loop->iteration }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $student->name }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $student->lname }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $student->fname }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $student->phone }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $student->email }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $student->kankor_id }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $student->kankor_mark }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $student->backelor_field }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $student->nic }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $student->addresss }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $student->admission_year }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $student->blood_group }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $student->program_name }}</td>
                    {{-- <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                {{ $boardMember->commit_name }}</td> --}}
                    <!-- Add more data as needed -->
                </tr>
            @endforeach
            {{-- when the status == 2 demonstrate that graduated student --}}
        @else
            @foreach ($graduated_students as $graduated_student)
                <tr>
                    <td
                        style="background: #4CAF50; color: #fff; text-align: center; font-weight: bold; border: 1px solid black">
                        {{ $loop->iteration }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $graduated_student->name }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $graduated_student->lname }}</td>
                    {{-- <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $graduated_student->fname }}</td> --}}
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $graduated_student->phone }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $graduated_student->email }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $graduated_student->nic }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $graduated_student->percentage }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $graduated_student->diploma_id }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $graduated_student->thesis_mark }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $graduated_student->thesis_guide_teacher }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $graduated_student->attribute }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $graduated_student->address }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $graduated_student->graduation_year }}</td>
                    <td style="background: #4CAF50; color: #fff; text-align: center; border: 1px solid black">
                        {{ $graduated_student->program_name }}</td>
                </tr>
            @endforeach
        @endif
    </tbody>
