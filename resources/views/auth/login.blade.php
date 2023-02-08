<x-guest-layout>
    <x-auth-card>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" />

        <x-splade-form action="{{ route('login') }}" class="space-y-4">
            <!-- Email Address -->
            <x-splade-input id="username" type="text" name="username" label="Usuario" icon="user" required autofocus />
            <x-splade-input id="password" type="password" name="password" label="Contraseña" icon="key" required autocomplete="current-password" />
            <x-splade-checkbox id="remember_me" name="remember" label="Recordar datos" />

            <x-splade-errors>
                <div class="p-1 px-2 text-xs font-bold text-white bg-red-500 border rounded-lg text-centered" v-if="errors.has('credentials')" v-text="errors.first('credentials')" />
            </x-splade-errors>

            <div class="flex items-center justify-end">
                @if (Route::has('password.request'))
                    <Link class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('password.request') }}">
                        Olvide mi contraseña
                    </Link>
                @endif

                <x-splade-submit class="button-gradient">
                    <span class="mr-2">Entrar</span> <i class="leading-4 fi fi-br-sign-in-alt"></i>
                </x-splade-submit>
            </div>
        </x-splade-form>
    </x-auth-card>
</x-guest-layout>
