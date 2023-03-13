<x-splade-modal>
    <div class="py-2 mt-3">
        <p class="font-medium text-center">Complete los datos para agregar un nuevo cliente</p>
        <div class="px-2 py-1 mb-2 mb-5 border-b-2 border-gray-300"></div>
        <x-splade-form default="{document_type: 'dni'}"
         @success="$splade.emit('client-saved')"
        stay restore-on-success action="{{ route('cl.store') }}">
            <div class="flex mb-2 space-x-2">
                <x-splade-select name="document_type" label="T.Doc"
                            placeholder=""
                            :options="$types"
                             option-label="name"
                             option-value="id"
                             />
                <x-splade-input name="document_number" label="N.Documento" icon="ad" class="mb-2"/>
            </div>
                <x-splade-input name="name" label="Nombre o Razon Social" icon="ad" class="mb-2"/>
                <x-splade-input name="phone_office" label="Teléofno Fijo (opcional)" icon="phone-office" class="mb-2"/>
                <x-splade-input name="phone_celular" label="Teléofno Celular (opcional)" icon="phone-office" class="mb-2"/>
                <x-splade-input name="email" label="Email (opcional)" icon="at" class="mb-2"/>
                <x-splade-textarea name="address" label="Dirección (opcional)" autosize />
                <div class="px-2 py-1 mb-2  border-b-2 border-gray-300"></div>
                <div class="w-full">
                    <x-splade-submit class="button-primary !w-full" v-if="!form.processing">
                        <span class="mr-2">Guardar</span> <i class="leading-7 fi fi-br-disk"></i>
                    </x-splade-submit>
                    <img src="{{ asset('images/commons/loading.svg') }}" v-else/>
                </div>
        </x-splade-form>
    </div>
</x-splade-modal>
