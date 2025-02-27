@props(['disabled' => false, 'type' => 'button', 'onclick' => null])

<button
    @if($disabled) disabled @endif
    type="{{ $type }}"
    @if($onclick) onclick="{{$onclick}}" @endif
    class="bg-cyan-500 text-white font-bold py-3 px-4 rounded-lg hover:bg-cyan-400 transition duration-300"
    >
    {{ $slot }}
</button>
