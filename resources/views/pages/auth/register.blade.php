<x-layouts.guest title="Formación registro">
    <main class="bg-slate-800 min-h-screen flex items-center justify-center p-4">
        <section class="form-container bg-slate-700 rounded-xl shadow-lg overflow-hidden w-full max-w-md">
            <!-- Formulario de Registro -->
            <div class="w-full md:w-1/2 p-8">
                <h2 class="text-3xl font-bold text-white mb-6">Registrarse</h2>
                <form>
                    @csrf
                    <div class="mb-6 relative">
                        <input class="w-full pl-10 pr-3 py-2 rounded-lg bg-slate-500 text-white border-2 border-slate-400 outline-none focus:border-pink-400" type="text" placeholder="Nombre Completo" required>
                    </div>
                    <div class="mb-6 relative">
                        <input class="w-full pl-10 pr-3 py-2 rounded-lg bg-slate-500 text-white border-2 border-slate-400 outline-none focus:border-pink-400" type="email" placeholder="Correo Electrónico" required>
                    </div>
                    <div class="mb-6 relative">
                        <input class="w-full pl-10 pr-3 py-2 rounded-lg bg-slate-500 text-white border-2 border-slate-400 outline-none focus:border-pink-400" type="password" placeholder="Contraseña" required>
                    </div>
                    <button class="w-full bg-pink-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-pink-500 transition duration-300" type="submit">
                        Crear Cuenta
                    </button>
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
