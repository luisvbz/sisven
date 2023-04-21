<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Cambiar clave
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Cambiar contraseña
        </p>
    </header>

    <x-splade-form method="put" :action="route('password.update')" class="mt-6 space-y-6">
        <x-splade-input id="current_password" name="current_password" type="password" label="Contraseña actual" autocomplete="current-password" />
        <x-splade-input id="password" name="password" type="password" label="Nueva contraseña" autocomplete="new-password" />
        <x-splade-input id="password_confirmation" name="password_confirmation" type="password" label="Repita la nueva contraseña" autocomplete="new-password" />

        <div class="flex items-center gap-4">
            <x-splade-submit label="Guardar" />

            @if (session('status') === 'password-updated')
                <p class="text-sm text-gray-600">Guardado</p>
            @endif
        </div>
    </x-splade-form>
</section>
