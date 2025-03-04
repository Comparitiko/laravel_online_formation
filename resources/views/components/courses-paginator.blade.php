@props(['courses', 'course_name', 'duration', 'category'])

@php
  $firstPage = 1;
  $lastPage = $courses->lastPage();
  $currentPage = $courses->currentPage();
  $previousPage = $courses->previousPageUrl();
  $nextPage = $courses->nextPageUrl();
@endphp

<div class="mt-5 flex justify-between items-center">
    <a
        @if($currentPage !== 1)
            href="{{ $previousPage }}&course_name={{ $course_name }}&category={{ $category
            }}&duration={{ $duration }}"
        @endif
        class="{{$currentPage === 1 ? 'disabled-btn' : 'btn-primary'}}"
    >
        Anterior
    </a>

    <p>Página <span class="text-red-500">{{ $currentPage }}</span> de {{ $lastPage }}</p>

    <a
        @if($currentPage !== $lastPage)
            href="{{ $nextPage }}&course_name={{ $course_name }}&category={{ $category }}&duration={{ $duration }}"
        @endif
        class="{{$currentPage === $lastPage ? 'disabled-btn' : 'btn-primary'}}"
    >
        Siguiente
    </a>
</div>
