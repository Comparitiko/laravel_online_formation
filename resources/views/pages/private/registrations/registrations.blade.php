@props([
    'course_name' => '',
    'student_name' => '',
    'registration_state' => ''
])

@php
    use \App\Enums\RegistrationState;
@endphp

<x-layouts.private title="Inscripciones">
    <main class="max-w-6xl mx-auto">
        <div class="m-4">
            <h1 class="text-xl font-bold my-4">Buscar inscripción</h1>
            <form
                action="{{ route('private.registrations.search') }}"
                method="GET"
                class="flex items-center gap-10 mb-6"
            >
                <div>
                    <x-input-label for="course_name">Nombre del curso</x-input-label>
                    <x-text-input
                        type="text"
                        name="course_name"
                        id="course_name"
                        :value="old('course_name', $course_name)"
                        placeholder="Nombre curso"
                        autocomplete="course_name"
                    />
                    <x-input-error :messages="$errors->get('course_name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="student_name">Nombre del estudiante</x-input-label>
                    <x-text-input
                        type="text"
                        name="student_name"
                        id="student_name"
                        :value="$student_name"
                        placeholder="Nombre estudiante"
                        autocomplete="student_name"
                    />
                    <x-input-error :messages="$errors->get('student_name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="registration_state">Estado de la inscripción</x-input-label>
                    <x-select
                        name="registration_state"
                        id="registration_state"
                    >
                        <x-option
                            value=""
                            :selected_option="old('registration_state', $registration_state)"
                        >
                            Estado del registro
                        </x-option>
                        @foreach(RegistrationState::cases() as $registrationState)
                            <x-option
                                :value="$registrationState->name"
                                :selected_option="old('registration_state', $registration_state)"
                            >
                                {{ RegistrationState::translate($registrationState) }}
                            </x-option>
                        @endforeach
                    </x-select>
                    <x-input-error :messages="$errors->get('registration_state')" class="mt-2" />
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
        <div class="relative overflow-auto shadow-xl rounded-xl border-gray-900">
            <x-tables.table>
                <x-tables.thead>
                    <x-tables.thead-th>Curso</x-tables.thead-th>
                    <x-tables.thead-th>Usuario</x-tables.thead-th>
                    <x-tables.thead-th>Estado</x-tables.thead-th>
                    <x-tables.thead-th>Acciones</x-tables.thead-th>
                </x-tables.thead>
                <tbody>
                @foreach($registrations as $registration)
                    <x-tables.tbody-tr>
                        <x-tables.tbody-th>{{ $registration->course->name }}</x-tables.tbody-th>
                        <x-tables.tbody-td>
                            {{ $registration->student->name }}
                            {{ $registration->student->surnames }}
                        </x-tables.tbody-td>
                        <x-tables.tbody-registration-state-td>
                            {{ $registration->state }}
                        </x-tables.tbody-registration-state-td>
                        <x-tables.tbody-td optional_classes="flex items-center gap-4">
                            <x-buttons.confirm-registration-button :registration="$registration" />
                            <x-buttons.cancel-registration-button :registration="$registration" />
                        </x-tables.tbody-td>
                    </x-tables.tbody-tr>
                @endforeach
                </tbody>
            </x-tables.table>
        </div>
        <x-registrations-paginator
            :registrations="$registrations"
            :course_name="$course_name"
            :student_name="$student_name"
            :registration_state="$registration_state"
        />
    </main>
</x-layouts.private>
