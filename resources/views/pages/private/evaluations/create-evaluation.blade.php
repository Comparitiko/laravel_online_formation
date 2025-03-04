<x-layouts.private
    title="Evaluar al alumno {{ $registration->student->name }} en el curso {{ $registration->course->name }}">
    <main class="bg-slate-800 h-screen flex items-center justify-center p-4">
        <x-form
            title="Evaluar a {{ $registration->student->name }} en {{$registration->course->name }}"
            :action="route('private.evaluations.create', ['registration' => $registration])"
        >
            <div class="mb-6 relative">
                <x-input-label for="final_note">Nota final</x-input-label>
                <x-text-input
                    type="number"
                    name="final_note"
                    id="final_note"
                    :value="old('final_note')"
                    min="0"
                    max="10"
                    step="0.01"
                    required
                />
                <x-input-error :messages="$errors->get('final_note')" class="mt-2" />
            </div>

            <div class="mb-6 relative">
                <x-input-label for="comments">Comentarios</x-input-label>
                <x-textarea
                    type="text"
                    id="comments"
                    name="comments"
                    required
                >
                    {{ old('comments') }}
                </x-textarea>
                <x-input-error :messages="$errors->get('comments')" class="mt-2" />
            </div>

            <div class="flex items-center justify-around mt-4">
                <x-buttons.primary-button
                    type="submit"
                    class="w-1/2"
                >
                    Evaluar al alumno
                </x-buttons.primary-button>
            </div>
        </x-form>
    </main>
</x-layouts.private>
