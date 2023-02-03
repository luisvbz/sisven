<div class="flex flex-col items-center min-h-screen pt-6 shadow-lg bg-gradient-to-b from-indigo-600 to-cyan-500 sm:justify-center sm:pt-0">

    <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">
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
