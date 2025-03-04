@props([
    'category' => '',
    'duration' => 1,
    'course_name' => ''
])

<x-layouts.web title="Cursos">
    <main class="max-w-6xl mx-auto">
        <div class="m-4">
            <h1 class="text-xl font-bold my-4">Buscar curso</h1>
            <form
                action="{{ route('students.courses.search') }}"
                method="GET"
                class="flex items-center gap-10 mb-6"
            >
                <div>
                    <x-input-label for="category">Categoría</x-input-label>
                    <x-text-input
                        type="text"
                        name="category"
                        id="category"
                        :value="old('category', $category)"
                        placeholder="Categoría"
                        autocomplete="category"
                    />
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="duration">Duración</x-input-label>
                    <x-text-input
                        type="number"
                        name="duration"
                        step="1"
                        min="1"
                        id="duration"
                        :value="old('duration', $duration)"
                        placeholder="Duración"
                        autocomplete="duration"
                    />
                    <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="course_name">Nombre curso</x-input-label>
                    <x-text-input
                        type="number"
                        name="course_name"
                        id="course_name"
                        :value="old('$course_name', $course_name)"
                        placeholder="Nombre del curso"
                        autocomplete="course_name"
                    />
                    <x-input-error :messages="$errors->get('course_name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-buttons.primary-button
                        type="submit"
                    >
                        Buscar
                    </x-buttons.primary-button>
                </div>
            </form>
        </div>
        <section class="my-4">
            Cursos
        </section>
        <x-courses-paginator
            :courses="$courses"
            :category="$category"
            :duration="$duration"
            :course_name="$course_name"
        />
    </main>
</x-layouts.web>
