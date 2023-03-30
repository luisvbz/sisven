@extends('modules.orders.base')

@section('header')
     Compras / <small>Registrar</small>
@endsection

@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
            <div class="p-6 bg-white border-b border-gray-200 shadow sm:rounded-lg">
                <p class="text-sm text-center font-medium text-gray-600"><i class="fi-br-form"></i> Complete los datos del formulario para ingresar una nueva compra (esta compra agrega las cantidades al inventario)</p>
                <div class="px-2 py-2 mb-2 border-b-2 border-gray-300"></div>
                <x-splade-form default="{products: []}" action="{{ route('co.store') }}">
                 <div class="grid gap-4 pb-2 lg:grid-cols-2">
                    <x-splade-select name="supplier_id" label="Proveedor"
                        placeholder="Seleccione el proveedor"
                        :options="$suppliers"
                        option-label="name"
                        choices
                        option-value="id" />

                    <x-splade-input placeholder="Selecciona la fecha" name="date" label="Fecha de Compra" date />
                    <div>
                        <CurrencyInput
                        label="Costo total de compra"
                        v-model="form.cost"
                        :options="{ currency: 'PEN' }"
                        />
                        <x-splade-errors>
                            <p class="p-1 px-2 mt-1 text-xs font-bold text-white border rounded-lg bg-danger-500 text-centered" v-if="form.hasError('form.cost')" v-text="errors.first('form.cost')"/>
                        </x-splade-errors>
                    </div>
                     <x-splade-defer
                      url="{{ route('get-product' )}}"
                      watch-value="form.product_id"
                      watch-debounce="100"
                      method="POST"
                      request="{ product: form.product_id}"
                      manual
                    @success="(response) => form.products.push(response.product)">
                        <x-splade-select name="product_id" label="Productos"
                            class="flex-grow"
                            placeholder="Seleccione los productos"
                            :options="$products"
                            option-label="full_name"
                            choices
                            option-value="id" />
                </x-splade-defer>

                <x-splade-select name="warehouse_id" label="Almacen de destino"
                        placeholder="Seleccione el almacen de destino"
                        :options="$warehouses"
                        option-label="name"
                        choices
                        option-value="id" />


                 </div>
                <x-splade-errors>
                    <p class="p-1 px-2 mt-1 text-xs font-bold text-white border rounded-lg bg-danger-500 text-centered" v-if="form.hasError('form.products')" v-text="errors.first('form.products')"/>
                </x-splade-errors>
                 <div class="bg-primary-100 p-2 mb-2 rounde border border-primary-300 rounded-md" v-for="(product,index) in form.products">
                    <div class="bg-primary-400 px-2 rounded py-1 mb-2 text-white flex justify-between">
                        <div class="text-sm font-semibold" v-text="product.name"></div>
                        <div class="flex space-x-2">
                            <a class="text-white text-1xl cursor-pointer" @click="form.products.push({id: product.id, name: product.name, packages: null, quantity_per_packages: null, cost: 0})"><i class="fi fi-br-copy"></i></a>
                            <a class="text-white text-1xl cursor-pointer" @click="form.products.splice(index,1)"><i class="fi fi-br-trash"></i></a>
                        </div>
                    </div>
                    <div class="grid gap-4 pb-2 lg:grid-cols-4">
                        {{-- Cantidad de paquetes --}}
                        <label class="block">
                            <span class="block mb-1 font-sans text-sm font-medium text-gray-700">Paquetes</span>
                            <div class="flex border border-gray-300 rounded-md shadow-sm">
                                {{-- <span class="inline-flex items-center px-3 text-gray-500 border border-t-0 border-b-0 border-l-0 border-gray-300 rounded-l-md bg-gray-50"><i class="fi fi-br-dollar"></i></span> --}}
                                <div>
                                    <input
                                        v-model="product.packages"
                                        type="text"
                                        class="block w-full border-0 rounded-md focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed"
                                    />
                                     <x-splade-errors>
                                        <p class="p-1 px-2 mt-1 text-xs font-bold text-white border rounded-lg bg-danger-500 text-centered" v-if="form.hasError(`products.${index}.packages`)" v-text="errors.first(`products.${index}.packages`)"/>
                                    </x-splade-errors>
                                </div>
                            </div>
                        </label>
                         <label class="block">
                            <span class="block mb-1 font-sans text-sm font-medium text-gray-700">Cantidad por paquetes</span>
                            <div class="flex border border-gray-300 rounded-md shadow-sm">
                                {{-- <span class="inline-flex items-center px-3 text-gray-500 border border-t-0 border-b-0 border-l-0 border-gray-300 rounded-l-md bg-gray-50"><i class="fi fi-br-dollar"></i></span> --}}
                                <div>
                                    <input
                                        v-model="product.quantity_per_packages"
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
                            <span class="block mb-1 font-sans text-sm font-medium text-gray-700">Total</span>
                            <div class="flex border border-gray-300 rounded-md shadow-sm">
                                {{-- <span class="inline-flex items-center px-3 text-gray-500 border border-t-0 border-b-0 border-l-0 border-gray-300 rounded-l-md bg-gray-50"><i class="fi fi-br-dollar"></i></span> --}}
                                <input
                                    :value="product.packages*product.quantity_per_packages"
                                    disabled
                                    type="text"
                                    class="block w-full border-0 rounded-md focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed"
                                />
                            </div>
                        </label>
                            <div>
                            <CurrencyInput
                                label="Costo del producto"
                                v-model="product.cost"
                                :options="{ currency: 'PEN' }"
                                />
                                 <x-splade-errors>
                                    <p class="p-1 px-2 mt-1 text-xs font-bold text-white border rounded-lg bg-danger-500 text-centered" v-if="form.hasError(`products.${index}.cost`)" v-text="errors.first(`products.${index}.cost`)"/>
                                </x-splade-errors>
                            </div>
                    </div>
                 </div>
                <div class="px-2 py-1 mb-2 mb-5 border-b-2 border-gray-300"></div>
                <div class="flex justify-end">
                    <x-splade-submit class="button-primary" v-if="!form.processing">
                        <span class="mr-2">Guardar</span> <i class="leading-7 fi fi-br-disk"></i>
                    </x-splade-submit>
                    <img src="{{ asset('images/commons/loading.svg') }}" v-else/>
                </div>
                {{--  <div class="p-4 mt-4 bg-slate-200 rounded-md">
                    <pre v-text="form.$all" />
                 </div> --}}
                </x-splade-form>
            </div>
        </div>
    </div>
@endsection
