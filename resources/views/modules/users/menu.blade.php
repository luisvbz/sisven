<li class="my-px">
<span class="flex px-4 my-4 text-sm font-medium text-gray-300 uppercase">Usuarios</span>
</li>
<li class="my-px">
<x-nav-link-sidebar  :href="route('us.index')" :active="request()->routeIs('us.index')"
    class="flex flex-row items-center h-10 px-3 text-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700"
>
    <span class="flex items-center justify-center text-lg text-alternative-400">
    <i class="fi fi-br-clipboard-list"></i>
    </svg>
    </span>
    <span class="ml-3">Listado</span>
</x-nav-link-sidebar>
</li>
@can('us:create')
<li class="my-px">
<x-nav-link-sidebar  :href="route('us.add')" :active="request()->routeIs('us.add')"
    class="flex flex-row items-center h-10 px-3 text-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700"
>
    <span class="flex items-center justify-center text-lg text-alternative-400">
    <i class="fi fi-br-user-add"></i>
    </span>
    <span class="ml-3">Agregar</span>
</x-nav-link-sidebar>
</li>
@endcan
