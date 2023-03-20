<x-app-layout>
    <x-slot name="header">
        @yield('header')
    </x-slot>

    <x-slot name="menu">
        <li class="my-px">
            <span class="flex px-4 my-4 text-sm font-medium text-gray-800 uppercase">Tiendas</span>
          </li>
          <li class="my-px">
            <x-nav-link-sidebar :href="route('ti.index')" :active="request()->routeIs('ti.index')"
              class="flex flex-row items-center h-10 px-3 text-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700"
            >
              <span class="flex items-center justify-center text-lg text-alternative-400">
                <i class="fi fi-br-clipboard-list"></i>
              </span>
              <span class="ml-3">Listado</span>
            </x-nav-link-sidebar>
          </li>
          @can('ti:create')
          <li class="my-px">
            <x-nav-link-sidebar slideover :href="route('ti.add')" :active="request()->routeIs('ti.add')"
              class="flex flex-row items-center h-10 px-3 text-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700"
            >
              <span class="flex items-center justify-center text-lg text-alternative-400">
                <i class="fi fi-br-user-add"></i>
              </span>
              <span class="ml-3">Agregar</span>
            </x-nav-link-sidebar>
          </li>
          @endcan
          <div class="p-4 m-3 mt-4 text-sm font-semibold border rounded-md shadow bg-amber-100 border-amber-300">
             Módulo para gestionar las tiendas, aqui se puede ver el stock y movimientos de la misma
           </div>
    </x-slot>

    @yield('content')

</x-app-layout>

