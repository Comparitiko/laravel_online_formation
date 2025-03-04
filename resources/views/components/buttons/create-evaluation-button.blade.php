@props(['evaluation', 'registration'])

<a
    @if(!$evaluation)
        href="{{ route('private.evaluations.create-form', ['registration' => $registration] ) }}"
    @endif
    class="{{ $evaluation ? 'disabled-btn' : 'btn bg-green-600 text-white hover:bg-green-800' }}"
>
    Evaluar
</a>
