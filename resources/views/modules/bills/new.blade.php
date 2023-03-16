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
                    'total' => 0,
                    'document_type' => 'FACT'
                    ]">
                    <new-bill :form="form">
                        <template v-slot:extend>
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
                                    label="Total Gravada"
                                    v-model="form.total_gravada"
                                    :icon="false"
                                    :options="{ currency: 'PEN' }"
                                    />
                            <CurrencyInput
                                    label="Total Inafecta"
                                    v-model="form.total_inafecta"
                                    :icon="false"
                                    :options="{ currency: 'PEN' }"
                                    />
                            <CurrencyInput
                                    label="Total IGV(18%)"
                                    v-model="form.total_igv"
                                    :icon="false"
                                    :options="{ currency: 'PEN' }"
                                    />
                        </template>
                    </new-bill>
                     {{-- <pre class="p-4 mt-4 bg-white border border-gray-300 rounded" v-text="form.$all"/> --}}
            </x-splade-form>
        </div>
    </div>
@endsection
