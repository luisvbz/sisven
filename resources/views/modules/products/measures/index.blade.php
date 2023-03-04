@extends('modules.products.base')

@section('header')
     Productos / <small>Administrar unidades de medida</small>
@endsection


@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            @can('pr:create')
                <div class="flex p-3 mb-3 bg-white shadow-lg sm:rounded-lg">
                    <Link modal href="{{ route('pr.add-measures') }}" class="button-primary"><span>Agregar</span> <i class="ml-2 fi fi-br-box"></i></Link>
                </div>
            @endcan
            <x-splade-rehydrate on="product-measures-added-or-updated">
                <x-splade-table :for="$measures" striped>
                    <x-splade-cell acciones as="$measures">
                        <div class="flex justify-around">
                            <Link modal href="{{ route('pr.edit-measure', [$measures])}}"><i class="mr-1 text-xl text-green-400 hover:text-green-600 fi fi-br-edit"></i></Link>
                            <Link
                                confirm="Desea eliminar esta unidad de medida?"
                                confirm-button="Eliminar!"
                                confirm-measures="danger"
                                cancel-button="Cancelar"
                                require-password
                                method="DELETE"
                                href="{{ route('pr.delete-measure', [$measures])}}"><i class="mr-1 text-xl text-danger-400 hover:text-danger-600 fi fi-br-trash"></i></Link>
                        </div>

                    </x-splade-cell>
                </x-splade-table>
            </x-splade-rehydrate>
        </div>
    </div>
@endsection

