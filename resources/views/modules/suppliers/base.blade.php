<x-app-layout>
    <x-slot name="header">
        @yield('header')
    </x-slot>

    <x-slot name="menu">
        <li>
            <span class="flex px-4 my-4 text-sm font-medium text-gray-700 uppercase">Proveedores</span>
          </li>
          <li>
            <x-nav-link-sidebar  :href="route('pv.index')" :active="request()->routeIs('pv.index')">
              <span class="flex items-center justify-center text-lg text-alternative-300">
                <i class="fi fi-br-clipboard-list"></i>
              </span>
              <span class="ml-3">Listado</span>
            </x-nav-link-sidebar>
          </li>
          @can('pv:create')
          <li>
            <x-nav-link-sidebar slideover :href="route('pv.add')" :active="request()->routeIs('pv.add')">
              <span class="flex items-center justify-center text-lg text-alternative-300">
                <i class="fi fi-br-layer-plus"></i>
              </span>
              <span class="ml-3">Agregar</span>
            </x-nav-link-sidebar>
          </li>
          @endcan
    </x-slot>

    @yield('content')

</x-app-layout>

