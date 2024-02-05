@extends('Layout._Layout')

{{-- core form componnent that will use entire will system   --}}
@section('content')
    <div class="mt-10 m-10">
        <div class="flex items-start justify-between">
            <div class="flex items-center justify-center gap-3">
                <a href=""
                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-md flex items-center justify-center gap-3 focus:ring-2 focus:ring-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>

                    لیست صادره
                </a>
                <a href=""
                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-md flex items-center justify-center gap-3 focus:ring-2 focus:ring-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>

                    لیست وارده
                </a>
                <a href=""
                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-md flex items-center justify-center gap-3 focus:ring-2 focus:ring-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>

                    لیست صادره
                </a>
            </div>
            <div>
                <p>&nbsp;</p>
            </div>
        </div>
        <form action="">
            <div class="bg-white shadow  py-3 px-10 w-full mt-4">
                <div class="mb-5 mt-5 border-b">
                    <p class="text-xl font-semibold text-gray-600 mb-3">فورم ثبت مکتوب های صادره و رسیدات </p>
                </div>

                <div class="w-full flex items-center justify-between mr-8 mt-3">
                    <div>
                        <div class="md:w-3/12 mb-1">
                            <label class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4">
                                نمبر مسلسل <span class="text-red-400">*</span>
                            </label>
                        </div>
                        <div class="md:w-10/12 mr-4">
                            <input type="text" class="border-gray-400 md:w-6/12 shadow rounded "
                                placeholder="serial number">
                        </div>
                    </div>

                    <div class="w-full">
                        <div class="w-3/12">
                            <label for="name">
                                مبدأ مکتوب<span class="text-red-500">*</span></label>
                        </div>
                        <div class="w-8/12">
                            <input type="text"
                                class="rounded border  border-gray-300 shadow focus:ring-1  focus:outline-none focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="w-full">
                        <div class="w-3/12">
                            <label for="name">
                                مرسل الیه <span class="text-red-500">*</span></label>
                        </div>
                        <div class="w-8/12">
                            <input type="text"
                                class="rounded border  border-gray-300 shadow focus:ring-1  focus:outline-none focus:ring-indigo-500">
                        </div>
                    </div>
                </div>
                <div class="w-full flex items-center justify-around mr-8 mt-3">

                    <div class="w-full">
                        <div class="w-5/12">
                            <label for="name">اصل شعبه اجرایی <span class="text-red-500">*</span></label>
                        </div>
                        <div class="w-8/12">
                            <input type="text"
                                class="rounded border  border-gray-300 shadow focus:ring-1  focus:outline-none focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="w-full">
                        <div class="w-5/12">
                            <label for="name">
                                ضمیمه شعبه اجرایی <span class="text-red-500">*</span></label>
                        </div>
                        <div class="w-8/12">
                            <input type="text"
                                class="rounded border  border-gray-300 shadow focus:ring-1  focus:outline-none focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="w-full">

                        <div class="w-5/12">
                            <label for="name">
                                اصل شعبه ضبط اوراق<span class="text-red-500">*</span></label>
                        </div>
                        <div class="w-8/12">
                            <input type="text"
                                class="rounded border  border-gray-300 shadow focus:ring-1  focus:outline-none focus:ring-indigo-500">
                        </div>

                    </div>

                </div>
                <div class="w-full flex items-center justify-between mr-8  mt-3">
                    <div class="w-full">
                        <div class="w-6/12">
                            <label for="name">ضمیمه شعبه ضبط اوراق <span class="text-red-500">*</span></label>
                        </div>
                        <div class="w-10/12">
                            <input type="text"
                                class="rounded border  border-gray-300 shadow focus:ring-1  focus:outline-none focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="w-full">
                        <div class="w-5/12">
                            <label for="name">امضأ شده <span class="text-red-500">*</span></label>
                        </div>
                        <div class="w-10/12">
                            <input type="text"
                                class="rounded border  border-gray-300 shadow focus:ring-1  focus:outline-none focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="w-full">
                        <div class="w-5/12">
                            <label for="name"> تاریخ صدور مکتوب<span class="text-red-500">*</span></label>
                        </div>
                        <div class=w-full">
                            <input type="text"
                                class="rounded border  border-gray-300 shadow focus:ring-1  focus:outline-none focus:ring-indigo-500">
                        </div>
                    </div>


                </div>
                <br><br>
            </div>
            <footer class="bg-gray-200 py-5  flex items-start justify-start gap-10 px-10">
                <button
                    class="bg-blue-500 py-2 px-4 hover:bg-blue-700 text-white rounded-md shadow focus:ring-2 focus:ring-indigo-500">ثبت
                    فورم</button>
                <a href=""
                    class="bg-gray-400 py-2 px-4 hover:bg-gray-600 text-white rounded-md shadow focus:ring-2 focus:ring-red-500">لغو
                    فورم</a>
            </footer>
        </form>
    </div>
    <div class="mt-10 m-10">
        <div class="flex items-start justify-between">
            <div class="flex items-center justify-center gap-3">
                <a href=""
                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-md flex items-center justify-center gap-3 focus:ring-2 focus:ring-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                    </svg>
                    لیست صادره
                </a>
            </div>
            <div>
                <p>&nbsp;</p>
            </div>
        </div>
        <form action="">
            <div class="bg-white shadow  py-3 px-10 w-full mt-4">
                <div class="mb-5 mt-5 border-b">
                    <p class="text-xl font-semibold text-gray-600 mb-3">فورم کتابچه رسیدات مکتوب های صادره</p>
                </div>

                <div class="w-full flex items-center justify-between mr-3 mt-3">
                    <div class="w-full">
                        <div class="w-4/12">
                            <label for="name">نمبر مسلسل <span class="text-red-500">*</span></label>
                        </div>
                        <div class="w-9/12">
                            <input type="text"
                                class="rounded border w-full  border-gray-300 shadow focus:ring-1  focus:outline-none focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="w-full">
                        <div class="w-3/12">
                            <label for="name">
                                مبدأ مکتوب<span class="text-red-500">*</span></label>
                        </div>
                        <div class="w-8/12">
                            <input type="text"
                                class="rounded border  w-full  border-gray-300 shadow focus:ring-1  focus:outline-none focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="w-full">
                        <div class="w-3/12">
                            <label for="name">
                                مرسل الیه <span class="text-red-500">*</span></label>
                        </div>
                        <div class="w-8/12">
                            <input type="text"
                                class="rounded border   w-full border-gray-300 shadow focus:ring-1  focus:outline-none focus:ring-indigo-500">
                        </div>
                    </div>
                </div>
                <div class="w-full flex items-center justify-around mr-3 mt-3">

                    <div class="w-full">
                        <div class="w-5/12">
                            <label for="name">اصل شعبه اجرایی <span class="text-red-500">*</span></label>
                        </div>
                        <div class="w-8/12">
                            <input type="text"
                                class="rounded border  w-full  border-gray-300 shadow focus:ring-1  focus:outline-none focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="w-full">
                        <div class="w-5/12">
                            <label for="name">
                                ضمیمه شعبه اجرایی <span class="text-red-500">*</span></label>
                        </div>
                        <div class="w-8/12">
                            <input type="text"
                                class="rounded border  w-full  border-gray-300 shadow focus:ring-1  focus:outline-none focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="w-full">

                        <div class="w-5/12">
                            <label for="name">
                                اصل شعبه ضبط اوراق<span class="text-red-500">*</span></label>
                        </div>
                        <div class="w-8/12">
                            <input type="text"
                                class="rounded border  w-full border-gray-300 shadow focus:ring-1  focus:outline-none focus:ring-indigo-500">
                        </div>

                    </div>

                </div>
                <div class="w-full flex items-center justify-between mr-3  mt-3">
                    <div class="w-full">
                        <div class="w-6/12">
                            <label for="name">ضمیمه شعبه ضبط اوراق <span class="text-red-500">*</span></label>
                        </div>
                        <div class="w-10/12">
                            <input type="text"
                                class="rounded border  w-full  border-gray-300 shadow focus:ring-1  focus:outline-none focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="w-full">
                        <div class="w-5/12">
                            <label for="name">امضأ شده <span class="text-red-500">*</span></label>
                        </div>
                        <div class="w-10/12">
                            <input type="text"
                                class="rounded border  w-full  border-gray-300 shadow focus:ring-1  focus:outline-none focus:ring-indigo-500">
                        </div>
                    </div>

                    <div class="w-full">
                        <div class="w-5/12">
                            <label for="name"> تاریخ صدور مکتوب<span class="text-red-500">*</span></label>
                        </div>
                        <div class=w-full">
                            <input type="text"
                                class="rounded border  w-full  border-gray-300 shadow focus:ring-1  focus:outline-none focus:ring-indigo-500">
                        </div>
                    </div>


                </div>
                <br><br>
            </div>
            <footer class="bg-gray-200 py-5  flex items-start justify-start gap-10 px-10">
                <button
                    class="bg-blue-500 py-2 px-4 hover:bg-blue-700 text-white rounded-md shadow focus:ring-2 focus:ring-indigo-500">ثبت
                    فورم</button>
                <a href=""
                    class="bg-gray-400 py-2 px-4 hover:bg-gray-600 text-white rounded-md shadow focus:ring-2 focus:ring-red-500">لغو
                    فورم</a>
            </footer>
        </form>
    </div>
@endsection
{{-- end of core form --}}
