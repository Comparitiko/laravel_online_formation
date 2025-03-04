<x-layouts.web title="Materiales del curso {{ $course->name }}">
    <main class="max-w-6xl mx-auto">
        <h1 class="text-xl font-bold my-4 text-center">Materiales del curso {{ $course->name }}</h1>
        <section class="grid gap-10 my-4">
{{--            <x-cards.course-material :material="$material" />--}}
            @foreach($materials as $material)
                <x-cards.course-material :material="$material" />
            @endforeach
        </section>
    </main>
</x-layouts.web>
