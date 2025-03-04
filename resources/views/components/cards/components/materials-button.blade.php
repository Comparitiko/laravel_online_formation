@props(['course'])

@php
@endphp

<a
    class="
        bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded-lg
        transition-colors
        duration-300'
    "
    href="{{ route('students.courses.materials', ['course' => $course]) }}"
>
    Ver materiales
</a>
