@extends('modules.bills.base')

@section('header')
     Agregar Documento Electrónico
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
                    'client_id' => null,
                    'types' => $types,
                    'products' => [],
                    'has_discount' => false,
                    'discount_percent' => 0,
                    'subtotal' => 0,
                    'total' => 0
                    ]">
                <new-bill :form="form"/>
                {{-- <pre class="bg-white p-4 rounded border border-gray-300 mt-4" v-text="form.$all"/> --}}
            </x-splade-form>
        </div>
    </div>
@endsection
