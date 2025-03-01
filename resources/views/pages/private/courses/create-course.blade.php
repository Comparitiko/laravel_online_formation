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
                    required
                >
                    <x-option
                        :value="null"
                        :selected_option="old('teacher_id')"
                    >
                        Selecciona un profesor
                    </x-option>
                    @foreach($teachers as $teacher)
                        <x-option
                            :value="$teacher->id"
                            :selected_option="old('teacher_id')"
                        >
                            {{ $teacher->name }}
                        </x-option>
                    @endforeach
                </x-select>
                <x-input-error :messages="$errors->get('teacher_id')" class="mt-2" />
            </div>

            <div class="mb-6 relative">
                <x-select
                    name="category_id"
                    required
                >
                    <x-option
                        :value="null"
                        :selected_option="old('category_id')"
                    >
                        Selecciona una categoría
                    </x-option>
                    @foreach($categories as $category)
                        <x-option
                            :value="$category->id"
                            :selected_option="old('category_id')"
                        >
                            {{ $category->course_area_name }}
                        </x-option>
                    @endforeach
                </x-select>
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>
            <div class="flex items-center justify-around mt-4">
                <x-buttons.primary-button
                    type="submit"
                    class="w-1/2"
                >
                    Crear curso
                </x-buttons.primary-button>
            </div>
        </x-form>
    </main>
</x-layouts.private>
