@php
  use \App\Enums\CourseState
@endphp

<x-tables.tbody-td optional_classes="capitalize">
    @switch($slot)
        @case(CourseState::ACTIVE->value) Activo @break
        @case(CourseState::CANCELLED->value) Cancelado @break
        @case(CourseState::FINISHED->value) Finalizado @break
    @endswitch
</x-tables.tbody-td>
