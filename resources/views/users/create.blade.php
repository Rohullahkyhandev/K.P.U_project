@extends('Layout._Layout')


@section('content')
    <div class="w-full mb-5 mt-5">
        <div class="flex items-center justify-between border-b-2 py-3">

            <div class="flex items-center justify-between ">
                <a href="{{ route('user.view') }}"
                    class="bg-blue-600 flex items-center hover:bg-blue-700 justify-between text-white py-2 px-3 rounded focus:ring-blue-400 focus:ring-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    &nbsp;
                    یوزر لیست
                </a>

            </div>
            <div>
                <h1 class="text-3xl"> فورم ثبت یوزر جدید </h1>
            </div>

        </div>
        <div class="bg-white w-full shadow py-4 px-4">
            <div id="success_msg">
                @include('flashMessages.success_message')
            </div>
            <br>
            <div class="w-full mr-40">
                <form id="user_create_form" method="POST" enctype="multipart/form-data" action="{{ route('user.store') }}">
                    @csrf
                    <div class="flex items-center justify-around">
                        <div class="w-full flex items-center mb-3">
                            <div class="w-1/12">
                                <label for="name">نام <span class="text-red-500">*</span></label>
                            </div>
                            &nbsp;
                            &nbsp;
                            <div class="w-6/12">
                                <input type="text" name="name"
                                    class="border w-full rounded border-gray-400 shadow focus:ring-2 focus:ring-blue-600">
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center justify-around">
                        <div class="w-full flex items-center mb-3">
                            <div class="w-1/12">
                                <label for="full_name">نام و تخلص <span class="text-red-500">*</span></label>
                            </div>
                            &nbsp;
                            &nbsp;
                            <div class="w-6/12">
                                <input type="text" name="full_name"
                                    class="border w-full rounded border-gray-400 shadow focus:ring-2 focus:ring-blue-600">
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center justify-around">
                        <div class="w-full flex items-center mb-3">
                            <div class="w-1/12">
                                <label for="position"> مقام <span class="text-red-500">*</span></label>
                            </div>
                            &nbsp;
                            &nbsp;
                            <div class="w-6/12">
                                <input type="text" name="position"
                                    class="border w-full rounded border-gray-400 shadow focus:ring-2 focus:ring-blue-600">
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center justify-around">
                        <div class="w-full flex items-center mb-3">
                            <div class="w-1/12">
                                <label for="email"> آدرس ایمل <span class="text-red-500">*</span></label>
                            </div>
                            &nbsp;
                            &nbsp;
                            <div class="w-6/12">
                                <input type="text" name="email"
                                    class="border w-full rounded border-gray-400 shadow focus:ring-2 focus:ring-blue-600">
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center justify-around">
                        <div class="w-full flex items-center mb-3">
                            <div class="w-1/12">
                                <label for="password"> رمز عبور <span class="text-red-500">*</span></label>
                            </div>
                            &nbsp;
                            &nbsp;
                            <div class="w-6/12">
                                <input type="text" name="password"
                                    class="border w-full rounded border-gray-400 shadow focus:ring-2 focus:ring-blue-600">
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center justify-around">
                        <div class="w-full flex items-center mb-3">
                            <div class="w-1/12">
                                <label for="password_confirmation"> تایدی رمز عبور <span
                                        class="text-red-500">*</span></label>
                            </div>
                            &nbsp;
                            &nbsp;
                            <div class="w-6/12">
                                <input type="text" name="password_confirmation"
                                    class="border w-full rounded border-gray-400 shadow focus:ring-2 focus:ring-blue-600">
                            </div>
                        </div>

                    </div>


                    <div class="flex items-center justify-around">
                        <div class="w-full flex items-center mb-3">
                            <div class="w-1/12">
                                <label for="photo"> عکس <span class="text-red-500"></span></label>
                            </div>
                            &nbsp;
                            &nbsp;
                            <div class="w-6/12">
                                <input type="file" name="photo"
                                    class="border  py-2 px-3 w-full rounded border-gray-400 shadow focus:ring-2 focus:ring-blue-600">
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center justify-around">
                        <div class="w-full flex items-center mb-3">
                            <div class="w-1/12">
                                <label for="name"> نوع یوزر<span class="text-red-500">*</span></label>
                            </div>
                            &nbsp;
                            &nbsp;
                            <div class="w-6/12">
                                <select name="user_type"
                                    class="border w-full rounded border-gray-400 shadow focus:ring-2 focus:ring-blue-600"
                                    id="">
                                    <option value="PDC_user">یوزر P.D.C</option>
                                    <option value="teahcer_department_user">یوزر آمریت استادان </option>
                                    <option value="department_of_gurantee_user">یوزر آمریت تضمین کیفت </option>
                                    <option value="dpeartment_of_post_graduated_program_user">یوزر آمریت برنامه های فوق
                                        لیسانس</option>
                                    <option value="dpeartment_of_science_research_user">یوزر آمریت تحقیقات علمی
                                    </option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="flex items-center justify-around">
                        <div class="w-full flex items-center mb-3">
                            <div class="w-1/12">
                                <label for="name">نقش یوزر<span class="text-red-500">*</span></label>
                            </div>
                            &nbsp;
                            &nbsp;
                            <div class="w-6/12">
                                <select name="role"
                                    class="border w-full rounded border-gray-400 shadow focus:ring-2 focus:ring-blue-600"
                                    id="">
                                    <option value="user" selected>یوزر </option>
                                    <option value="admin">ادمین سیستم</option>
                                    <option value="manager">مدیر بخش</option>

                                </select>
                            </div>
                        </div>

                    </div>
            </div>
            <br><br>
        </div>
        <div class="w-full bg-gray-200  py-4 px-4 ">
            <div class="flex items-center justify-start gap-4">
                <div>
                    <button type="submit" id="submit"
                        class="bg-blue-600 py-2 px-8 hover:bg-blue-700 text-white focus:ring-4 focus:to-blue-300 rounded-md shadow">ثبت
                        فورم</button>
                </div>
                <div>
                    <button type="reset"
                        class="bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:ring-red-400 py-2 px-8 text-black rounded-md ">لغو
                        فورم</button>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#user_create_form").submit(function(e) {
                e.preventDefault();
                $('#submit').text('درحال پروسیس...')
                $("#submit").prop("disabled", true)
                var form = $("#user_create_form")[0];
                var data = new FormData(form);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('user.store') }}",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $("#success_msg").html(` <div class="w-full bg-green-700 rounded text-white py-4">
                           <p class="px-10">${data.res}</p>
                           </div>`)
                        $("#submit").prop("disabled", false)
                        $('#submit').text('ثبت فورم')
                    },
                    error: function(erorr) {
                        console.log(erorr.responseJSON.message);
                    }

                })

            });
        })
    </script>
@endsection
