@extends('modules.reportes.base')

@section('header')
     Reportes
@endsection

@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Top -->
            <div class="grid grid-cols-4 gap-2 pb-4 border-b-2 border-gray-300 border-dashed">
                <div class="flex justify-between p-4 bg-white border border-gray-300 rounded-md">
                    <div class="flex justify-center w-1/4">
                        <img class="max-w-[50px]" src="{{ asset('images/modules/VE.svg') }}"/>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                        <div class="text-xs font-bold text-gray-500 uppercase">
                            ventas realizadas
                        </div>
                        <div class="text-2xl">
                            {{ $total_ventas }}
                        </div>
                    </div>
                </div>
                <div class="flex justify-between p-4 bg-white border border-gray-300 rounded-md">
                    <div class="flex justify-center w-1/4">
                        <img class="max-w-[50px]" src="{{ asset('images/modules/PR.svg') }}"/>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                        <div class="text-xs font-bold text-gray-500 uppercase">
                            productos registrados
                        </div>
                        <div class="text-2xl">
                            {{ $total_productos }}
                        </div>
                    </div>
                </div>
                <div class="flex justify-between p-4 bg-white border border-gray-300 rounded-md">
                    <div class="flex justify-center w-1/4">
                        <img class="max-w-[50px]" src="{{ asset('images/modules/CL.svg') }}"/>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                        <div class="text-xs font-bold text-gray-500 uppercase">
                            clientes registrados
                        </div>
                        <div class="text-2xl">
                            {{ $total_clientes }}
                        </div>
                    </div>
                </div>
                <div class="flex justify-between p-4 bg-white border border-gray-300 rounded-md">
                    <div class="flex justify-center w-1/4">
                        <img class="max-w-[50px]" src="{{ asset('images/modules/PV.svg') }}"/>
                    </div>
                    <div class="flex flex-col items-center justify-center">
                        <div class="text-xs font-bold text-gray-500 uppercase">
                            proveedores registrados
                        </div>
                        <div class="text-2xl">
                            {{ $total_proveedores }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Top -->
            <!-- Total Venta -->
            <div class="flex justify-end p-4 my-4 bg-white border border-gray-300 rounded-md">
                <div class="text-xl font-semibold text-gray-600 uppercase">
                    Total Vendido: <span class="ml-2 text-success-600">S./ {{ number_format($total_vendido, 2,".", ",") }}</span>
                </div>
            </div>
            <!-- /Total Venta -->
            <div class="mb-4 border-b-2 border-gray-300 border-dashed"></div>
            <!-- Total Venta -->
            <div class="relative my-4 mt-2 overflow-x-auto border border-gray-300 rounded-md">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-primary-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Reporte
                            </th>
                            <th scope="col" class="px-6 py-3 text-right"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowra">
                            Reporte de Inventario General
                            </th>
                            <td class="px-6 py-4 font-semibold text-right">
                                <a href="{{ route('rp.inventory') }}" download target="_blank" class="px-4 py-2 text-white rounded-md cursor-pointer bg-success-500 hover:bg-success-600">Descargar <i class="fi fi-br-file-excel"></i></a>
                            </td>
                        </tr>
                        <tr class="bg-white border-b">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowra">
                            Reporte General
                            </th>
                            <td class="px-6 py-4 font-semibold text-right">
                                <a href="{{ route('rp.general') }}" target="_blank" class="px-4 py-2 text-white rounded-md cursor-pointer bg-success-500 hover:bg-success-600">Descargar <i class="fi fi-br-file-excel"></i></a>
                            </td>
                        </tr>
                        {{-- <tr class="border-b bg-gray-50">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowra">
                            Reporte de Inventario con Tiendas
                            </th>
                            <td class="px-6 py-4 font-semibold text-right">
                                <a class="px-4 py-2 text-white rounded-md cursor-pointer bg-success-500 hover:bg-success-600">Descargar <i class="fi fi-br-file-excel"></i></a>
                            </td>
                        </tr>
                        <tr class="border-b bg-gray-50">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowra">
                            Reporte de Inventario con Almacen
                            </th>
                            <td class="px-6 py-4 font-semibold text-right">
                                <a class="px-4 py-2 text-white rounded-md cursor-pointer bg-success-500 hover:bg-success-600">Descargar <i class="fi fi-br-file-excel"></i></a>
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
            <!-- Reportes de Inventario -->
            </div>
        <div class="mb-4 border-b-2 border-gray-300 border-dashed"></div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <div class="font-semibold text-gray-600 uppercase text-md">Top 10 Clientes</div>
                <div class="relative my-4 mt-2 overflow-x-auto border border-gray-300 rounded-md">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-primary-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    DNI
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nombre
                                </th>
                                <th scope="col" class="px-6 py-3 text-right">Ventas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($top_clientes as $client)
                            <tr class="bg-white border-b">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-600 whitespace-nowra">
                                    {{ $client->document_number}}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-600 whitespace-nowra">
                                    {{ $client->name}}
                                </td>
                                <td class="px-6 py-4 font-semibold text-right">
                                    S./ {{ number_format($client->sales_sum_total, 2,".", ",") }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <div>
                <div class="font-semibold text-gray-600 uppercase text-md">Top 10 Productos</div>
                <div class="relative my-4 mt-2 overflow-x-auto border border-gray-300 rounded-md">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-primary-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Producto
                                </th>
                                <th scope="col" class="px-6 py-3 text-right">
                                    Vendido
                                </th>
                                {{-- <th scope="col" class="px-6 py-3 text-right">Ventas</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($top_productos as $product)
                            <tr class="bg-white border-b">
                                <td scope="row" class="px-6 py-4 font-medium text-gray-600 whitespace-nowra">
                                    {{ $product->full_name}}
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-right text-gray-600 whitespace-nowra">
                                    {{ $product->ventas_count }}
                                </td>
                                {{-- <td class="px-6 py-4 font-semibold text-right">
                                    S./ {{ number_format($client->sales_sum_total, 2,".", ",") }}
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
