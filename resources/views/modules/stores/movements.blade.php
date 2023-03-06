@extends('modules.stores.base')

@section('header')
    Tiendas /<small>Movimientos de tienda</small>
@endsection

@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex space-x-2">
                <div class="flex flex-col justify-center w-14"><img src="{{ asset('images/modules/TI.svg') }}"/></div>
                <div class="flex flex-col justify-center">
                    <div class="text-lg font-semibold">{{ $store->name }}</div>
                    <div class="text-sm font-semibold text-gray-500">Estas viendo las entradas de mercancia a esta tienda</div>
                </div>
            </div>
            <div class="py-2 mb-4 border-b border-gray-600 border-dotted"></div>
            <x-splade-table :for="$movements">
                <x-splade-cell tipo as="$movement">
                    @if($movement->type == 'input')
                    <div class="w-full">
                        <span class="bg-success-500 p-1 text-[0.70rem] text-white rounded font-semibold">ENTRADA</span>
                    </div>
                    @else
                    <div class="w-full">
                        <span class="bg-danger-500 p-1 text-[0.70rem] text-white rounded font-semibold">SALIDA</span>
                    </div>
                    @endif
                </x-splade-cell>
                <x-splade-cell origen as="$movement">
                    <div class="w-full">
                        <span class="bg-primary-500 p-1 text-[0.70rem] text-white rounded font-semibold uppercase">
                            @if($movement->type == 'input')
                                {{ $movement->input->name }}
                            @else
                                {{ $movement->output->name }}
                            @endif
                        </span>
                    </div>
                </x-splade-cell>
                <x-splade-cell enlace as="$movement">
                    <div class="w-full">
                        <span class="p-1 text-[0.70rem] text-primary-600 font-semibold uppercase">
                            @if($movement->type == 'input')
                                <Link modal href="{{ $movement->type_action }}">
                                   Ver {{ $movement->input->name }} <i class="fi fi-br-link-alt"></i>
                                </Link>
                                @else
                                <Link modal href="{{ $movement->type_action }}">
                                   Ver {{ $movement->output->name }} <i class="fi fi-br-link-alt"></i>
                                </Link>
                                @endif
                        </span>
                    </div>
                </x-splade-cell>
                <x-splade-cell acciones as="$movement" use="$store">
                    <Link modal rel="tooltip" title="Ver detalles" href="{{ route('ti.movements-details', [$store, $movement])}}"><i class="mr-1 text-xl text-primary-400 hover:text-primary-600 fi fi-br-layer-plus"></i></Link>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
@endsection
