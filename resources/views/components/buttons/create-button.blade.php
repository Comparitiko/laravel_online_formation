@props(['href'])

<a
    href="{{ $href }}"
    class="btn bg-green-400"
>
    {{ $slot }}
</a>
