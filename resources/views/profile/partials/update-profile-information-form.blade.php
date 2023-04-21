<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Información de Usuario
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Editar Nombre y Correo electrónico
        </p>
    </header>

    <x-splade-form method="patch" :action="route('profile.update')" :default="$user" class="mt-6 space-y-6">
        <x-splade-input id="name" name="name" type="text" label="Nombre" required autofocus autocomplete="name" />
        <x-splade-input id="email" name="email" type="email" label="Correo" required autocomplete="email" />

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div>
                <p class="mt-2 text-sm text-gray-800">
                    {{ __('Your email address is unverified.') }}

                    <Link method="post" href="{{ route('verification.send') }}" class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        {{ __('Click here to re-send the verification email.') }}
                    </Link>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-sm font-medium text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            </div>
        @endif

        <div class="flex items-center gap-4">
            <x-splade-submit label="Acutalizar" />

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-gray-600">
                    Datos guardados con exito
                </p>
            @endif
        </div>
    </x-splade-form>
</section>
