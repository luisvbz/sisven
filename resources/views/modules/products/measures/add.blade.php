<x-splade-modal max-width="md">
    <div class="py-3 mb-4 text-center border-b border-primary-300 font-semibold">
        Agreagar nueva unidad de medida
    </div>
    <x-splade-form
    @success="$splade.emit('product-measures-added-or-updated')"
    stay
    method="POST" action="{{ route('pr.store-measure') }}">
         <x-splade-input name="name" label="Nombre" icon="info" class="mb-2"/>
         <x-splade-input name="alias" label="Abreviatura" icon="info" class="mb-2"/>
    <div class="py-3 mb-4 text-center border-b border-primary-300 font-semibold">
    </div>
     <div class="w-full">
        <x-splade-submit class="button-primary !w-full" v-if="!form.processing">
            <span class="mr-2">Guardar</span> <i class="leading-7 fi fi-br-disk"></i>
        </x-splade-submit>
        <img src="{{ asset('images/commons/loading.svg') }}" v-else/>
    </div>
    </x-splade-form>
</x-splade-modal>
