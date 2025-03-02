@props(['user'])

<a
    @if(!$user->isTeacher())
        href="{{ route('private.users.teacher', ['user' => $user]) }}"
    @endif
    class="btn text-white
    {{ $user->isTeacher() ? 'disabled-btn' : 'bg-cyan-600 hover:bg-cyan-800' }}"
>
    Profesor
</a>
