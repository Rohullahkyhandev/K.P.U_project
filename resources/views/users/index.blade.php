@extends('Layout._Layout')

@section('content')
    <div class="w-full mt-4 mb-6">
        <div class="flex items-center justify-between border-b-2 py-3">

            <div class="flex items-center justify-between ">
                <a href="{{ route('user.create') }}"
                    class="bg-blue-600 flex items-center hover:bg-blue-700 justify-between text-white py-2 px-2 rounded focus:ring-blue-400 focus:ring-4">
                    ثبت یوزر جدید
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </a>
            </div>
            <div>
                <h1 class="text-3xl">لیست استفاده کننده های سیستم</h1>
            </div>
        </div>
        <div class="bg-white  shadow py-4 px-4 rounded">
            <div id="success_msg">
                @include('flashMessages.success_message')
            </div>

            <div class="flex items-center justify-between">
                <div>
                    <form id="form_user_search" class="flex items-center justify-between">
                        <input type="text" name="user_search" placeholder="جستجوی بر اساس نام"
                            class="border border-gray-300 shadow rounded focus:ring-1 focus:ring-offset-blue-500">

                    </form>
                </div>
                <div class="flex items-center ">
                    <p class="mx-2">Found</p>
                    <form id="form_user_perPage">
                        <select type="select" name="user_perPage"
                            class="border w-full border-gray-300 shadow rounded focus:ring-1 focus:ring-offset-blue-500">
                            <option value="10" selected>10</option>
                            <option value="20">20</option>
                            <option value="40">40</option>
                            <option value="60">60</option>
                            <option value="80">80</option>
                            <option value="100">100</option>
                        </select>
                    </form>
                    <p class="mx-2">PerPage</p>
                </div>
            </div>

            <table class="table-auto w-full">
                <div class="mt-4 mb-10">
                    <thead class="bg-gray-200 border-t-2 border-gray-400 border-b-2 h-10">
                        <tr>
                            <th>شماره</th>
                            <th>نام /تخلص</th>
                            <th>مقام</th>
                            <th>نوع یوزر</th>
                            <th>آدرس ایمل</th>
                            <th>عکس</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @php
                            $counter = 1;
                        @endphp
                        @foreach ($data as $item)
                            <tr>
                                <td class="border-b border-gray-200 p-3">{{ $counter++ }}</td>
                                <td class="border-b border-gray-200 p-3">{{ $item->full_name }}</td>
                                <td class="border-b border-gray-200 p-3">{{ $item->position }}</td>
                                <td class="border-b border-gray-200 p-3">{{ $item->user_type }}</td>
                                <td class="border-b border-gray-200 p-3">{{ $item->email }}</td>
                                <td class="border-b border-gray-200 p-3">

                                    <img src="{{ $item->photo_path }}" alt="{{ $item->name }}"
                                        class="w-10 h-10 rounded-full">
                                </td>

                                <td class="border-b border-gray-200 p-3 flex items-center justify-between">

                                    <a href="#"
                                        class="text-yellow-400  hover:bg-blue-300 hover:text-yellow-500 px-3 py-2  transition-colors rounded "
                                        title="Edit User">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>

                                    </a>
                                    <a href="#"
                                        class="text-red-600  hover:bg-blue-300 px-3 py-2 transition-colors rounded "
                                        title="Delete User">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>


                                    </a>
                                    <a href="{{ route('user.permission_list', ['id' => $item->id]) }}"
                                        class="text-blue-800  hover:bg-blue-300 px-3 py-2 transition-colors rounded "
                                        title="User Permission">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>

                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </div>
            </table>
            <div class="px-10">

                <br><br>
                {{ $data->links('vendor.pagination.tailwind') }}
                <br>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function(event) {

            $('#form_user_search').(function(event) {
                var data =
            });


        })
    </script>
@endsection
