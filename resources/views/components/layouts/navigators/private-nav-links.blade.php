@php
    use App\Enums\UserRole;
    use \Illuminate\Support\Facades\Auth;
@endphp

<x-nav-link
    :href="route('private.courses.index')"
    :active="request()->routeIs('private.courses')"
>
    Cursos
</x-nav-link>
<x-nav-link
    :href="route('private.registrations.index')"
    :active="request()->routeIs('private.registrations.index')"
>
    Inscripciones
</x-nav-link>
<x-nav-link
    :href="route('private.evaluations.index')"
    :active="request()->routeIs('private.evaluations.index')"
>
    Evaluaciones
</x-nav-link>
<!-- Only show this to admins -->
@if(Auth::user()->role === UserRole::ADMIN)
    <x-nav-link
        :href="route('private.users')"
        :active="request()->routeIs('private.users.index')"
    >
        Usuarios
    </x-nav-link>
@endif
