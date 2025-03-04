@props(['material'])

@php
    use App\Enums\MaterialType;
@endphp

<div class="bg-gray-200 p-4 flex items-center justify-center md:w-24">
    @switch($material->type)
        @case(MaterialType::PDF)
            <x-icons.pdf-icon />
        @break
        @case(MaterialType::LINK)
            <x-icons.link-icon />
        @break
        @case(MaterialType::VIDEO)
            <x-icons.video-icon />
        @break
        @case(MaterialType::REPOSITORY)
            <x-icons.repository-icon />
        @break
    @endswitch
</div>
