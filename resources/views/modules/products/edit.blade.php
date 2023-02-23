@extends('modules.products.base')

@section('header')
     Productos / <small>Nuevo producto</small>
@endsection


@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="p-6 bg-white border-b border-gray-200 shadow-lg sm:rounded-lg">
                <x-splade-form  method="PATCH" action="{{ route('pr.update', [$product]) }}" :default="['product' => $product]">
                    <p class="text-sm font-medium text-gray-600"><i class="fi-br-form"></i> Editar Producto</p>
                    <div class="px-2 py-2 mb-2 border-b-2 border-gray-300"></div>
                    <div class="grid gap-4 pb-2 lg:grid-cols-2">
                      <x-splade-select name="product.type_id" label="Tipo de Producto"
                             placeholder="Seleccione el tipo de producto"
                             :options="$types"
                             option-label="package_name"
                             choices
                             disabled
                             option-value="id" />
                       <x-splade-input disabled name="product.code" label="Codigo" icon="ad"/>
                       <x-splade-input disabled name="product.description" label="Descripción" icon="info"/>
                       <x-splade-select disabled name="product.measure_id" label="Unidad de Medida"
                            placeholder="Selecciona la unidad de medida"
                            :options="$measures"
                             option-label="name"
                             choices
                             option-value="id" />
                      <x-splade-input name="product.minimun_stock" label="Stock minimo del producto" icon="hastag"/>
                      <div>
                          <CurrencyInput
                           label="Precio"
                            v-model="form.product.price"
                            :options="{ currency: 'PEN' }"
                          />
                          <x-splade-errors>
                            <p class="p-1 px-2 mt-1 text-xs font-bold text-white border rounded-lg bg-danger-500 text-centered" v-if="form.hasError('product.price')" v-text="errors.first('product.price')"/>
                        </x-splade-errors>
                      </div>
                        {{-- <InputMask mask="#-#" v-model="form.mask" label="Test"/> --}}
                        <div>
                            <CurrencyInput
                            label="Costo"
                                v-model="form.product.cost"
                                :options="{ currency: 'PEN' }"
                            />
                            <x-splade-errors>
                                <p class="p-1 px-2 mt-1 text-xs font-bold text-white border rounded-lg bg-danger-500 text-centered" v-if="form.hasError('product.price')" v-text="errors.first('product.price')"/>
                            </x-splade-errors>
                        </div>
                    </div>
                    <div class="px-2 py-1 mb-2 mb-5 border-b-2 border-gray-300"></div>
                    <x-splade-flash>
                        <div v-if="flash.has('status')" v-text="flash.status"/>
                    </x-splade-flash>
                    <div class="flex justify-end">
                        <x-splade-submit class="button-primary" v-if="!form.processing">
                           <span class="mr-2">Actualizar</span> <i class="leading-7 fi fi-br-disk"></i>
                       </x-splade-submit>
                       <img src="{{ asset('images/commons/loading.svg') }}" v-else/>
                    </div>
                </x-splade-form>
            </div>
        </div>
    </div>
@endsection
