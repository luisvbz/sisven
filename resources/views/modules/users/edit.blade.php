@extends('modules.users.base')

@section('header')
    Usuarios / <small>Editar Usuario</small>
@endsection

@section('content')
<div class="py-0">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-lg sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-splade-form method="PUT" action="{{ route('us.update', [$user]) }}" :default="$user">
                        <p class="text-sm font-medium text-gray-600"><i class="fi-br-form"></i> Complete los datos del formulario para actualizar los datos del usuario</p>
                        <div class="px-2 py-2 mb-2 border-b-2 border-gray-300"></div>
                        <div class="grid grid-cols-2 gap-4 pb-2">
                            <x-splade-input name="dni" label="Numero de DNI" icon="id-badge"/>
                            <x-splade-input name="name" label="Nombre Completo" icon="user"/>
                            <x-splade-input name="username" label="Nombre de usuario" icon="user"/>
                            <x-splade-input name="email" label="Correo Electrónico" icon="at"/>
                            {{--
                             <x-splade-input name="password" type="password" label="Contraseña" icon="key"/>
                            <x-splade-input name="password_confirmation" type="password" label="Confirmación de contraseña" icon="key"/>
                            --}}
                            <x-splade-select name="rol" label="Rol"
                            placeholder="Seleccion el rol del usuario"
                            :options="$roles"
                             option-label="display_name" option-value="name" />
                              <x-splade-select name="stores[]" label="¿Qué tiendas puede ver?"
                             v-if="form.rol == 'vendedor'"
                            placeholder="Seleccion las tiendas"
                            :options="$stores" choices multiple
                             option-label="name" option-value="id" />
                        </div>
                         <div class="px-2 py-2 mb-2 border-b-2 border-gray-300"></div>
                         <p class="text-sm font-medium text-gray-600"><i class="fi-br-form"></i> Seleccione los permisos para este usuario</p>
                         <div class="px-2 py-1 mb-2 mb-5 border-b-2 border-gray-300"></div>
                         @foreach ($modules as $module)
                            <div class="mb-2">
                                <div class="p-1 px-2 border border-gray-400 rounded-md shadow-inner bg-slate-100">
                                    {{ $module->name }}
                                </div>
                                <div class="p-2">
                                    <x-splade-group name="permissions">
                                        @foreach ($module->permissions as $permission)
                                            <x-splade-checkbox name="permissions[]"  :value="$permission->name" :label="$permission->display_name" />
                                        @endforeach
                                    </x-splade-group>
                                </div>
                            </div>
                         @endforeach
                         <div class="flex justify-end">
                             <x-splade-submit class="button-primary" v-if="!form.processing">
                                <span class="mr-2">Actualizar</span> <i class="leading-7 fi fi-br-disk"></i>
                            </x-splade-submit>
                            <img src="{{ asset('images/commons/loading.svg') }}" v-else/>
                         </div>
                    </x-splade-form>
                </div>
            </div>
        </div>
    </div>
@endsection
