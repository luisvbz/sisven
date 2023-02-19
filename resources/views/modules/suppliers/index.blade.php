@extends('modules.suppliers.base')

@section('header')
    Proveedores
@endsection

@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <x-splade-table :for="$suppliers">
                @cell('creacion', $supplier)
                    {{ $supplier->created_at->format('d/m/Y')}}
                @endcell
                <x-splade-cell estado as="$supplier">
                        @if($supplier->status == 'active')
                            <div class="text-xl text-center text-green-600"><i class="fi fi-br-badge-check"></i></div>
                        @else
                            <div class="text-xl text-center text-red-600"><i class="fi fi-br-ban"></i></div>
                        @endif
                </x-splade-cell>
                <x-splade-cell acciones>
                    @can('pv:edit')
                        <Link slideover href="{{ route('pv.edit', [$item])}}"><i class="mr-1 text-xl text-green-400 hover:text-green-600 fi fi-br-edit"></i></Link>
                    @endcan
                    {{-- @can('pv:delete')
                    <Link confirm="Desea eliminar este proveedor?"
                                    confirm-button="Eliminar!"
                                    confirm-type="danger"
                                    cancel-button="Cancelar"
                                    require-password
                                    method="DELETE"
                                    href="{{ route('ti.delete', [$item])}}" class="mr-1 text-xl text-danger-400 hover:text-danger-600"><i class="fi fi-br-trash"></i></Link>
                    @endcan --}}
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
@endsection
