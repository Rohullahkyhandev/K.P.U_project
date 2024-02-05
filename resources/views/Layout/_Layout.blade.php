<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>سیستم مدیرت معاونیت علمی</title>
    <link rel="shortcut icon" href="{{ asset('photos/logo.PNG') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/shabnam-font/5.0.1/font-face.css">
    @vite('resources/css/app.css')
    {{-- tailwinds css  --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- jyqury ajax link  --}}

    {{-- some plugin for the dashboard chart
    <script src="{{ asset('assets/chartjs/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/chartjs/chartjs-light.js') }}"></script> --}}

    <style>
        * {
            font-family: 'Shabnam';
            font-style: 'normal';
            margin: 0;
            padding: 0;
            /* direction: rtl */
        }

        @font-face {
            font-family: "Shabnam"
        }



        th,
        td {
            font-size: 15px;
            /* font-weight: 600; */
        }
    </style>
    @yield('css')
    @yield('js')
</head>

<body dir="rtl">

    <div class="flex min-h-screen bg-gray-300">
        {{-- sidebar  --}}
        @include('front.partial.sidebar')
        {{-- end of sidebar  --}}

        <div class="flex flex-col flex-grow max-h-min" style="width: 100%">

            {{-- navbar  --}}
            @include('front.partial.navbar')
            {{-- end of navbar   --}}

            {{-- main container --}}
            <div class="mb-auto mr-6 ml-6">
                @yield('content')
            </div>
            {{-- end of container --}}


            {{-- footer  --}}
            @include('front.partial.footer')
            {{-- end of footer --}}

        </div>

    </div>
    {{-- ‌internal script path file --}}
    @vite('resources/js/app.js')
    {{-- custome js code --}}

    {{-- custome js code  --}}

    @yield('js')





</body>

</html>
