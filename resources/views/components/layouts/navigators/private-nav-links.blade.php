@php
    use App\Enums\UserRole;
    use \Illuminate\Support\Facades\Auth;
@endphp

<x-nav-link
    :href="route('private.courses.index')"
    :active="request()->is('/private/courses/*') || request()->routeIs('private.courses.index')"
>
    Cursos
</x-nav-link>
<x-nav-link
    :href="route('private.registrations.index')"
    :active="request()->is('/private/registrations/*') || request()->routeIs('private.registrations.index')"
>
    Inscripciones
</x-nav-link>
<x-nav-link
    :href="route('private.evaluations.index')"
    :active="request()->is('/private/evaluations/*') || request()->routeIs('private.evaluations.index')"
>
    Evaluaciones
</x-nav-link>
<!-- Only show this to admins -->
@if(Auth::user()->isAdmin())
    <x-nav-link
        :href="route('private.users.index')"
        :active="request()->is('/private/users/*') || request()->routeIs('private.users.index')"
    >
        Usuarios
    </x-nav-link>
@endif
