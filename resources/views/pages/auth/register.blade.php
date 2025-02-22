<x-layouts.guest title="Formación registro">
    <main class="bg-slate-800 min-h-screen flex items-center justify-center p-4">
        <section class="form-container bg-slate-700 rounded-xl shadow-lg overflow-hidden w-full max-w-md">
            <!-- Formulario de Registro -->
            <div class="p-8">
                <h2 class="text-3xl font-bold text-white mb-6">Registrarse</h2>
                <form action="{{route('register') }}" method="POST">
                    @csrf
                    <x-errors />
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
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
                            <x-text-input
                                type="text"
                                name="username"
                                value="{{ old('username') }}"
                                placeholder="Nombre de usuario"
                                required
                            />
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>
                        <div class="mb-6 relative">
                            <x-text-input
                                type="text"
                                name="dni"
                                value="{{ old('dni') }}"
                                placeholder="DNI"
                                required
                            />
                            <x-input-error :messages="$errors->get('dni')" class="mt-2" />
                        </div>
                        <div class="mb-6 relative">
                            <x-text-input
                                type="text"
                                name="address"
                                value="{{ old('address') }}"
                                placeholder="Dirección"
                                required
                            />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>
                        <div class="mb-6 relative">
                            <x-text-input
                                type="tel"
                                name="phone_number"
                                value="{{old('phone_number')}}"
                                placeholder="Número de teléfono"
                                maxlength="9"
                                minlength="9"
                                required
                            />
                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                        </div>
                        <div class="mb-6 relative">
                            <x-text-input
                                type="text"
                                name="city"
                                value="{{ old('city') }}"
                                placeholder="Ciudad"
                                required
                            />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
                        <div class="mb-6 relative">
                            <x-text-input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Email"
                                required
                            />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="mb-6 relative">
                            <x-text-input
                                type="password"
                                name="password"
                                placeholder="Contraseña"
                                required
                            />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="mb-6 relative">
                            <x-text-input
                                type="password"
                                name="confirm_password"
                                placeholder="Confirmar contraseña"
                                required
                            />
                            <x-input-error :messages="$errors->get('confirm_password')" class="mt-2" />
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
