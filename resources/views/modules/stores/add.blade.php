<x-splade-modal>
    <div class="py-2 mt-3">
        <p class="text-center font-medium">Complete los datos para agregar una nueva tienda</p>
        <div class="px-2 py-1 mb-2 mb-5 border-b-2 border-gray-300"></div>
        <x-splade-form action="{{ route('ti.store') }}">
            <x-splade-input name="code" label="Código de la tienda" icon="ad" class="mb-2"/>
            <x-splade-input name="name" label="Nombre de la tienda" icon="city" class="mb-2"/>
            <x-splade-select name="departament_id" label="Departamento"
                            placeholder="Seleccione el departamento"
                            :options="$departaments"
                             option-label="name"
                             option-value="id"
                             choices class="mb-2"
                             />
            <x-splade-select
                label="Provincia"
                name="province_id"
                placeholder="Seleccione la provincia"
                option-label="name"
                option-value="id"
                choices class="mb-2"
                remote-url="`/commons/provinces/${form.departament_id}`"
                />
                <x-splade-select
                label="Distrito"
                name="district_id"
                placeholder="Seleccione el distrito"
                option-label="name"
                option-value="id"
                choices class="mb-2"
                remote-url="`/commons/districts/${form.province_id}`"
                />
                <x-splade-textarea name="address" label="Dirección de la tienda" autosize />
                <x-splade-input name="phone_number" label="Teléfono" icon="phone-office" class="mb-2"/>
                <div class="px-2 py-1 mb-2 mb-5 border-b-2 border-gray-300"></div>
                <div class="w-full">
                    <x-splade-submit class="button-primary !w-full" v-if="!form.processing">
                        <span class="mr-2">Guardar</span> <i class="leading-7 fi fi-br-disk"></i>
                    </x-splade-submit>
                    <img src="{{ asset('images/commons/loading.svg') }}" v-else/>
                </div>
        </x-splade-form>
    </div>
</x-splade-modal>
