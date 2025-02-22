<x-layouts.guest title="Verificar email">
    <main class="bg-slate-800 min-h-screen flex flex-col items-center justify-center p-4">
        <h1 class="mb-4 text-sm text-white text-xl">
            Gracias por registrarte. Por favor verifica tu correo electrónico para finalizar el proceso.
        </h1>

        @if (session('status') == 'verification-link-sent')
            <h2 class="font-medium text-md text-green-600">
                Un enlace de verificación nuevo ha sido enviado a tu correo electrónico.
            </h2>
        @endif

        <div class="mt-4 flex items-center justify-between gap-6">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-primary-button>
                        Reenviar verificación de correo electrónico
                    </x-primary-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-secondary-button
                    type="submit"
                    class="hover:underline"
                >
                    Cerrar sesión
                </x-secondary-button>
            </form>
        </div>
    </main>
</x-layouts.guest>
