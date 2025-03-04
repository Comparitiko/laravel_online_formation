<x-layouts.private title="Evaluaciones">
    <main class="max-w-6xl mx-auto">
        <div class="relative overflow-auto shadow-xl rounded-xl border-gray-900">
            <x-tables.table>
                <x-tables.thead>
                    <x-tables.thead-th>Curso</x-tables.thead-th>
                    <x-tables.thead-th>Usuario</x-tables.thead-th>
                    <x-tables.thead-th>Profesor</x-tables.thead-th>
                    <x-tables.thead-th>Nota final</x-tables.thead-th>
                    <x-tables.thead-th>Comentarios</x-tables.thead-th>
                    @if(Auth::user()->isTeacher()) <x-tables.thead-th>Acciones</x-tables.thead-th> @endif
                </x-tables.thead>
                <tbody>
                @foreach($registrations as $registration)
                    @php
                        $evaluation = $registration->evaluation();
                    @endphp
                    <x-tables.tbody-tr>
                        <x-tables.tbody-th>{{ $registration->course->name }}</x-tables.tbody-th>
                        <x-tables.tbody-td>
                            {{ $registration->student->name }}
                            {{ $registration->student->surnames }}
                        </x-tables.tbody-td>
                        <x-tables.tbody-td>
                            {{ $registration->course->teacher->name }}
                            {{ $registration->course->teacher->surnames }}
                        </x-tables.tbody-td>
                        <x-tables.tbody-td>{{ $evaluation->final_note ?? '' }}</x-tables.tbody-td>
                        <x-tables.tbody-td
                            optional_classes="w-10/12 whitespace-pre-wrap"
                        >
                            {{ $evaluation->comments ?? '' }}
                        </x-tables.tbody-td>
                        @if(Auth::user()->isTeacher())
                            <x-tables.tbody-td optional_classes="flex items-center gap-4">
                                <x-buttons.create-evaluation-button
                                    :evaluation="$evaluation"
                                    :registration="$registration"
                                />
                            </x-tables.tbody-td>
                        @endif
                    </x-tables.tbody-tr>
                @endforeach
                </tbody>
            </x-tables.table>
        </div>
        <x-default-paginator :model="$registrations" />
    </main>
</x-layouts.private>
