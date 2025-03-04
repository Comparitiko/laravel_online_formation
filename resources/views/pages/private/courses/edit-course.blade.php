<x-layouts.private title="Editar curso {{$course->name}}">
    <main class="flex items-center justify-center">
        <x-form
            title="Editar el curso {{$course->name}}"
            :action="route('private.courses.edit', ['course' => $course])"
        >
            <x-errors />
            <div class="mb-6 relative">
                <x-input-label for="name">Nombre</x-input-label>
                <x-text-input
                    type="text"
                    name="name"
                    id="name"
                    :value=" old('name', $course->name)"
                    placeholder="Nombre"
                    autocomplete="name"
                    required
                />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mb-6 relative">
                <x-input-label for="description">Descripción</x-input-label>
                <x-textarea
                    name="description"
                    id="description"
                    placeholder="Descripción del curso"
                    autocomplete="description"
                    required
                >
                    {{ old('description', $course->description) }}
                </x-textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div class="mb-6 relative">
                <x-input-label for="duration">Duracion</x-input-label>
                <x-text-input
                    type="number"
                    name="duration"
                    id="duration"
                    :value=" old('duration', $course->duration) "
                    placeholder="Duración en horas"
                    min="1"
                    autocomplete="duration"
                    required
                />
                <x-input-error :messages="$errors->get('duration')" class="mt-2" />
            </div>

            <div class="mb-6 relative">
                <x-input-label for="teacher_id">Profesor</x-input-label>
                <x-select
                    name="teacher_id"
                    id="teacher_id"
                    type="hidden"
                    required
                >
                    @foreach($teachers as $teacher)
                        <x-option
                            :value="$teacher->id"
                            :selected_option="old('teacher_id', $course->teacher_id)"
                        >
                            {{ $teacher->name }}
                        </x-option>
                    @endforeach
                </x-select>
                <x-input-error :messages="$errors->get('teacher_id')" class="mt-2" />
            </div>

            <div class="mb-6 relative">
                <x-input-label for="category_id">Categoría</x-input-label>
                <x-select
                    name="category_id"
                    id="category_id"
                    required
                >
                    @foreach($categories as $category)
                        <x-option
                            :value="$category->id"
                            :selected_option="old('category_id', $course->category_id)"
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
                    Editar curso
                </x-buttons.primary-button>
            </div>
        </x-form>
    </main>
</x-layouts.private>
