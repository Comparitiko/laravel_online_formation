@props(['href'])

<a
    href="{{ $href }}"
    class="btn bg-green-600 text-white hover:bg-green-800"
>
    {{ $slot }}
</a>
