<x-app-layout>
    <x-slot name="header">
        @yield('header')
    </x-slot>

    <x-slot name="menu">
        <li class="my-px">
            <span class="flex px-4 my-4 text-sm font-medium text-gray-800 uppercase">Clientes</span>
          </li>
          <li class="my-px">
            <x-nav-link-sidebar :href="route('cl.index')" :active="request()->routeIs('cl.index')"
              class="flex flex-row items-center h-10 px-3 text-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700"
            >
              <span class="flex items-center justify-center text-lg text-alternative-400">
                <i class="fi fi-br-clipboard-list"></i>
              </span>
              <span class="ml-3">Lista</span>
            </x-nav-link-sidebar>
          </li>
          @can('cl:create')
          <li class="my-px">
            <x-nav-link-sidebar slideover :href="route('cl.add')" :active="request()->routeIs('cl.add')"
              class="flex flex-row items-center h-10 px-3 text-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700"
            >
              <span class="flex items-center justify-center text-lg text-alternative-400">
                <i class="fi fi-br-money"></i>
              </span>
              <span class="ml-3">Agregar</span>
            </x-nav-link-sidebar>
          </li>
          @endcan
        <div class="p-4 m-3 mt-4 text-sm font-semibold border rounded-md shadow bg-amber-100 border-amber-300">
            Modulo para gestionar clientes
          </div>
    </x-slot>

    @yield('content')

</x-app-layout>
