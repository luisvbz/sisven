<x-app-layout>
    <x-slot name="header">
        <x-back-button-title route="/usuarios" module="Usuarios" page="Agregar" />
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-splade-form>
                        <p class="text-sm font-medium text-gray-600"><i class="fi-br-form"></i> Complete los datos del formulario para crear un nuevo usuario</p>
                        <div class="px-2 py-2 mb-2 border-b-2 border-gray-300"></div>
                        <x-splade-input name="name" label="Nombre Completo" icon="user" class="mb-4"/>
                        <x-splade-input name="email" label="Correo Electrónico" icon="at" class="mb-4"/>
                        <x-splade-input name="password" label="Contraseña" icon="key" class="mb-4"/>
                        <x-splade-input name="password_confirmation" label="Confirmación de contraseña" icon="key" class="mb-4"/>
                        <x-splade-select name="rol" label="Rol"
                        placeholder="Seleccion el rol del usuario"
                        :options="$roles"
                         option-label="display_name" option-value="name" />
                         <div class="px-2 py-2 mb-2 border-b-2 border-gray-300"></div>
                         <div class="flex justify-end">
                             <x-splade-submit class="button-indigo">
                                <span class="mr-2">Guardar</span> <i class="leading-7 fi fi-br-disk"></i>
                            </x-splade-submit>
                         </div>
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
