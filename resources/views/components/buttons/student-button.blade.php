@props(['user'])

<a
    @if(!$user->isStudent())
        href="{{ route('private.users.student', ['user' => $user]) }}"
    @endif
    class="btn text-white
    {{ $user->isStudent() ? 'disabled-btn' : 'bg-emerald-600 hover:bg-emerald-800' }}"
>
    Estudiante
</a>
