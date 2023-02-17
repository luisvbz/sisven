<x-app-layout>
    <x-slot name="header">
          Inicio
    </x-slot>

    <div class="py-0">
        <div class="px-4 mx-auto max-w-7xl">
            <div class="mb-4 border-b border-gray-300 pb-2 text-sm text-gray-600">
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
