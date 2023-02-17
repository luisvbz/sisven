@extends('modules.stores.base')

@section('header')
    Almacenes
@endsection

@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
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
@endsection
