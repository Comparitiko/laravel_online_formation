@props(['title', 'action', 'method' => 'POST'])

<section class="form-container bg-slate-700 rounded-xl shadow-lg overflow-hidden w-full max-w-md">
    <div class="p-8">
        <h2 class="text-3xl font-bold text-white mb-6">{{ $title }}</h2>
        <form action="{{ $action }}" method="{{ $method }}">
            @csrf
            {{ $slot }}
        </form>
    </div>
</section>
