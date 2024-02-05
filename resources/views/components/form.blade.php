@extends('Layout._Layout')

{{-- core form componnent that will use entire will system   --}}
@section('content')
    <div class="mt-10 m-10">
        <div class="flex items-start justify-between">
            <div>
                <a href=""
                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-md flex items-center justify-center gap-3 focus:ring-1 focus:bg-indigo-500">Some
                    Text</a>
            </div>
            <div>
                <p class="text-xl font-semibold text-gray-600">Some text will come here</p>
            </div>
        </div>
        <form action="">
            <div class="bg-white shadow py-20 px-10 w-full mt-4">
                <div>
                    <div class="md:w-3/12 mb-1">
                        <label class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4">
                            نمبر مسلسل <span class="text-red-400">*</span>
                        </label>
                    </div>
                    <div class="md:w-10/12 mr-4">
                        <input type="text" class="border-gray-400 md:w-6/12 shadow rounded " placeholder="serial number">
                    </div>
                </div>
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
