<x-splade-modal max-width="sm">
    <div class="py-2 mt-3">
        <p class="font-medium text-center">Editar datos del proveedor</p>
        <div class="px-2 py-1 mb-2  border-b-2 border-gray-300"></div>
        <x-splade-form action="{{ route('pv.update', [$supplier]) }}" method="PATCH" :default="$supplier">
            <x-splade-input name="ruc" label="RUC" icon="ad" class="mb-2" disabled/>
            <x-splade-input name="name" label="Razon Social" icon="building" class="mb-2"/>
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
