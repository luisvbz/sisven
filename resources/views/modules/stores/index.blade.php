<x-app-layout>
    <x-slot name="header">
        <x-back-button-title route="/" module="Tiendas" />
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @can('ti:create')
                <div class="p-3 mb-3 bg-white shadow-sm sm:rounded-lg">
                    <Link slideover href="{{ route('ti.add') }}" class="button-primary"><span>Agregar</span> <i class="ml-2 fi fi-br-add"></i></Link>
                </div>
            @endcan
            <div class="p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <x-splade-table :for="$stores">
                        <x-splade-cell principal as="$store">
                            @if($store->is_principal)
                                <div class="text-xl text-center text-green-600"><i class="fi fi-br-badge-check"></i></div>
                            @else
                            <div class="text-xl text-center text-gray-300"><i class="fi fi-br-no-people"></i></div>
                            @endif
                        </x-splade-cell>
                    <x-splade-cell actions>
                        @can('ti:edit')
                            <Link slideover href="{{ route('ti.edit', [$item])}}"><i class="mr-1 text-xl text-green-400 hover:text-green-600 fi fi-br-edit"></i></Link>
                        @endcan
                        @can('ti:delete')
                        <Link confirm="Desea eliminar esta tienda?"
                                        confirm-button="Eliminar!"
                                        confirm-type="danger"
                                        cancel-button="Cancelar"
                                        require-password
                                        method="DELETE"
                                        href="{{ route('ti.delete', [$item])}}" class="mr-1 text-xl text-danger-400 hover:text-danger-600"><i class="fi fi-br-trash"></i></Link>
                        @endcan
                    </x-splade-cell>
                </x-splade-table>
            </div>
        </div>
    </div>
</x-app-layout>
