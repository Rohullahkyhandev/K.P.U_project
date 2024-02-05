<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>سیستم معاونیت علمی | صفحه ورد</title>
    <link rel="shortcut icon" href="{{ asset('photos/logo.PNG') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/shabnam-font/5.0.1/font-face.css">
    @vite('resources/css/app.css')
    {{-- tailwinds css  --}}
    {{-- jyqury ajax link  --}}
    <style>
        * {
            font-family: 'Shabnam';
            font-style: 'normal';
            margin: 0;
            padding: 0;
            direction: rtl
        }

        body {
            overflow-y: hidden;
        }

        @font-face {
            font-family: "Shabnam"
        }
    </style>
</head>

<body
    style="background-image: url('photos/FB_IMG_1695069135011.jpg');background-size: cover; background-repeat: no-repeat">
    <div
        style="width: 100%;height: 100vh;position: absolute;top: 0; left: 0; z-index: 10;;background-color: rgba(0, 0, 0, 0.7)">
    </div>
    <h1 style="position: absolute; z-index: 11;color: white; top: 15%;right:20%" class="text-3xl"> به سیستم مدیریت
        معاونیت علمی دانشگاه
        پولی تخنیک کابل خوش امدید !
    </h1>
    <br><br>
    <div class="w-full h-full flex flex-col items-center justify-center flex-col z-40 absolute">
        <div style="width: 40%">
            @include('flashMessages.success_message')
        </div>
        <br>
        <div class="flex  items-center justify-center   h-80 shadow rounded bg-white" style="width: 40%">

            <div class="py-8 px-6">
                <form action="{{ route('auth.login') }}" method="POST">
                    @csrf
                    <div class="mb-10 text-center">
                        <h1 class="text-2xl  text-gray-600">با حساب خود وارد شوید</h1>
                    </div>
                    <div>
                        <input type="text" name="email" id="email" required class="w-80 rounded-t"
                            placeholder=" ایمل آدرس...">
                    </div>

                    <div class="shadow">
                        <input type="password" name="password" required id="password" class="w-80 rounded-b"
                            placeholder="  رمز عبور...">
                    </div>


                    <div>
                        <div
                            class="bg-blue-600 rounded mt-5 flex items-center justify-between py-2 hover:bg-blue-800 transition-colors">
                            <div></div>
                            <button class="text-white px-3" id="submit" type="submit">ورد به سیستم</button>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white mx-3">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                            </svg>

                        </div>
                    </div>

                </form>
            </div>
            <div>
                <img src="{{ asset('photos/FB_IMG_1695069302535.jpg') }}" class="h-80 w-96 rounded-tl rounded-bl"
                    alt="kpu image">
            </div>

        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    {{-- <script>
        $(document).ready(function() {
            $('#login_form').submit(function(e) {
                e.preventDefault();
                e.preventDefault();
                $('#submit').text('درحال پروسیس...')
                $("#submit").prop("disabled", true)
                var form = $("#login_form")[0];
                var data = new FormData(form);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('login') }}",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $("#success_msg").html(` <div class="w-full bg-green-700 rounded text-white py-4">
                           <p class="px-10">${data.res}</p>
                           </div>`)
                        $("#submit").prop("disabled", false)
                        $('#submit').text('ورد به سیستم')
                    },
                    error: function(erorr) {
                        console.log(erorr.responseJSON.message);
                    }

                })
            });
        });
    </script> --}}

</body>

</html>
