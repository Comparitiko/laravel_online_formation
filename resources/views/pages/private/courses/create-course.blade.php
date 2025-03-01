<x-layouts.private title="Crear nuevo curso">
    <main class="bg-slate-800 min-h-screen flex items-center justify-center p-4">
        <x-form title="Crear nuevo curso" :action="route('private.courses.create')">
            <div class="mb-6 relative">
                <x-text-input
                    type="text"
                    name="name"
                    :value=" old('name') "
                    placeholder="Nombre"
                    autofocus
                    autocomplete="name"
                    required
                />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mb-6 relative">
                <x-textarea
                    name="description"
                    placeholder="Descripción del curso"
                    autocomplete="description"
                    required
                >
                    {{ old('description') }}
                </x-textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mb-6 relative">
                <x-text-input
                    type="number"
                    name="duration"
                    :value=" old('duration') "
                    placeholder="Duración en horas"
                    min="1"
                    autocomplete="duration"
                    required
                />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mb-6 relative">
                <x-select
                    name="teacher_id"
                    placeholder="Duración en horas"
                    required
                >

                </x-select>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

        </x-form>
    </main>
</x-layouts.private>
