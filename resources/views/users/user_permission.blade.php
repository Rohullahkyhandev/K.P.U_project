@extends('Layout._Layout')

@section('content')
    <div class="mt-14 m-10">
        <div class="flex items-center justify-between">
            <div>
                <a href="" class="bg-blue-600 rounded-md py-2 px-3 hover:bg-blue-700 text-white">اضافه نمودن صلاحیت</a>
            </div>
            <div>اضافه نمودن صلاحیت</div>
        </div>

        <div class="bg-white shadow rounded-lg py-8 mt-4">
            <div>
                <div class="flex items-center justify-between px-10">
                    <div>
                        <input type="text" class="border rounded border-gray-200 shadow" placeholder="جستجو بر اساس">
                    </div>
                    <div>
                        <form id="per_page_form" method="get">
                            <select name="" id="select" class="border rounded border-gray-200 shadow">
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="40">40</option>
                                <option value="60">60</option>
                                <option value="80">80</option>
                                <option value="100">100</option>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="w-full px-10 mt-4">
                    <table class="table-auto w-full">
                        <thead class="w-full bg-gray-300 border-t-2 border-b-2 border-gray-800 h-10">
                            <tr>
                                <th>شماره</th>
                                <th>صلاحیت</th>
                                <th>یوزر</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @php
                                $index = 1;
                            @endphp
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td class="border-b border-gray-400 py-3">{{ $index++ }}</td>
                                    <td class="border-b border-gray-400 py-3">{{ $permission->display_name }}</td>
                                    <td class="border-b border-gray-400 py-3">{{ $permission->uname }}</td>
                                    <td class="border-b border-gray-400 py-5 flex items-center justify-center gap-3">

                                        <a href="{{ route('user.permission.delete', ['id' => $permission->id]) }}"
                                            class="text-red-600  hover:bg-blue-300 px-3 py-2  transition-colors rounded "
                                            title="Delete User">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>


                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <br><br>

                    <div class="px-10">
                        <p>{{ $permissions->links('pagination::tailwind') }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {


            $('#select').change(function(evnent) {
                evnent.preventDefault();
                var per_page = $(this).val();

                $.ajax({
                    type: 'GET',
                    url: "{{ route('user.permission_list', ['id' => Auth::id()]) }}",
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(erorr) {
                        console.log(erorr.responseJSON.message);
                    }

                })


            })

            // $("#per_page_form").submit(function(e) {
            //     e.preventDefault();
            //     $('#select').text('درحال پروسیس...')
            //     $("#submit").prop("disabled", true)
            //     var form = $("#user_create_form")[0];
            //     var data = new FormData(form);

            //     $.ajax({
            //         type: 'POST',
            //         url: "{{ route('user.store') }}",
            //         data: data,
            //         processData: false,
            //         contentType: false,
            //         success: function(data) {
            //             $("#success_msg").html(` <div class="w-full bg-green-700 rounded text-white py-4">
        //            <p class="px-10">${data.res}</p>
        //            </div>`)
            //             $("#submit").prop("disabled", false)
            //             $('#submit').text('ثبت فورم')
            //         },
            //         error: function(erorr) {
            //             console.log(erorr.responseJSON.message);
            //         }

            //     })

            // });
        })
    </script>
@endsection
