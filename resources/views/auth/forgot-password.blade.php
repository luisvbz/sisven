<x-guest-layout>
    <x-auth-card>
        <div class="mb-4 text-sm text-gray-600">
            Ingresa tu correo electrónico para crear una nueva contraseña
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" />

        <x-splade-form action="{{ route('password.email') }}" class="space-y-4">
            <x-splade-input id="email" class="block mt-1 w-full" type="email" name="email" label="Correo electrónico" required autofocus />

            <div class="flex items-center justify-end">
                <x-splade-submit label="Enviar link de Recuperacion" />
            </div>
        </x-splade-form>
    </x-auth-card>
</x-guest-layout>
