@php
    use \App\Enums\MaterialType
@endphp

<x-layouts.private title="Añadir material en {{ $course->name }}">
    <main class="bg-slate-800 h-screen flex items-center justify-center p-4">
        <x-form
            title="Añadir material para {{ $course->name }}"
            :action="route('private.courses.add-material', ['course' => $course])"
        >
            <div class="mb-6 relative">
                <x-text-input
                    type="file"
                    name="file"
                    :value="old('file')"
                    required
                />
                <x-input-error :messages="$errors->get('file')" class="mt-2" />
            </div>

            <div class="mb-6 relative">
                <x-select
                    name="type"
                    required
                >
                    <x-option
                        :value="null"
                        :selected_option="old('type')"
                    >
                        Selecciona el tipo del material
                    </x-option>
                    @foreach(MaterialType::cases() as $materialType)
                        <x-option
                            :value="$materialType->name"
                            :selected_option="old('type')"
                        >
                            {{ $materialType->value }}
                        </x-option>
                    @endforeach
                </x-select>
                <x-input-error :messages="$errors->get('type')" class="mt-2" />
            </div>

            <div class="flex items-center justify-around mt-4">
                <x-buttons.primary-button
                    type="submit"
                    class="w-1/2"
                >
                    Añadir material
                </x-buttons.primary-button>
            </div>
        </x-form>
    </main>
</x-layouts.private>
