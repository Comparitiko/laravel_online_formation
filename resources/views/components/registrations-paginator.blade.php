@props(['registrations', 'course_name', 'student_name', 'registration_state'])

@php
  $firstPage = 1;
  $lastPage = $registrations->lastPage();
  $currentPage = $registrations->currentPage();
  $previousPage = $registrations->previousPageUrl();
  $nextPage = $registrations->nextPageUrl();
@endphp

<div class="mt-5 flex justify-between items-center">
    <a
        @if($currentPage !== 1)
            href="{{ $previousPage }}&course_name={{ $course_name }}&student_name={{ $student_name
            }}&registration_state={{ $registration_state }}"
        @endif
        class="{{$currentPage === 1 ? 'disabled-btn' : 'btn-primary'}}"
    >
        Anterior
    </a>

    <p>Página <span class="text-red-500">{{ $currentPage }}</span> de {{ $lastPage }}</p>

    <a
        @if($currentPage !== $lastPage)
            href="{{ $nextPage }}&course_name={{ $course_name }}&student_name={{ $student_name
            }}&registration_state={{ $registration_state }}"
        @endif
        class="{{$currentPage === $lastPage ? 'disabled-btn' : 'btn-primary'}}"
    >
        Siguiente
    </a>
</div>
