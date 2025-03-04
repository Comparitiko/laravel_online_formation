<x-nav-link
    :href="route('students.courses.index')"
    :active="request()->routeIs('students.courses.index')"
>
    Cursos
</x-nav-link>
<x-nav-link
    :href="route('students.courses.registered')"
    :active="request()->routeIs('students.courses.registered')"
>
    Mis cursos
</x-nav-link>
<x-nav-link
    :href="route('about-us')"
    :active="request()->routeIs('about-us')"
>
    Sobre nosotros
</x-nav-link>
