@extends('modules.products.base')

@section('header')
     Productos / Entradas
@endsection


@section('content')
<div class="py-0">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex space-x-2">
            <div class="flex flex-col justify-center w-14"><img src="{{ asset('images/modules/PR.svg') }}"/></div>
            <div class="flex flex-col justify-center flex-grow">
                <div class="text-lg font-semibold"><span class="text-primary-600"> {{ $product->full_name }}</span></div>
                <div class="text-sm font-semibold text-gray-500">
                    Entradas del Producto
                </div>
            </div>
        </div>
        <div class="py-2 mb-4 border-b border-gray-600 border-dotted"></div>
        <div class="relative mt-2 overflow-x-auto rounded-lg shadow-md">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-primary-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Proveedor
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            Paquetes
                        </th>
                        <th scope="col" class="px-6 py-3 text-right">
                            Total
                        </th>
                        <th scope="col" class="px-6 py-3 text-right">
                            Costo
                        </th>
                        <th scope="col" class="px-6 py-3 text-right">
                            Fecha Compra
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entrances as $detail)
                    <tr class="bg-white border-b">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowra">
                        {{ $detail->order->supplier->name }}
                        </th>
                        <td class="px-6 py-4 text-center">
                        {{ $detail->packages."*".$detail->quantity_per_packages }}
                        </td>
                        <td class="px-6 py-4 font-semibold text-right text-success-600">
                        {{ $detail->total }}
                        </td>
                        <td class="px-6 py-4 font-semibold text-right">
                        {{ $detail->cost_formated }}
                        </td>
                        <td class="px-6 py-4 font-semibold text-right">
                        {{ $detail->created_at }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
