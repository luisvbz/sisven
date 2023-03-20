<x-app-layout>
    <x-slot name="header">
        @yield('header')
    </x-slot>

    <x-slot name="menu">
        <li>
            <span class="flex px-4 my-4 text-sm font-medium text-gray-700 uppercase">Compras</span>
          </li>
          <li>
            <x-nav-link-sidebar  :href="route('co.index')" :active="request()->routeIs('co.index')">
              <span class="flex items-center justify-center text-lg text-alternative-300">
                <i class="fi fi-br-clipboard-list"></i>
              </span>
              <span class="ml-3">Listado</span>
            </x-nav-link-sidebar>
          </li>
          @can('co:create')
          <li>
            <x-nav-link-sidebar :href="route('co.add')" :active="request()->routeIs('co.add')">
              <span class="flex items-center justify-center text-lg text-alternative-300">
                <i class="fi fi-br-layer-plus"></i>
              </span>
              <span class="ml-3">Registrar Compra</span>
            </x-nav-link-sidebar>
          </li>
          @endcan
          <div class="p-4 m-3 mt-4 text-sm font-semibold border rounded-md shadow bg-amber-100 border-amber-300">
            Modulo para agregar compras a proveedores, esto afecta el stock de los productos
          </div>
    </x-slot>

    @yield('content')

</x-app-layout>
