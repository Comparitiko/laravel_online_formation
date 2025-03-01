@props(['course'])

<a
    @if($course->isActive()) href="{{ route('private.courses.finish', ['course' => $course]) }}" @endif
    class="btn text-white {{ $course->isActive() ? 'bg-red-500 shadow-md hover:bg-red-700' : 'bg-gray-500 cursor-text' }}"
>
    Finalizar
</a>
