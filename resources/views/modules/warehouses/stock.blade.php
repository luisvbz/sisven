@extends('modules.warehouses.base')

@section('header')
    Almacenes /<small> Stock</small>
@endsection

@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex space-x-2">
                <div class="flex flex-col justify-center w-14"><img src="{{ asset('images/modules/WR.svg') }}"/></div>
                <div class="flex flex-col justify-center">
                    <div class="text-lg font-semibold">{{ $warehouse->name }}</div>
                    <div class="text-sm font-semibold text-gray-500">Estas viendo el stock de este almacen</div>
                </div>
            </div>
            <div class="py-2 mb-4 border-b border-gray-600 border-dotted"></div>
            <x-splade-table :for="$stock">
                    <x-splade-cell stock as="$product">
                        {{ $product->warehouses[0]->pivot->quantity }}
                    </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
@endsection
