<x-app-layout>
    <x-slot name="header">
        <x-back-button-title route="/usuarios" module="Usuarios" page="Agregar" />
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-lg sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-splade-form action="{{ route('us.store') }}">
                        <p class="text-sm font-medium text-gray-600"><i class="fi-br-form"></i> Complete los datos del formulario para crear un nuevo usuario</p>
                        <div class="px-2 py-2 mb-2 border-b-2 border-gray-300"></div>
                        <div class="grid gap-4 pb-2 lg:grid-cols-2">
                            <x-splade-input name="dni" label="Numero de DNI" icon="id-badge"/>
                            <x-splade-input name="name" label="Nombre Completo" icon="user"/>
                            <x-splade-input name="username" label="Nombre de usuario" icon="user"/>
                            <x-splade-input name="email" label="Correo Electrónico" icon="at"/>
                            <x-splade-input name="password" type="password" label="Contraseña" icon="key"/>
                            <x-splade-input name="password_confirmation" type="password" label="Confirmación de contraseña" icon="key"/>
                            <x-splade-select name="rol" label="Rol"
                            placeholder="Seleccion el rol del usuario"
                            :options="$roles"
                             option-label="display_name" option-value="name" />
                        </div>
                         <div class="px-2 py-2 mb-2 border-b-2 border-gray-300"></div>
                         <p class="text-sm font-medium text-gray-600"><i class="fi-br-form"></i> Seleccione los permisos para este usuario</p>
                         <div class="px-2 py-1 mb-2 mb-5 border-b-2 border-gray-300"></div>
                         <x-splade-errors>
                            <p v-if="errors.has('permissions')" class="p-1 px-2 mb-2 text-xs font-bold text-white border rounded-lg bg-danger-500 text-centered" v-text="errors.first('permissions')"></p>
                         </x-splade-errors>
                         @foreach ($modules as $module)
                         <x-splade-toggle>
                            <div class="mb-2">
                                <div class="flex items-center justify-between p-1 px-2 border border-gray-400 rounded-md shadow-inner bg-slate-100">
                                    <div class="text-sm font-medium">{{ $module->name }}</div>
                                    <div><a class="cursos-pointer text-primary-600 hover:text-primary-500" @click.prevent="toggle"><i :class="toggled ? 'fi fi-br-chevron-double-up': 'fi fi-br-chevron-double-down'"></i></a></div>
                                </div>
                                <div class="p-2" v-show="toggled">
                                    <x-splade-group name="permissions" :show-errors="false">
                                        @foreach ($module->permissions as $permission)
                                            <x-splade-checkbox name="permissions[]" :show-errors="false" :value="$permission->name" :label="$permission->display_name" />
                                        @endforeach
                                    </x-splade-group>
                                </div>
                            </div>
                         </x-splade-toggle>
                         @endforeach
                         <div class="px-2 py-1 mb-2 mb-5 border-b-2 border-gray-300"></div>
                         <div class="flex justify-end">
                             <x-splade-submit class="button-primary" v-if="!form.processing">
                                <span class="mr-2">Guardar</span> <i class="leading-7 fi fi-br-disk"></i>
                            </x-splade-submit>
                            <img src="{{ asset('images/commons/loading.svg') }}" v-else/>
                         </div>
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
