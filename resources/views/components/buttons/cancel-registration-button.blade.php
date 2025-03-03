@props(['registration'])

<a
    @if($registration->isPending())
        href="{{ route('private.registrations.cancel', ['registration' => $registration]) }}"
    @endif
    class="btn text-white
    {{ !$registration->isPending() ? 'disabled-btn' : 'bg-red-600 hover:bg-red-800' }}"
>
    Cancelar registro
</a>
