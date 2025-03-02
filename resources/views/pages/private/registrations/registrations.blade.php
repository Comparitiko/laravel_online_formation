@props([
    'course_name' => '',
    'state' => '',
    'student_name' => ''
])

<x-layouts.private title="Cursos">
    <main class="max-w-6xl mx-auto">
        <div class="m-4">
            <x-form
                method="GET"
                :action="route('private.registrations.search)"
            >
                <div class="mb-6 relative">
                    <x-text-input
                        type="text"
                        name="course_name"
                        :value=""
                        placeholder="Nombre"
                        autofocus
                        autocomplete="name"
                        required
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
            </x-form>
        </div>
        <div class="relative overflow-auto shadow-xl rounded-xl border-gray-900">
            <x-tables.table>
                <x-tables.thead>
                    <x-tables.thead-th>Nombre</x-tables.thead-th>
                    <x-tables.thead-th>Descripción</x-tables.thead-th>
                    <x-tables.thead-th>Duración</x-tables.thead-th>
                    <x-tables.thead-th>Estado</x-tables.thead-th>
                    <x-tables.thead-th>Categoria</x-tables.thead-th>
                    <x-tables.thead-th>Profesor</x-tables.thead-th>
                    <x-tables.thead-th>Acciones</x-tables.thead-th>
                </x-tables.thead>
                <tbody>
                @foreach($courses as $course)
                    <x-tables.tbody-tr>
                        <x-tables.tbody-th>{{ $course->name }}</x-tables.tbody-th>
                        <x-tables.tbody-td optional_classes="truncated-text">
                            {{ $course->description }}
                        </x-tables.tbody-td>
                        <x-tables.tbody-td>{{ $course->duration }}</x-tables.tbody-td>
                        <x-tables.tbody-state-td>{{ $course->state }}</x-tables.tbody-state-td>
                        <x-tables.tbody-td
                            optional_classes="capitalize"
                        >
                            {{ $course->category->course_area_name }}
                        </x-tables.tbody-td>
                        <x-tables.tbody-td
                            optional_classes="capitalize"
                        >
                            {{ $course->teacher->name }}
                        </x-tables.tbody-td>
                        <x-tables.tbody-td optional_classes="flex items-center gap-4">
                            <x-buttons.edit-button
                                :href="route('private.courses.edit-form', ['course' => $course])"
                            >
                                Editar
                            </x-buttons.edit-button>
                            @if(Auth::user()->isAdmin())
                                <x-buttons.delete-button
                                    :href="route('private.courses.delete', ['course' => $course])"
                                >
                                    Eliminar
                                </x-buttons.delete-button>
                            @endif
                            @if(Auth::user()->isTeacher())
                                <x-buttons.add-course-material-button :course="$course" />
                            @endif
                            <x-buttons.finish-course-button :course="$course" />
                        </x-tables.tbody-td>
                    </x-tables.tbody-tr>
                @endforeach
                </tbody>
            </x-tables.table>
        </div>
        <x-default-paginator :model="$courses" />
    </main>
</x-layouts.private>
