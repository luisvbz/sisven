@extends('modules.sales.base')

@section('header')
     Generar nueva ventas
@endsection

@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if(!is_array($stores))
                <div class="flex space-x-2">
                <div class="flex flex-col justify-center w-14"><img src="{{ asset('images/modules/TI.svg') }}"/></div>
                    <div class="flex flex-col justify-center">
                        <div class="text-lg font-semibold">{{ $stores->name }}</div>
                        <div class="text-sm font-semibold text-gray-500">Estas realizando una venta desde esta tienda</div>
                    </div>
                </div>
                <div class="py-2 mb-4 border-b border-gray-600 border-dotted"></div>
            @else
            @endif
            <x-splade-form :default="['store_id' =>  $stores->id]">
                <div class="flex">
                    <x-splade-select name="client_id" label="Seleccione el cliente"
                        placeholder="Seleccione el cliente"
                        :options="$clients"
                        option-label="name"
                        choices
                        option-value="id" />
                </div>
                <div class="flex flex-col lg:flex-row h-screen">
  <!-- Columna para la lista de productos -->
  <div class="w-full lg:w-4/5 bg-gray-100 px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Venta de productos</h1>
    <table class="w-full border-collapse">
      <thead>
        <tr>
          <th class="border border-gray-400 px-4 py-2">Tipo</th>
          <th class="border border-gray-400 px-4 py-2">Cantidad</th>
          <th class="border border-gray-400 px-4 py-2">Producto</th>
          <th class="border border-gray-400 px-4 py-2">Precio</th>
          <th class="border border-gray-400 px-4 py-2">Total</th>
        </tr>
      </thead>
      <tbody>
        <!-- Aquí se pueden agregar las filas de la tabla de forma dinámica, por ejemplo, usando PHP o JavaScript -->
        <tr>
          <td class="border border-gray-400 px-4 py-2">Tipo</td>
          <td class="border border-gray-400 px-4 py-2">Cantidad</td>
          <td class="border border-gray-400 px-4 py-2">Producto</td>
          <td class="border border-gray-400 px-4 py-2">Precio</td>
          <td class="border border-gray-400 px-4 py-2">Total</td>
        </tr>
      </tbody>
    </table>
  </div>
  <!-- Columna para el subtotal, total y tipo de pago -->
  <div class="w-full lg:w-2/5 bg-gray-200 px-4 py-8 flex flex-col justify-between">
    <div class="flex flex-col mb-8">
      <h2 class="text-xl font-bold mb-2">Resumen de la venta</h2>
      <div class="flex justify-between mb-2">
        <span class="text-gray-600">Subtotal:</span>
        <span class="text-gray-800 font-bold">$100.00</span>
      </div>
      <div class="flex justify-between mb-2">
        <span class="text-gray-600">Tipo de pago:</span>
        <span class="text-gray-800 font-bold">Efectivo</span>
      </div>
      <div class="flex justify-between">
        <span class="text-gray-600">Total:</span>
        <span class="text-gray-800 font-bold">$100.00</span>
      </div>
    </div>
    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
      Finalizar venta
    </button>
  </div>
</div>

                <pre class="bg-white p-4 rounded border border-gray-300 mt-4" v-text="form.$all"/>
            </x-splade-form>
        </div>
    </div>
@endsection
