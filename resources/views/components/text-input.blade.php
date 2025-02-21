@props(['disabled' => false])

<input
    @disabled($disabled)
    {{ $attributes->merge(['class' => 'w-full p-2 rounded-lg bg-slate-600 text-white border-2
    border-slate-500 outline-none focus:border-cyan-400']) }}
>
