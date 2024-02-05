@extends('Layout._Layout')


@section('content')
    <div class="mt-10">
        <div class="bg-white rounded-md py-8 px-8 shadow">
            <div class="flex items-center justify-between">

                <div class="flex items-center justify-start mb-8 mr-5 flex-col ">
                    <div>
                        <img src="{{ asset('photos/FB_IMG_1695069302535.jpg') }}" class="h-10 w-10 rounded-full"
                            alt="">
                    </div>
                    <div>
                        <h1 class="text-gray-300">Engineer Amin </h1>
                    </div>
                </div>
                <div>
                    <p class=" text-gray-400">
                        {{ date('Y-M-D') }}
                    </p>
                </div>

            </div>
            <div>
                <div>
                    <img src="{{ asset('photos/FB_IMG_1695068825340.jpg') }}" class="h-80 rounded mt-5" alt="">
                </div>
                <div dir="ltr" class="mt-5 mr-10">
                    <h1 class="text-2xl font-semibold mb-3">Would you like to Learn about futures of IT?</h1>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores, repudiandae ad. Itaque modi
                        quos earum expedita dolor consequuntur quisquam exercitationem a, quia nisi labore eum possimus
                        porro doloribus consequatur enim!</p>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores, repudiandae ad. Itaque modi
                        quos earum expedita dolor consequuntur quisquam exercitationem a, quia nisi labore eum possimus
                        porro doloribus consequatur enim!</p>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores, repudiandae ad. Itaque modi
                        quos earum expedita dolor consequuntur quisquam exercitationem a, quia nisi labore eum possimus
                        porro doloribus consequatur enim!</p>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores, repudiandae ad. Itaque modi
                        quos earum expedita dolor consequuntur quisquam exercitationem a, quia nisi labore eum possimus
                        porro doloribus consequatur enim!</p>
                </div>
                <div class="flex items-center justify-center gap-3 mt-5">
                    <a href=""
                        class="bg-indigo-500 rounded px-4 py-2 shadow flex items-center justify-center gap-2 text-white">Like
                        Post
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                        </svg>

                    </a>

                    <a href=""
                        class="bg-indigo-500 rounded px-4 py-2 shadow flex items-center gap-3 justify-center text-white">Intrest
                        Post
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-red-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>


                    </a>
                </div>
            </div>
            <div>

            </div>
        </div>
    </div>
    <br><br><br>
@endsection
