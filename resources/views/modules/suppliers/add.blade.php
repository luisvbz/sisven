<x-splade-modal max-width="sm">
    <div class="py-2 mt-3">
        <p class="font-medium text-center">Complete los datos para agregar una nuevo proveedor</p>
        <div class="px-2 py-1 mb-2 mb-5 border-b-2 border-gray-300"></div>
        <x-splade-form action="{{ route('pv.store') }}">
            <x-splade-input name="ruc" label="RUC" icon="ad" class="mb-2"/>
            <x-splade-defer
                        url="/commons/get-bussiness"
                        method="POST"
                        watch-value="form.ruc"
                         request="{ ruc: form.ruc}"
                        watch-debounce="1000"
                        manual
                        @success="(response) => form.name = response.name">
                <div>
                    <x-splade-input v-bind:disabled="processing" name="name" label="Razon Social" icon="building" class="mb-2"/>
                    <span v-if="processing" class="text-xs text-primary-500">Buscando datos de este RUC...</span>
                </div>
            </x-splade-defer>
            <x-splade-textarea name="address" label="Dirección" autosize />
            <x-splade-input name="phone_number" label="Teléfono" icon="phone-office" class="mb-2"/>
            <div class="px-2 py-1 mb-2 border-b-2 border-gray-300"></div>
            <div class="w-full">
                <x-splade-submit class="button-primary !w-full" v-if="!form.processing">
                    <span class="mr-2">Guardar</span> <i class="leading-7 fi fi-br-disk"></i>
                </x-splade-submit>
                <img src="{{ asset('images/commons/loading.svg') }}" v-else/>
            </div>
        </x-splade-form>
    </div>
</x-splade-modal>
