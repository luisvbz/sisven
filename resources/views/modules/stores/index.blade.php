<x-app-layout>
    <x-slot name="header">
        <x-back-button-title route="/" module="Tiendas" />
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            {{-- @can('ti:create')
                <div class="p-3 mb-3 bg-white shadow-sm sm:rounded-lg">
                    <Link href="{{ route('ti.add') }}" class="button-primary"><span>Agregar</span> <i class="ml-2 fi fi-br-user-add"></i></Link>
                </div>
            @endcan --}}
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-splade-table :for="$stores" />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
