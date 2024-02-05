@extends('Layout._Layout')


@section('content')
    <div class="mt-10 m-10">
        <div class=" flex items-center justify-between">
            <div>
                <a href="#"
                    class="bg-blue-500 hover:bg-blue-700 rounded-md shadow px-3 py-2 text-white flex items-center justify-between gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                    </svg>

                    داشبورد</a>
            </div>
            <div>
                <p class="text-2xl font-semibold">پروفایل کاربر</p>
            </div>

        </div>
        <div class="flex items-center justify-between  gap-3 mt-4">
            <div class="bg-white w-full rounded-lg shadow ">
                <h1>User Information</h1>
            </div>
            <div class="bg-white w-80 rounded py-10 flex items-center justify-center border border-">
                <img src="{{ Auth::user()->photo_path }}" class="w-40 h-40 rounded-full " alt="{{ Auth::user()->name }}">
            </div>
        </div>
    </div>
@endsection
