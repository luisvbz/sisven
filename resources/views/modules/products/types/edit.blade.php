<x-splade-modal max-width="md">
    <div class="py-3 mb-4 text-center border-b border-primary-300 font-semibold">
        Editar tipo de producto
    </div>
    <x-splade-form
    stay
    @success="$splade.emit('product-type-added-or-updated')"
    confirm="Actualizar tipo de producto"
    confirm-text="Esta seguro(a) que desea actualizar este producto?.Esto puede afetar todo el sistema."
    confirm-button="Si, actualizar!"
    cancel-button="Cancelar!"
     method="PATCH" action="{{ route('pr.update-type', [$type]) }}" :default="$type">
         <x-splade-input name="name" label="Nombre" icon="info" class="mb-2"/>
        <x-splade-select name="package_id" label="Presentación"
            placeholder="Selecciona el tipo de paquete"
            :options="$packages"
                option-label="name"
                choices
                option-value="id" />
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
