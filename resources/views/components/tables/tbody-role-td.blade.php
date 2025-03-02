@php
  use \App\Enums\UserRole
@endphp

<x-tables.tbody-td optional_classes="capitalize">
    @switch($slot)
        @case(UserRole::ADMIN->value) Administrador @break
        @case(UserRole::TEACHER->value) Profesor @break
        @case(UserRole::STUDENT->value) Estudiante @break
    @endswitch
</x-tables.tbody-td>
