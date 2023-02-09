<x-app-layout>
    <x-slot name="header">
        <x-back-button-title route="/productos" module="Productos" page="Agregar" />
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <x-splade-form default="{'price_per_dozen': 0}">
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
                      <CurrencyInput
                       label="Precio por unidad"
                        v-model="form.value"
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
                    </div>
                    <pre v-text="form.$all" />
                </x-splade-form>
            </div>
        </div>
    </div>
</x-app-layout>
