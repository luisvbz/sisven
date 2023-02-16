<div class="flex flex-row min-h-screen text-gray-800 bg-gray-100">
    <x-sidebar>
        {{ $menu ?? ''}}
    </x-sidebar>
    <main class="flex flex-col flex-grow -ml-64 transition-all duration-150 ease-in main md:ml-0">
        <x-header/>
      <div class="flex flex-col flex-grow main-content">
        <div class="px-4 py-2 border-b border-gray-300 bg-gradient-to-b from-gray-300 to-gray-200">
            <span class="font-semibold text-">{{ $header }}</span>
        </div>

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
