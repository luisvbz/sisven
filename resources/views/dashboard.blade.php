<x-app-layout>
    <x-slot name="header">
          Inicio
    </x-slot>
    <x-slot name="menu">
        <div class="p-4 m-3 mt-4 text-sm font-semibold border rounded-md shadow bg-amber-100 border-amber-300">
            Seleccione un módulo en su derecha para cargar el menú
        </div>
    </x-slot>

    <div class="py-0">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="pb-2 mb-4 text-sm text-gray-600 border-b border-gray-300">
            Haga click en el modulo que desea acceder:
            </div>
            <div class="grid gap-2 lg:grid-cols-4 sm:grid-cols-1 sm:gap-4">
                @foreach ($modules as $module )
                    @can($module->permission_to_access)
                        <x-item-module :module="$module"/>
                    @endcan
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
