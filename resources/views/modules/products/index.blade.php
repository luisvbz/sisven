<x-app-layout>
    <x-slot name="header">
        <x-back-button-title route="/" module="Productos" />
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                @can('pr:create')
                    <div class="flex p-3 mb-3 bg-white shadow-sm sm:rounded-lg">
                        <Link href="{{ route('pr.add') }}" class="button-primary"><span>Agregar</span> <i class="ml-2 fi fi-br-box"></i></Link>
                    </div>
                @endcan
        </div>
    </div>
</x-app-layout>
