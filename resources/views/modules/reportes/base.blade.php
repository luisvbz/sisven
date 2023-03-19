<x-app-layout>
    <x-slot name="header">
        @yield('header')
    </x-slot>

    <x-slot name="menu">
        <li class="my-px">
            <span class="flex px-4 my-4 text-sm font-medium text-gray-800 uppercase">Reportes</span>
          </li>
          <li class="my-px">
            <x-nav-link-sidebar :href="route('rp.index')" :active="request()->routeIs('rp.index')"
              class="flex flex-row items-center h-10 px-3 text-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700"
            >
              <span class="flex items-center justify-center text-lg text-alternative-400">
                <i class="fi fi-br-clipboard-list"></i>
              </span>
              <span class="ml-3">Lista</span>
            </x-nav-link-sidebar>
          </li>
    </x-slot>

    @yield('content')

</x-app-layout>
