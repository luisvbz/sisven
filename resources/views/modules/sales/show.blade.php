@extends('modules.sales.base')

@section('header')
     Ventas /<small>Detalle de la venta</small>
@endsection

@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
             <div class="flex space-x-2">
                <div class="flex flex-col justify-center w-14"><img src="{{ asset('images/modules/VE.svg') }}"/></div>
                <div class="flex flex-col justify-center flex-grow">
                    <div class="text-lg font-semibold"><span class="text-gray-500">Venta:</span> {{ $sale->number }}</div>
                    <div class="text-sm font-semibold text-gray-500">
                        Fecha: <span class="text-alternative-500">{{ $sale->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
                <div class="flex flex-col justify-center">
                    <div class="text-2xl font-semibold text-alternative-500">{{ $sale->total_formated }}</div>
                    <div class="text-right">
                        @if($sale->status == 'proccesed')
                            <span class="bg-green-500 p-1 text-[0.70rem] text-white rounded font-semibold">PROCESADA</span>
                        @elseif($sale->status == 'canceled')
                            <span class="bg-red-500 p-1 text-[0.70rem] text-white rounded font-semibold">CANCELADA</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="py-2 mb-4 border-b border-gray-600 border-dotted"></div>
            <div class="grid grid-cols-3 gap-4 p-3 pb-2 mb-4 bg-white border border-gray-300 rounded-md">
                <div class="flex flex-col items-center justify-center">
                    <div class="text-sm font-semibold">
                        CLIENTE
                    </div>
                    <div>
                        {{ $sale->client->name }}
                    </div>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <div class="text-sm font-semibold">
                        VENDEDOR
                    </div>
                    <div>
                        {{ $sale->user->name }}
                    </div>
                </div>
                <div class="flex flex-col items-center justify-center">
                    <div class="text-sm font-semibold">
                        TIENDA
                    </div>
                    <div>
                        {{ $sale->store->name }}
                    </div>
                </div>
            </div>
            <div class="relative mt-2 overflow-x-auto border border-gray-300 rounded-lg shadow-md">
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
                            <td colspan="5" class="px-6 py-4 text-lg font-semibold text-right">
                                Total
                            </td>
                            <td  class="px-6 py-4 text-lg font-semibold text-right text-green-500">
                                {{ $sale->total_formated }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="flex justify-end mt-4">
                <a target="_blank"
                href="{{ route('ve.pdf', [$sale->id ])}}"
                class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2  focus:outline-none">Imprimir</a>
                @if($sale->status == 'proccesed')
                <Link href="#cancelar-compra" type="button"
                class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2  focus:outline-none">Cancelar Venta</Link>
                @endif
            </div>
            @if($sale->justification != null)
                <div class="py-2 border-b border-gray-300 border-dashed"></div>
                <div class="p-4 mt-4 bg-white border border-gray-300 rounded-md">
                    <div class="py-1 text-xs uppercase border-b border-gray-300 border-dashed">Venta cancelada por <span class="font-medium">{{ $sale->justification->user->name }}</span> el <span class="font-medium text-red-500">{{ $sale->justification->created_at->format('d/m/Y h:i a') }}</span></div>
                    <div class="pt-2">
                        {{ $sale->justification->justification }}
                    </div>
                </div>
            @endif
            @if($sale->status == 'proccesed')
                <x-splade-modal max-width="md" name="cancelar-compra">
                    <x-splade-form :default="['sale_id' => $sale->id]" action="{{ route('ve.cancel', [$sale->id]) }}" class="py-2">
                        <p class="pb-2 mb-2 font-medium text-gray-700 border-b border-gray-300 border-dashed">Deje una breve explicación del porque se está cancelando esta venta</p>
                        <x-splade-textarea name="justification" label="Justificación" autosize />
                        <div class="py-2 border-b border-gray-300 border-dashed"></div>
                        <div class="grid grid-cols-2 gap-4 py-2">
                            <button @click.prevent="modal.close" type="button"
                    class="px-4 py-2 font-bold text-white bg-red-500 rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:shadow-outline">Salir</button>
                        <x-splade-submit label="Cancelar Venta"/>
                        </div>
                    </x-splade-form>
                </x-splade-modal>
            @endif
        </div>
    </div>
@endsection
