@extends('modules.stores.base')

@section('header')
    Tiendas
@endsection

@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-splade-table :for="$stores">
                <x-splade-cell actions>
                    <Link rel="tooltip" title="Ver entradas y salidas de mercancia" href="{{ route('ti.movements', [$item])}}"><i class="mr-1 text-xl text-alternative-400 hover:text-alternative-600 fi fi-br-arrows-retweet"></i></Link>
                    <Link rel="tooltip" title="Ver inventario en esta tienda" href="{{ route('ti.stock', [$item])}}"><i class="mr-1 text-xl text-primary-400 hover:text-primary-600 fi fi-br-boxes"></i></Link>
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
@endsection
