<x-layouts.guest title="Formación inicio sesión">
    <main class="bg-slate-800 min-h-screen flex items-center justify-center p-4">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Login form -->
        <section class="form-container bg-slate-700 rounded-xl shadow-lg overflow-hidden w-full max-w-md">
            <div class="p-8">
                <h2 class="text-3xl font-bold text-white mb-6">Iniciar Sesión</h2>
                <form action="{{route('login')}}" method="POST">
                    @csrf
                    <div class="mb-6 relative">
                        <x-text-input
                            type="email"
                            name="email"
                            :value="old('email')"
                            placeholder="Correo electrónico"
                            autofocus
                            autocomplete="username"
                            required
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="mb-6 relative">
                        <x-text-input
                            type="password"
                            name="password"
                            placeholder="Contraseña"
                            autocomplete="current-password"
                            required
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <!-- Remember me -->
                    <div class="block my-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-200 text-indigo-600
                            shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-white">Recuerdame</span>
                        </label>
                    </div>
                    <div class="my-4">
                        <small class="text-white">
                            No tienes una cuenta todavía:
                            <a
                                class="font-bold hover:text-gray-300 hover:underline"
                                href="{{ route('register') }}">
                                Registrate
                            </a>
                        </small>
                    </div>
                    <div class="flex items-center justify-around mt-4">
                        @if (Route::has('password.request'))
                            <a class="text-sm text-white hover:text-gray-300 hover:underline rounded-md focus:outline-none
                            focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                ¿Has olvidado tu contraseña?
                            </a>
                        @endif
                        <x-primary-button type="submit" class="w-1/2">Iniciar sesión</x-primary-button>
                    </div>
                </form>
            </div>
        </section>
    </main>
</x-layouts.guest>
