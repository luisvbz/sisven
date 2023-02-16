<x-app-layout>
    <x-slot name="header">
        <x-back-button-title route="/" module="Almacenes" />
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @can('wr:create')
                <div class="p-3 mb-3 bg-white shadow-sm sm:rounded-lg flex">
                    <Link slideover href="{{ route('wr.add') }}" class="button-primary mr-2"><span>Crear</span> <i class="ml-2 fi fi-br-add"></i></Link>
                </div>
            @endcan
            <div class="p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <x-splade-table :for="$warehouses">
                    <x-splade-cell Acciones>
                        @can('wr:edit')
                            <Link slideover href="{{ route('wr.edit', [$item])}}"><i class="mr-1 text-xl text-green-400 hover:text-green-600 fi fi-br-edit"></i></Link>
                        @endcan
                       {{--  @can('wr:delete')
                        <Link confirm="Desea eliminar este almacen?"
                                        confirm-button="Eliminar!"
                                        confirm-type="danger"
                                        cancel-button="Cancelar"
                                        require-password
                                        method="DELETE"
                                        href="{{ route('wr.delete', [$item])}}" class="mr-1 text-xl text-danger-400 hover:text-danger-600"><i class="fi fi-br-trash"></i></Link>
                        @endcan --}}
                    </x-splade-cell>
                </x-splade-table>
            </div>
        </div>
    </div>
</x-app-layout>
