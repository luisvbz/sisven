<x-app-layout>
    <x-slot name="header">
        @yield('header')
    </x-slot>

    <x-slot name="menu">
        <li>
            <span class="flex px-4 my-4 text-sm font-medium text-gray-600 uppercase">Productos</span>
          </li>
          <li>
            <x-nav-link-sidebar  :href="route('pr.index')" :active="request()->routeIs('pr.index')">
              <span class="flex items-center jpr.ify-center text-lg text-alternative-300">
                <i class="fi fi-br-clipboard-list"></i>
              </span>
              <span class="ml-3">Listado</span>
            </x-nav-link-sidebar>
          </li>
          @can('pr.create')
          <li>
            <x-nav-link-sidebar  :href="route('pr.add')" :active="request()->routeIs('pr.add')">
              <span class="flex items-center justify-center text-lg text-alternative-300">
                <i class="fi fi-br-box"></i>
              </span>
              <span class="ml-3">Agregar</span>
            </x-nav-link-sidebar>
          </li>
          @endcan
    </x-slot>

    @yield('content')

</x-app-layout>
