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
                <x-splade-form default="{products: []}" method="POST" action="{{ route('wr.trasnfer-store') }}">
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
                    <x-splade-defer
                       url="`/api/warehouse/${form.warehouse_id}/product/${form.product_id}`"
                       watch-value="form.product_id"
                       watch-debounce="100"
                       request="{ product: form.product_id}"
                       manual
                      @success="(response) => form.products.push(response.product)">
                         <x-splade-select
                            label="Productos en el almacen seleccionado"
                            name="product_id"
                            placeholder="Seleccione los productos"
                            option-label="name"
                            option-value="id"
                            choices class="mb-2"
                            remote-url="`/api/warehouse/${form.warehouse_id}/get-products`"
                        />
                        </x-splade-defer>
                    </div>
                    <x-splade-errors>
                        <p class="p-1 px-2 mt-1 text-xs font-bold text-white border rounded-lg bg-danger-500 text-centered" v-if="form.hasError('form.products')" v-text="errors.first('form.products')"/>
                    </x-splade-errors>
                     <div class="bg-primary-100 p-2 mb-2 rounde border border-primary-300 rounded-md" v-for="(product,index) in form.products">
                        <div class="bg-primary-400 px-2 rounded py-1 mb-2 text-white flex justify-between">
                            <div class="text-sm font-semibold" v-text="product.name"></div>
                            <div>
                                <a class="text-white text-1xl cursor-pointer" @click="form.products.splice(index,1)"><i class="fi fi-br-trash"></i></a>
                            </div>
                        </div>
                        <div class="grid gap-4 pb-2 lg:grid-cols-2">
                            <label class="block">
                                <span class="block mb-1 font-sans text-sm font-medium text-gray-700">Cantidad Disponible</span>
                                <div class="flex border border-gray-300 rounded-md shadow-sm">
                                    <div class="w-full">
                                        <input
                                            readonly
                                            v-model="product.avalaible"
                                            type="text"
                                            class="block w-full border-0 rounded-md focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed"
                                        />
                                        <x-splade-errors>
                                            <p class="p-1 px-2 mt-1 text-xs font-bold text-white border rounded-lg bg-danger-500 text-centered" v-if="form.hasError(`products.${index}.quantity_per_packages`)" v-text="errors.first(`products.${index}.quantity_per_packages`)"/>
                                        </x-splade-errors>
                                    </div>
                                </div>
                            </label>
                            <label class="block">
                                <span class="block mb-1 font-sans text-sm font-medium text-gray-700">Cantidad a Trasladar</span>
                                <div class="flex border border-gray-300 rounded-md shadow-sm">
                                    {{-- <span class="inline-flex items-center px-3 text-gray-500 border border-t-0 border-b-0 border-l-0 border-gray-300 rounded-l-md bg-gray-50"><i class="fi fi-br-dollar"></i></span> --}}
                                    <div class="w-full">
                                        <input
                                            v-model="product.quantity"
                                            type="text"
                                            class="block w-full border-0 rounded-md focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed"
                                        />
                                        <p v-if="product.quantity > product.avalaible" class="p-1 px-2 mt-1 text-xs font-bold text-white border rounded-lg bg-danger-500 text-centered">No puede agregar una cantidad mayor a la disponible</p>
                                        <x-splade-errors>
                                                <p class="p-1 px-2 mt-1 text-xs font-bold text-white border rounded-lg bg-danger-500 text-centered" v-if="form.hasError(`products.${index}.quantity`)" v-text="errors.first(`products.${index}.quantity`)"/>
                                            </x-splade-errors>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="px-2 py-1 mb-2 mb-5 border-b-2 border-gray-300"></div>
                    <div class="flex justify-end">
                        <x-splade-submit class="button-primary" v-if="!form.processing">
                            <span class="mr-2">Guardar</span> <i class="leading-7 fi fi-br-disk"></i>
                        </x-splade-submit>
                        <img src="{{ asset('images/commons/loading.svg') }}" v-else/>
                    </div>
                </x-splade-form>
            </div>
        </div>
    </div>
@endsection
