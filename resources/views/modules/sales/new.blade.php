@extends('modules.sales.base')

@section('header')
     Generar nueva venta
@endsection

@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <x-splade-form
            action="{{ route('ve.store')}}"
            confirm="Registra Venta"
            confirm-text="Estas seguro de registrar esta venta, esta acción no se puede eliminar?"
            confirm-button="Si, Vender!"
            cancel-button="Cancelar!"
             :default="[
                    'store_id' =>  $store->id ?? '',
                    'client_id' => null,
                    'types' => $types,
                    'products' => [],
                    'has_discount' => false,
                    'discount_percent' => 0,
                    'subtotal' => 0,
                    'total' => 0,
                    'blocked' => !auth()->user()->hasAnyRole(['super-admin', 'admin']),
                    'payment_methods' => []
                    ]">
            @role('vendedor')
                <div class="flex space-x-2">
                <div class="flex flex-col justify-center w-14"><img src="{{ asset('images/modules/TI.svg') }}"/></div>
                    <div class="flex flex-col justify-center">
                        <div class="text-lg font-semibold">{{ $stores->name }}</div>
                        <div class="text-sm font-semibold text-gray-500">Estas realizando una venta desde esta tienda</div>
                    </div>
                </div>
                <div class="py-2 mb-4 border-b border-gray-600 border-dotted"></div>
            @endrole
            @hasanyrole("admin|super-admin")
                <div class="flex space-x-2">
                    <div class="flex flex-col justify-center w-14"><img src="{{ asset('images/modules/TI.svg') }}"/></div>
                        <div class="flex flex-col justify-center">
                            <x-splade-select name="store_id" :options="$stores" option-label="name" option-value="id" placeholder="Seleccione la tienda para hacer la venta"/>
                        </div>
                    </div>
                <div class="py-2 mb-4 border-b border-gray-600 border-dotted"></div>
            @endrole

                <nueva-venta :form="form" :types="{{$payments}}">
                </nueva-venta>

                {{-- <pre class="p-4 mt-4 bg-white border border-gray-300 rounded" v-text="form.$all"/> --}}
            </x-splade-form>
        </div>
    </div>
@endsection
