@props(['disabled' => false, 'type' => 'button'])

<button
    class="bg-cyan-500 text-white font-bold py-3 px-4 rounded-lg hover:bg-cyan-400 transition duration-300"
    >
    {{ $slot }}
</button>
