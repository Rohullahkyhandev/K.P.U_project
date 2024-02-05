<div>
    <div>
        <nav class="bg-white shadow-md h-14 flex items-center justify-between ">

            <div class="w-full flex items-center justify-center  mr-10">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
                </svg>
            </div>
            <div class="w-full">

            </div>
            <div class="menu flex  w-80 items-center justify-center mr-32">
                <div class="profile flex items-center justify-center">
                    <div class="flex items-center justify-center ml-5  cursor-pointer h-14 w-60 hover:bg-gray-200""
                        id="showProfile">
                        <img src="{{ Auth::user()->photo_path }}" class="rounded-full  h-10 w-12 hover:bg-gray-200"
                            alt="">
                        <p class="flex items-center justify-around">

                            <span class="mx-3">
                                @if (Auth::user())
                                    {{ Auth::user()->name }}
                                @endif
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 arrow">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </p>
                    </div>
                    <ul
                        class="absolute toggle transition-all  top-14 left-4 bg-white shadow-lg flex items-center justify-center flex-col  w-60">
                        <li class="hover:bg-gray-200 w-60 py-2 text-center ">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center justify-center gap-3 mr-8">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                    </svg>

                                    <span class="">خروج</span>

                                </button>
                            </form>
                        </li>
                        <li class="hover:bg-gray-200 w-60 py-2 text-center border-t  border-gray-200 ">
                            <a href="{{ url('/profile') }}" class="flex flex-1 gap-3 mr-8">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-blue-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                پروفایل

                            </a>


                        </li>
                    </ul>
                </div>

            </div>

        </nav>
    </div>
</div>

<style>
    .toggle {
        display: none;
    }

    .fade {
        display: flex;
    }

    .top_down {
        rotate: 180deg;
    }
</style>
