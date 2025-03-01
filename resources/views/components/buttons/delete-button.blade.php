@props(['href'])

<a
    href="{{ $href }}"
    class="btn bg-red-700 text-white hover:bg-red-900"
>
    {{ $slot }}
</a>
