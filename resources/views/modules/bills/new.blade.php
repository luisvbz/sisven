@extends('modules.bills.base')

@section('header')
     Agregar Documento Electrónico
@endsection

@section('content')
    <div class="py-0">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <x-splade-form
            action="{{ route('de.store')}}"
            confirm="Guardar Documento electrónico"
            confirm-text="Estas seguro de registrar este documento electronico?"
            confirm-button="Si, Guardar!"
            cancel-button="Cancelar!"
             :default="[
                    'client_id' => null,
                    'products' => [],
                    'total' => 0,
                    'total_igv' => 0,
                    'total_gravada' => 0,
                    'document_type' => 'FACT'
                    ]">
                    <new-bill :form="form">
                        <template v-slot:extend>
                            <x-splade-input icon="calendar" name="emition_date" label="Fecha de Emisión" date />
                            <div class="py-2">
                                <x-splade-file class="w-full" label="Adjuntar documento Electrónico" name="file">
                                    <i class="fi fi-br-file"></i> Seleccionar archivo
                                </x-splade-file>
                            </div>
                            <x-splade-select name="document_type" label="Tipo de Docuemnto" :options="$docs" />
                            <div class="flex space-x-2">
                                <div class="w-2/6">
                                    <x-splade-input name="serie" label="Serie" placeholder="ej: BO"/>
                                </div>
                                <div>
                                    <x-splade-input name="number" label="Número" placeholder="ej: 1234"/>
                                </div>
                            </div>
                            <CurrencyInput
                                    label="Total Inafecta"
                                    v-model="form.total_inafecta"
                                    :icon="false"
                                    :options="{ currency: 'PEN' }"
                                    />
                        </template>
                        <template v-slot:errors>
                            <x-splade-errors>
                                <div v-for="(errors, key) in errors.all" :key="'error'+key">
                                    <pre v-text="error"></pre>
                                </div>
                            </x-splade-errors>
                        </template>
                    </new-bill>
                     <pre class="p-4 mt-4 bg-white border border-gray-300 rounded" v-text="form.$all"/>
            </x-splade-form>
        </div>
    </div>
@endsection
