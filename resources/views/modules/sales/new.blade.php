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

                <pre class="bg-white p-4 rounded border border-gray-300 mt-4" v-text="form.$all"/>
            </x-splade-form>
        </div>
    </div>
@endsection
