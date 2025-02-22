<x-layouts.guest title="Formación registro">
    <main class="bg-slate-800 min-h-screen flex items-center justify-center p-4">
        <section class="form-container bg-slate-700 rounded-xl shadow-lg overflow-hidden w-full max-w-md">
            <!-- Formulario de Registro -->
            <div class="p-8">
                <h2 class="text-3xl font-bold text-white mb-6">Registrarse</h2>
                <form>
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="mb-6 relative">
                            <x-text-input
                                type="text"
                                value="{{old('name')}}"
                                name="name"
                                placeholder="Nombre"
                                autofocus
                                required
                            />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mb-6 relative">
                            <x-text-input
                                type="text"
                                name="surnames"
                                value="{{old('surnames')}}"
                                placeholder="Apellidos"
                                required
                            />
                            <x-input-error :messages="$errors->get('surnames')" class="mt-2" />
                        </div>
                        <div class="mb-6 relative">
                            <x-text-input type="text" placeholder="Nombre de usuario" required />
                        </div>
                        <div class="mb-6 relative">
                            <x-text-input type="text" placeholder="DNI" required />
                        </div>
                        <div class="mb-6 relative">
                            <x-text-input type="text" placeholder="Dirección" required />
                        </div>
                        <div class="mb-6 relative">
                            <x-text-input type="tel" placeholder="Número de teléfono" required />
                        </div>
                        <div class="mb-6 relative">
                            <x-text-input type="text" placeholder="Ciudad" required />
                        </div>
                        <div class="mb-6 relative">
                            <x-text-input type="email" placeholder="Email" required />
                        </div>
                        <div class="mb-6 relative">
                            <x-text-input type="password" placeholder="Contraseña" required />
                        </div>
                        <div class="mb-6 relative">
                            <x-text-input type="password" placeholder="Confirmar contraseña" required />
                        </div>
                    </div>
                    <div class="my-4">
                        <small class="text-white">
                            ¿Ya tienes una cuenta?
                            <a
                                class="font-bold hover:text-gray-300 hover:underline"
                                href="{{ route('login') }}">
                                Inicia sesión
                            </a>
                        </small>
                    </div>
                    <div class="flex justify-end">
                        <x-primary-button class="w-1/2" type="submit">Crear cuenta</x-primary-button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</x-layouts.guest>


{{--<x-layouts.guest>--}}
{{--    <form method="POST" action="{{ route('register') }}">--}}
{{--        @csrf--}}

{{--        <!-- Name -->--}}
{{--        <div>--}}
{{--            <x-input-label for="name" :value="__('Name')" />--}}
{{--            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />--}}
{{--            <x-input-error :messages="$errors->get('name')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Email Address -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}

{{--            <x-text-input id="password" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password"--}}
{{--                            required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Confirm Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />--}}

{{--            <x-text-input id="password_confirmation" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password_confirmation" required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">--}}
{{--                {{ __('Already registered?') }}--}}
{{--            </a>--}}

{{--            <x-primary-button class="ms-4">--}}
{{--                {{ __('Register') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-layouts.guest>--}}
