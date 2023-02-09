<x-app-layout>
    <x-slot name="header">
        <x-back-button-title route="/productos" module="Productos" page="Agregar" />
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white border-b border-gray-200 shadow-lg sm:rounded-lg">
                <x-splade-form stay restore-on-success preserve-scroll action="{{ route('pr.store') }}" :default="['price_per_dozen' => 0, 'stores' => $stores ]">
                    <p class="text-sm font-medium text-gray-600"><i class="fi-br-form"></i> Complete los datos del formulario para agregar un nuevo producto</p>
                    <div class="px-2 py-2 mb-2 border-b-2 border-gray-300"></div>
                    <div class="grid gap-4 pb-2 lg:grid-cols-2">
                      <x-splade-select name="type_id" label="Tipo de Producto"
                             placeholder="Seleccione el tipo de producto"
                             :options="$types"
                             option-label="package_name"
                             choices
                             option-value="id" />
                       <x-splade-input name="code" label="Codigo" icon="ad"/>
                       <x-splade-input name="description" label="Descripción" icon="info"/>
                       <x-splade-select name="measure_id" label="Unidad de Medida"
                            placeholder="Selecciona la unidad de medida"
                            :options="$measures"
                             option-label="name"
                             choices
                             option-value="id" />
                      <x-splade-input name="minimum_stock" label="Stock minimo del producto" icon="hastag"/>
                      <CurrencyInput
                       label="Precio por unidad"
                        v-model="form.price_per_unit"
                        :options="{ currency: 'PEN' }"
                      />
                      <x-splade-defer v-if="form.type_id != ''"
                            url="`/commons/get-type-category/${form.type_id}`"
                            method="get"
                            watch-value="form.type_id">
                            <CurrencyInput v-if="response.category == 'docena'"
                                label="Precio por docena"
                                    v-model="form.price_per_dozen"
                                    :options="{ currency: 'PEN' }"
                                />
                    </x-splade-defer>

                    {{-- <InputMask mask="#-#" v-model="form.mask" label="Test"/> --}}

                    <CurrencyInput
                       label="Costo"
                        v-model="form.cost"
                        :options="{ currency: 'PEN' }"
                      />
                      <div class="flex flex-col justify-center pt-5">

                          <x-splade-checkbox name="add_stock" label="¿Desea agrega stock de este producto?" />
                      </div>
                    </div>
                    <div class="px-2 py-1 mb-2 mb-5 border-b-2 border-gray-300"></div>
                    <div v-if="form.add_stock">
                        <div class="mb-2" v-for="(store,index) in form.stores">
                            <div class="flex items-center justify-between p-1 px-2 border border-gray-400 rounded-md shadow-inner bg-slate-100">
                                <div class="font-medium text-MD" v-text="`${store.code} ${store.name}`"></div>
                                <div v-if="store.is_principal" class="text-xl text-center text-green-600"><i class="fi fi-br-badge-check"></i></div>
                            </div>
                            <div class="p-2">
                                <div class="grid gap-4 lg:grid-cols-2">
                                    <label class="block">
                                        <span class="block mb-1 font-sans text-sm font-medium text-gray-700">Cantidad</span>
                                        <div class="flex border border-gray-300 rounded-md shadow-sm">
                                            <span class="inline-flex items-center px-3 text-gray-500 border border-t-0 border-b-0 border-l-0 border-gray-300 rounded-l-md bg-gray-50"><i class="fi fi-br-hastag"></i></span>
                                             <input
                                                v-model="form.stores[index].quantity"
                                                type="text"
                                                class="block w-full border-0 rounded-md focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed"
                                            />
                                        </div>
                                    </label>
                                    <label class="block">
                                        <span class="block mb-1 font-sans text-sm font-medium text-gray-700">Descripcion de cantidad</span>
                                        <div class="flex border border-gray-300 rounded-md shadow-sm">
                                            <span class="inline-flex items-center px-3 text-gray-500 border border-t-0 border-b-0 border-l-0 border-gray-300 rounded-l-md bg-gray-50"><i class="fi fi-br-box"></i></span>
                                             <input
                                                v-model="form.stores[index].package_quantity"
                                                type="text"
                                                class="block w-full border-0 rounded-md focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 disabled:opacity-50 disabled:bg-gray-50 disabled:cursor-not-allowed"
                                            />
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    <div class="px-2 py-1 mb-2 mb-5 border-b-2 border-gray-300"></div>
                    </div>
                    <x-splade-flash>
                        <div v-if="flash.has('status')" v-text="flash.status"/>
                    </x-splade-flash>
                    <div class="flex justify-end">
                        <x-splade-submit class="button-primary" v-if="!form.processing">
                           <span class="mr-2">Guardar</span> <i class="leading-7 fi fi-br-disk"></i>
                       </x-splade-submit>
                       <img src="{{ asset('images/commons/loading.svg') }}" v-else/>
                    </div>
                    {{-- <pre v-text="form.$all" /> --}}
                </x-splade-form>
            </div>
        </div>
    </div>
</x-app-layout>
