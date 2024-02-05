@if (session('success'))
    <div id="success_box" class="bg-blue-400  rounded px-8  py-4 w-full flex items-center justify-between">
        <div class="flex items-center justify-between w-full ">
            <div>
                <button id="successBtn"
                    class="shadow flex items-center justify-center bg-red-100 transition-colors hover:bg-red-400 rounded-full font-semibold w-10 h-10 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>

                </button>
            </div>
            <div>
                <p class="text-white text-2xl">
                    {{ session('success') }} &nbsp; @if (Auth::user())
                        {{ Auth::user()->full_name }}
                    @endif
                </p>
            </div>
        </div>
    </div>
@endif

@if (session('error'))
    <div id="error_box" class="bg-red-500  rounded px-8  py-4 w-full flex items-center justify-between">
        <div class="flex items-center justify-between w-full ">
            <div>
                <button id="errorBtn"
                    class="shadow flex items-center justify-center bg-red-100 transition-colors hover:bg-red-400 rounded-full font-semibold w-10 h-10 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>

                </button>
            </div>
            <div>
                <p class="text-white text-2xl">{{ session('error') }}</p>
            </div>
        </div>
    </div>
@endif

<script>
    const success_box = document.getElementById('success_box');
    const error_box = document.getElementById('error_box');
    const successBtn = document.getElementById('successBtn');
    const errorBtn = document.getElementById('errorBtn');

    // errorBtn.addEventListener('click', () => {
    //     error_box.style.display = 'none';
    // })

    successBtn.addEventListener('click', () => {
        success_box.style.display = 'none';
    })
</script>
