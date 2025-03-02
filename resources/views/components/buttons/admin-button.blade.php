@props(['user'])

<a
    @if(!$user->isAdmin())
        href="{{ route('private.users.admin', ['user' => $user]) }}"
    @endif
    class="btn text-white
    {{ $user->isAdmin() ? 'disabled-btn' : 'bg-violet-600 hover:bg-violet-800' }}"
>
    Administrador
</a>
