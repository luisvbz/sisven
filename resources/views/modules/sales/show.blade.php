@extends('modules.sales.base')

@section('header')
     Ventas /<small>Detalle de la venta</small>
@endsection

@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
             <div class="flex space-x-2">
                <div class="flex flex-col justify-center w-14"><img src="{{ asset('images/modules/VE.svg') }}"/></div>
                <div class="flex flex-col flex-grow justify-center">
                    <div class="text-lg font-semibold">Detalles de la Venta</div>
                    <div class="text-sm font-semibold text-gray-500">
                        Fecha: <span class="text-alternative-500">{{ $sale->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
                <div class="flex flex-col justify-center">
                    <div class="text-2xl font-semibold text-alternative-500">{{ $sale->total_formated }}</div>
                    <div class="text-right">
                        @if($sale->status == 'proccesed')
                            <span class="bg-green-500 p-1 text-[0.70rem] text-white rounded font-semibold">PROCESADA</span>
                     @endif
                    </div>
                </div>
            </div>
            <div class="py-2 mb-4 border-b border-gray-600 border-dotted"></div>
            <div class="grid gap-4 pb-2 grid-cols-3 bg-white rounded-md p-3 border border-gray-300 mb-4">
                <div class="flex flex-col justify-center items-center">
                    <div class="text-sm font-semibold">
                        CLIENTE
                    </div>
                    <div>
                        {{ $sale->client->name }}
                    </div>
                </div>
                <div class="flex flex-col justify-center items-center">
                    <div class="text-sm font-semibold">
                        VENDEDOR
                    </div>
                    <div>
                        {{ $sale->user->name }}
                    </div>
                </div>
                <div class="flex flex-col justify-center items-center">
                    <div class="text-sm font-semibold">
                        TIENDA
                    </div>
                    <div>
                        {{ $sale->store->name }}
                    </div>
                </div>
            </div>
            <div class="relative mt-2 overflow-x-auto rounded-lg shadow-md border border-gray-300">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-primary-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-center">
                                Cant.
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                UM
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                TU
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Producto
                            </th>
                            <th scope="col" class="px-6 py-3 text-right">
                                Precio
                            </th>
                            <th scope="col" class="px-6 py-3 text-right">
                                Total
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sale->products as $item)
                        <tr class="bg-white border-b">
                            <td class="px-6 py-4 text-center">
                                {{ $item->quantity_type }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $item->type->alias }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{ $item->quantity_type*$item->type->quantity }}
                            </td>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowra">
                            {{ $item->product->full_name }}
                            </th>
                            <td class="px-6 py-4 font-semibold text-right">
                            {{ "S/ ".number_format($item->unit_price, 2,".", ",") }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-right">
                             {{ "S/ ".number_format($item->total, 2,".", ",") }}
                            </td>
                        </tr>
                        @endforeach
                        <tr class="bg-primary-50/2">
                            <td colspan="5" class="px-6 py-4 text-right text-lg font-semibold">
                                Total
                            </td>
                            <td  class="px-6 py-4 text-right text-lg font-semibold text-green-500">
                                {{ $sale->total_formated }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
