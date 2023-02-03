{{-- Modal de Creacion --}}
<x-splade-modal>
    <h1>Create new user</h1>

    <x-splade-form>
        <x-splade-input id="name" name="name" type="text" label="Nombre Completo"/>
        <x-splade-input class="mt-2" name="email"  label="Correo electronico"/>
        <x-splade-select class="mt-2" name="rol" label="Rol"
        :options="$roles"
        placeholder="Seleccione el rol"
        option-label="display_name" option-value="name"/>
        <hr>
        <x-splade-submit class="mt-5" />
    </x-splade-form>
</x-splade-modal>
{{-- Modal de Creación--}}
