@props(['href'])

<a
    href="{{ $href }}"
    class="btn bg-emerald-600 text-white hover:bg-emerald-800"
>
    {{ $slot }}
</a>
