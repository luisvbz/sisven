<x-app-layout>
    <x-slot name="header">
        @yield('header')
    </x-slot>

    <x-slot name="menu">
        <li>
            <span class="flex px-4 my-4 text-sm font-medium text-gray-600 uppercase">Usuarios</span>
          </li>
          <li>
            <x-nav-link-sidebar  :href="route('us.index')" :active="request()->routeIs('us.index')">
              <span class="flex items-center justify-center text-lg text-alternative-300">
                <i class="fi fi-br-clipboard-list"></i>
              </span>
              <span class="ml-3">Listado</span>
            </x-nav-link-sidebar>
          </li>
          @can('us:create')
          <li>
            <x-nav-link-sidebar  :href="route('us.add')" :active="request()->routeIs('us.add')">
              <span class="flex items-center justify-center text-lg text-alternative-300">
                <i class="fi fi-br-user-add"></i>
              </span>
              <span class="ml-3">Agregar</span>
            </x-nav-link-sidebar>
          </li>
          @endcan
           <div class="p-4 m-3 mt-4 text-sm font-semibold border rounded-md shadow bg-amber-100 border-amber-300">
             Módulo para gestionar usuarios
           </div>
    </x-slot>

    @yield('content')

</x-app-layout>

