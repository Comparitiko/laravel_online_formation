@props(['course'])

@php
    use Illuminate\Support\Facades\Auth;
    $registered = Auth::user()->isRegistered($course)
@endphp

<a
    class="
        {{ $registered ? 'disabled-btn' : 'bg-indigo-600 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded-lg
        transition-colors
        duration-300' }}
    "
    @if(!$registered)
        href="{{ route('students.registrations.create', ['course' => $course]) }}"
    @endif
>
    {{
      $registered
        ? 'Inscrito'
        : 'Inscribirse'
    }}
</a>
