@php
  use \App\Enums\RegistrationState
@endphp

<x-tables.tbody-td optional_classes="capitalize">
    @switch($slot)
        @case(RegistrationState::CONFIRMED->value) Confirmado @break
        @case(RegistrationState::CANCELLED->value) Cancelado @break
        @case(RegistrationState::PENDING->value) Pendiente @break
    @endswitch
</x-tables.tbody-td>
