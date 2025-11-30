<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher Personal Detial page</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            font-size: 8px;
            background-color: #b7b4b4;

        }

        td {
            font-size: 6px;
        }

        th,
        td {
            border: 1px solid black;
            text-align: center;

        }
    </style>
</head>

<body>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th class="2" rowspan="3">
                        لیسان های خارجی</th>
                    <th colspan="12">تحصیلات</th>
                    <th rowspan="3">موقف اداری</th>
                    <th colspan="2">شیوه ارتباط</th>
                    <th colspan="4">بورس طول المدت
                    </th>
                    <th colspan="7">ملومات کادری
                    </th>
                    <th colspan="3">َشهرت</th>
                </tr>
                <tr>
                    <th colspan="4">لیسانس</th>
                    <th colspan="4">ماستر</th>
                    <th colspan="4">داکتر</th>
                    <th rowspan="2">ایمیل ادرس</th>
                    <th rowspan="2">شماره تماس</th>
                    <th rowspan="2">تاریخ برگشت</th>
                    <th rowspan="2">تاریخ اعزام</th>
                    <th rowspan="2">کشور</th>
                    <th rowspan="2">مقطع</th>
                    <th rowspan="2">جنسیت</th>
                    <th rowspan="2">دیپارتمنت</th>
                    <th rowspan="2">پوهنځی</th>
                    <th rowspan="2">تاریخ آخرین ترفیع</th>
                    <th rowspan="2">تاریخ تقرر در کادر علمی</th>
                    <th rowspan="2">سال تولد</th>
                    <th rowspan="2">رتبه علمی</th>
                    <th rowspan="2">ولد</th>
                    <th rowspan="2">تخلص</th>
                    <th rowspan="2">نام</th>
                </tr>
                <tr>
                    <th>ریشته تحصیلی</th>
                    <th>سال شمولیت</th>
                    <th>سال فراغت</th>
                    <th>کشور</th>
                    <th>ریشته تحصیلی</th>
                    <th>سال شمولیت</th>
                    <th>سال فراغت</th>
                    <th>کشور</th>
                    <th>ریشته تحصیلی</th>
                    <th>سال شمولیت</th>
                    <th>سال فراغت</th>
                    <th>کشور</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $counter = 0;
                @endphp
                @if ($teacher_data)
                    @foreach ($teacher_data as $data)
                        <tr>

                            @if (isset($data['languages']))
                                <td>
                                    @foreach ($data['languages'] as $language)
                                        {{ $language }} &nbsp;
                                    @endforeach
                                </td>
                            @else
                                <td>
                                </td>
                            @endif
                            @foreach ($data['qualifications'] as $item)
                                @if (count($data['qualifications']) == 1)
                                    <td>{{ $item['grad_year'] }}</td>
                                    <td>{{ $item['uname'] }}</td>
                                    <td>{{ $item['grad_year'] }}</td>
                                    <td>{{ $item['cname'] }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                @elseif (count($data['qualifications']) == 2)
                                    @if ($counter == 0)
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    @endif
                                    <td>{{ $item['education'] }}</td>
                                    <td>{{ $item['uname'] }}</td>
                                    <td>{{ $item['grad_year'] }}</td>
                                    <td>{{ $item['cname'] }}</td>
                                    @php
                                        $counter++;
                                    @endphp
                                @else
                                    <td>{{ $item['grad_year'] }}</td>
                                    <td>{{ $item['uname'] }}</td>
                                    <td>{{ $item['grad_year'] }}</td>
                                    <td>{{ $item['cname'] }}</td>
                                @endif
                            @endforeach


                            <td>
                                @if ($data['code_bast_in_letter'] == '1')
                                    آمر دیپارتمنت
                                @else
                                    ندارد
                                @endif
                            </td>
                            <td>{{ $data['phone'] }}</td>
                            <td>{{ $data['email'] }}</td>
                            <td>
                                @if (!empty($data['scholarships']))
                                    @if ($data['scholarships']['back_date'] != null)
                                        {{ $data['scholarships']['back_date'] }}
                                    @else
                                        مصروف تحصیل
                                    @endif
                                @else
                                @endif
                            </td>
                            <td>{{ $data['scholarships']['sent_date'] }}</td>
                            <td>{{ $data['scholarships']['country_name'] }}</td>
                            <td>{{ $data['scholarships']['edu_maqta'] }}</td>
                            <td>{{ $data['gender'] }}</td>
                            <td>{{ $data['department'] }}</td>
                            <td>{{ $data['faculty'] }}</td>
                            <td>{{ $data['p_date'] }}</td>
                            <td>{{ $data['hire_date'] }}</td>
                            <td>{{ $data['birth_date'] }}</td>
                            <td>{{ $data['academic_rank'] }}</td>
                            <td>{{ $data['fname'] }}</td>
                            <td>{{ $data['lname'] }}</td>
                            <td>{{ $data['name'] }}</td>
                    @endforeach
                @else
                    <td colspan="20"> No Result found.</td>
                @endif
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
