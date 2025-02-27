@props(['model'])

@php
  $firstPage = 1;
  $lastPage = $model->lastPage();
  $currentPage = $model->currentPage();
  $previousPage = $model->previousPageUrl();
  $nextPage = $model->nextPageUrl();
@endphp

<div class="mt-5 flex justify-between items-center">
    <a
        href="{{ $previousPage }}"
        class="{{$currentPage === 1 ? 'disabled-btn' : 'btn-primary'}}"
    >
        Anterior
    </a>

    <p>Página <span class="text-red-500">{{ $currentPage }}</span> de {{ $lastPage }}</p>

    <a
        href="{{ $nextPage }}"
        class="{{$currentPage === $lastPage ? 'disabled-btn' : 'btn-primary'}}"
    >
        Siguiente
    </a>
</div>
