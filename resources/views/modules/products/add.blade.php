<x-app-layout>
    <x-slot name="header">
        <x-back-button-title route="/productos" module="Productos" page="Agregar" />
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white border-b border-gray-200 shadow-lg sm:rounded-lg">
                <x-splade-form  action="{{ route('pr.store') }}">
                    <p class="text-sm font-medium text-gray-600"><i class="fi-br-form"></i> Complete los datos del formulario para agregar un nuevo producto</p>
                    <div class="px-2 py-2 mb-2 border-b-2 border-gray-300"></div>
                    <div class="grid gap-4 pb-2 lg:grid-cols-2">
                      <x-splade-select name="type_id" label="Tipo de Producto"
                             placeholder="Seleccione el tipo de producto"
                             :options="$types"
                             option-label="package_name"
                             choices
                             administrable="{{ route('pr.index-types') }}"
                             option-value="id" />
                       <x-splade-input name="code" label="Codigo" icon="ad"/>
                       <x-splade-input name="description" label="Descripción" icon="info"/>
                       <x-splade-select name="measure_id" label="Unidad de Medida"
                            placeholder="Selecciona la unidad de medida"
                            :options="$measures"
                             option-label="name"
                             choices
                             administrable="{{ route('pr.index-measures') }}"
                             option-value="id" />
                      <x-splade-input name="minimum_stock" label="Stock minimo del producto" icon="hastag"/>
                      <CurrencyInput
                       label="Precio"
                        v-model="form.price"
                        :options="{ currency: 'PEN' }"
                      />
                    {{-- <InputMask mask="#-#" v-model="form.mask" label="Test"/> --}}

                    <CurrencyInput
                       label="Costo"
                        v-model="form.cost"
                        :options="{ currency: 'PEN' }"
                      />
                    </div>
                    <div class="px-2 py-1 mb-2 mb-5 border-b-2 border-gray-300"></div>
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
