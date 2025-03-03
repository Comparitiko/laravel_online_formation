@props(['registration'])

<a
    @if($registration->isPending())
        href="{{ route('private.registrations.confirm', ['registration' => $registration]) }}"
    @endif
    class="btn text-white
    {{ !$registration->isPending() ? 'disabled-btn' : 'bg-lime-600 hover:bg-lime-800' }}"
>
    Confirmar registro
</a>
