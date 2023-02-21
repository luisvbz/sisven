<div class="flex flex-row min-h-screen text-gray-800 bg-gray-100">
    <x-sidebar>
        {{ $menu ?? ''}}
    </x-sidebar>
    <main class="flex flex-col flex-grow transition-all duration-150 ease-in main md:ml-0">
        <x-header/>
      <div class="flex flex-col flex-grow main-content">
        <div class="px-4 py-2 border-b border-gray-300 bg-gradient-to-b from-gray-300 to-gray-200">
            <span class="font-semibold text-">{{ $header }}</span>
        </div>

        {{-- <x-splade-flash>
            <div v-if="flash.has('success')" class="flex items-center max-w-4xl p-3 mx-auto mt-8 rounded sm:px-6 lg:px-8 bg-success-200">
                <div tabindex="0" aria-label="success icon" role="img" class="flex items-center justify-center flex-shrink-0 w-8 h-8 border border-green-200 rounded-full focus:outline-none">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.66674 10.1147L12.7947 3.98599L13.7381 4.92866L6.66674 12L2.42407 7.75733L3.36674 6.81466L6.66674 10.1147Z" fill="#047857"></path>
                    </svg>
                </div>
                <div class="w-full pl-3">
                    <div class="flex items-center justify-between">
                    <p tabindex="0" class="text-sm font-semibold leading-none focus:outline-none text-success-600" v-text="flash.success"></p>
                    </div>
                </div>
            </div>
        </x-splade-flash> --}}
        <div class="flex flex-col flex-grow p-4 mt-4">
            {{ $slot }}
        </div>
      </div>
      <footer class="px-4 py-6 footer">
        <div class="footer-content">
          <p class="text-sm text-center text-gray-600">© Sisven 2023. Todos los derechos reservados. <a href="https://twitter.com/iaminos">by iAmine</a></p>
        </div>
      </footer>
    </main>
   {{--  @include('layouts.navigation')

    <!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
            {{ $header }}
        </div>
    </header>

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main> --}}
</div>
