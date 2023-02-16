<div class="flex flex-col items-center justify-center min-h-screen pt-6 shadow-lg max-w- bg-gradient-to-b from-primary-800 to-cyan-600 sm:pt-0">

    <div class="flex px-6 py-4 m-6 overflow-hidden bg-white rounded-lg shadow-md sm:w-full sm:mt-6 max-md lg:max-w-3xl ">
        <div class="flex-col items-center justify-center hidden w-1/2 pr-3 mr-4 border-r border-gray-200 sm:flex">
            <img src="{{ asset('images/login.svg')}}" class="w-full" alt="login" >
        </div>
        <div class="grow">
            <div class="flex items-center justify-center pb-4 mb-4 border-b-2 border-gray-100">
                @isset($logo)
                    {{ $logo }}
                @else
                    <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
                @endisset
            </div>

            {{ $slot }}
        </div>
    </div>
</div>
