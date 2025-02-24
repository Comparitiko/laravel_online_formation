<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            Borrar cuenta
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Una vez que tu cuenta haya sido eliminada todos tus datos van a ser eliminados permanentemente
        </p>
    </header>

    <x-danger-button
        type="submit"
        onclick="document.querySelector('#modal').classList.toggle('hidden')"
    >
        Borrar cuenta
    </x-danger-button>

    <div id="modal" class="hidden">
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                ¿Estas seguro de querer eliminar tu cuenta?
            </h2>

            <div class="mt-6">
                <x-input-label for="password" value="Contraseña" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="Contraseña"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button
                    class="border-2 shadow-lg hover:underline"
                    onclick="document.querySelector('#modal').classList.add('hidden')"
                >
                    Cancelar
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    Borrar cuenta
                </x-danger-button>
            </div>
        </form>
    </div>
</section>
