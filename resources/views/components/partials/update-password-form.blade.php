<section>
    <header>
        <h2 class="text-lg font-medium text-white">
            Actualizar contraseña
        </h2>

        <p class="mt-1 text-sm text-gray-300">
            Asegurate que tu cuenta este usando una contraseña larga, y con varios tipos de de caracteres para estar mas  seguro.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" value="Contraseña actual" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" value="Nueva contraseña" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" value="Confirmar contraseña" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-buttons.primary-button type="submit">Guardar</x-buttons.primary-button>

            @if (session('status') === 'password-updated')
                <p
                    class="text-sm text-gray-600"
                >Guardado correctamente</p>
            @endif
        </div>
    </form>
</section>
