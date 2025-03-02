<x-layouts.guest title="Editar perfil">
    <main class="bg-slate-800 min-h-screen flex flex-col items-center justify-center p-6">
        <div class="flex items-center gap-10">
            <h1 class="text-4xl text-white font-bold">Edición del perfil</h1>
            <a class="btn-primary" href="{{ route('index') }}">Inicio</a>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-slate-700 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-partials.update-profile-information-form :user="$user" />
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-slate-700 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-partials.update-password-form />
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-slate-700 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-partials.generate-token-form :tokens="$tokens" />
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-slate-700 shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <x-partials.delete-user-form />
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layouts.guest>
