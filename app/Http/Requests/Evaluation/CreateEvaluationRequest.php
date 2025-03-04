<?php

namespace App\Http\Requests\Evaluation;

use Illuminate\Foundation\Http\FormRequest;

class CreateEvaluationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'final_note' => ['required', 'number', 'min:0', 'max:10'],
            'comments' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'final_note.required' => 'La nota final es obligatoria',
            'final_note.min' => 'La nota final debe ser un número entre 0 y 10',
            'final_note.max' => 'La nota final debe ser un número entre 0 y 10',
            'comments.required' => 'Los comentarios son obligatorios',
            'comments.max' => 'Los comentarios deben ser 255 caracteres o menos',
        ];
    }
}
