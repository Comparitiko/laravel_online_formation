@props(['course'])

<a
    href="{{ route('private.courses.add-material', ['course' => $course]) }}"
    class="btn bg-sky-600 text-white hover:bg-sky-800 whitespace-nowrap"
>
    Añadir material
</a>
