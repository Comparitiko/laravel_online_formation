<x-layouts.private title="Cursos">
    <main class="p-5">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
                            <x-tables.tbody-td>{{ $course->description }}</x-tables.tbody-td>
                            <x-tables.tbody-td>{{ $course->duration }}</x-tables.tbody-td>
                            <x-tables.tbody-td>{{ $course->state->value }}</x-tables.tbody-td>
                            <x-tables.tbody-td>{{ $course->category->course_area_name }}</x-tables.tbody-td>
                            <x-tables.tbody-td>{{ $course->teacher->name }}</x-tables.tbody-td>
                            <x-tables.tbody-td>
                                <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            </x-tables.tbody-td>
                        </x-tables.tbody-tr>
                    @endforeach
                </tbody>
            </x-tables.table>
        </div>
    </main>
</x-layouts.private>
