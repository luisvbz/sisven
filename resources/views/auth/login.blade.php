<x-guest-layout>
    <x-auth-card>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" />

        <x-splade-form action="{{ route('login') }}" class="space-y-4">
            <!-- Email Address -->
            <x-splade-input id="email" type="email" name="email" label="Correo Eletrónico" required autofocus />
            <x-splade-input id="password" type="password" name="password" label="Contraseña" required autocomplete="current-password" />
            <x-splade-checkbox id="remember_me" name="remember" :label="__('Remember me')" />

            <div class="flex items-center justify-end">
                @if (Route::has('password.request'))
                    <Link class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </Link>
                @endif

                <x-splade-submit class="button-gradient">
                    <span class="mr-2">Entrar</span> <i class="leading-4 fi fi-br-sign-in-alt"></i>
                </x-splade-submit>
            </div>
        </x-splade-form>
    </x-auth-card>
</x-guest-layout>
