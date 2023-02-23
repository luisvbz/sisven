@extends('modules.warehouses.base')

@section('header')
    Almacenes
@endsection

@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-splade-table :for="$warehouses">
                <x-splade-cell Acciones>
                    <div class="space-x-2">
                        @can('wr:edit')
                            <Link  rel="tooltip" title="Editar este almacen" slideover href="{{ route('wr.edit', [$item])}}"><i class="mr-1 text-xl text-green-400 hover:text-green-600 fi fi-br-edit"></i></Link>
                        @endcan
                        <Link rel="tooltip" title="Ver inventario en este almacen" href="{{ route('wr.stock', [$item])}}"><i class="mr-1 text-xl text-primary-400 hover:text-primary-600 fi fi-br-boxes"></i></Link>
                        <Link rel="tooltip" title="Ver entradas y salidas de mercancia" href="{{ route('wr.movements', [$item])}}"><i class="mr-1 text-xl text-alternative-400 hover:text-alternative-600 fi fi-br-arrows-retweet"></i></Link>
                    </div>
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
@endsection
