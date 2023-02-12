<x-app-layout>
    <x-slot name="header">
        <x-back-button-title route="{{ route('pr.add') }}" module="Productos" page="Administrar tipos"/>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
                @can('pr:create')
                    <div class="flex p-3 mb-3 bg-white shadow-lg sm:rounded-lg">
                        <Link modal href="{{ route('pr.add-types') }}" class="button-primary"><span>Agregar</span> <i class="ml-2 fi fi-br-box"></i></Link>
                    </div>
                @endcan
                <div class="p-6 bg-white border-b border-gray-200 shadow-lg sm:rounded-lg">
                    <x-splade-table :for="$types" striped>
                        <x-splade-cell acciones as="$type">
                            <div class="flex justify-around">
                                <Link href="/"><i class="mr-1 text-xl text-green-400 hover:text-green-600 fi fi-br-edit"></i></Link>
                                <Link
                                    confirm="Desea eliminar este tipo de producto?"
                                    confirm-button="Eliminar!"
                                    confirm-type="danger"
                                    cancel-button="Cancelar"
                                    require-password
                                    method="DELETE"
                                 href="{{ route('pr.delete-type', [$type])}}"><i class="mr-1 text-xl text-danger-400 hover:text-danger-600 fi fi-br-trash"></i></Link>
                            </div>

                        </x-splade-cell>
                    </x-splade-table>
                </div>
        </div>
    </div>
</x-app-layout>
