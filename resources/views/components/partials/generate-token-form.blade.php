@props(['tokens'])

<section>
    <header>
        <h2 class="text-lg font-medium text-white">
            API tokens
        </h2>
    </header>

    <form method="POST" action="{{ route('profile.generate-token') }}" class="mt-6 space-y-6">
        @csrf
        <div>
            <x-input-label for="token_name" value="Nombre" />
            <x-text-input
                id="token_name"
                name="token_name"
                type="text"
                class="mt-1 block w-full"
                :value="old('token_name')"
                required autofocus autocomplete="token_name" />
            <x-input-error class="mt-2" :messages="$errors->get('token_name')" />
        </div>

        <div class="flex items-center gap-4">
            <x-buttons.primary-button type="submit">Crear token</x-buttons.primary-button>
        </div>

        @if(count($tokens) !== 0)
            <section>
                @foreach($tokens as $token)
                    <p class="text-white"><span class="capitalize">{{ $token->name }}</span>: <small class="text-gray-300">{{ $token->token
                    }}</small></p>
                @endforeach
            </section>
        @else
            <p>No tienes ningun API token, genera uno</p>
        @endif
    </form>
</section>
