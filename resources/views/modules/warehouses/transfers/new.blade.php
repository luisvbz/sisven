@extends('modules.warehouses.base')

@section('header')
    Trasladar mercancia
@endsection

@section('content')
    <div class="py-0">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white border-b border-gray-200 shadow sm:rounded-lg">
                <p class="text-sm font-medium text-center text-gray-600"><i class="fi-br-form"></i> Complete los datos del formularios para realizar un traslado de mercancia (esta operación afecta el inventario)</p>
                <div class="px-2 py-2 mb-2 border-b-2 border-gray-300"></div>
                <x-splade-form default="{products: []}">
                    <div class="grid gap-4 pb-2 lg:grid-cols-2">
                        <x-splade-select name="warehouse_id" label="Origen"
                            placeholder="Seleccione el almacen de origen"
                            :options="$warehouses"
                            option-label="name"
                            choices
                            option-value="id" />

                        <x-splade-select name="store_id" label="Destino"
                            placeholder="Seleccione la tienda de destino"
                            :options="$stores"
                            option-label="name"
                            choices
                            option-value="id" />
                    </div>
                    <div class="grid gap-4 pb-2 lg:grid-cols-1" v-if="form.warehouse_id != ''">
                        <x-splade-select
                            label="Productos en el almacen seleccionado"
                            name="producto_id"
                            placeholder="Seleccione los productos"
                            option-label="name"
                            option-value="id"
                            choices class="mb-2"
                            remote-url="`/api/warehouse/${form.warehouse_id}/get-products`"
                        />
                    </div>
                </x-splade-form>
            </div>
        </div>
    </div>
@endsection
