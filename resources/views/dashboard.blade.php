<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Inicio
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="px-4 mx-auto max-w-7xl">
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
