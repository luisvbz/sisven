@extends('modules.stores.base')

@section('header')
    Tiendas
@endsection

@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-splade-table :for="$stores">
                    <x-splade-cell tipo as="$store">
                        @if($store->type == 'warehouse')
                            <span class="bg-primary-500 text-white text-xs px-2 py-1 rounded font-semibold">ALMACEN</span>
                        @else
                            <span class="bg-success-500 text-white text-xs px-2 py-1 rounded font-semibold">TIENDA</span>
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
@endsection
