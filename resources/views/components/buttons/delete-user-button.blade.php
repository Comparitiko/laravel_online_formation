@props(['hasActiveRegistrations', 'user'])

<a
    @if(!$hasActiveRegistrations)
        href="{{ route('private.users.delete', ['user' => $user]) }}"
    @endif
    class="btn text-white whitespace-nowrap
        {{ !$hasActiveRegistrations ? 'hover:bg-red-900 bg-red-700' : 'disabled-btn' }}
    "
>
    Eliminar usuario
</a>
