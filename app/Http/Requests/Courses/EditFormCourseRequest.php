<?php

namespace App\Http\Requests\Courses;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditFormCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return request()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Get the id of the editing course
        $actualId = $this->route('course')->id;

        return [
            'name' => ['required', 'string', 'max:255',
                Rule::unique('courses', 'name')->ignore($actualId)],
            'description' => ['required', 'string', 'max:255'],
            'duration' => ['required', 'integer', 'min:1'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'teacher_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'name.max' => 'El nombre debe tener 255 caracteres o menos',
            'name.unique' => 'El nombre del curso ya existe',
            'description.required' => 'La descripción es obligatoria',
            'description.max' => 'La descripción debe tener 255 caracteres o menos',
            'duration.required' => 'La duración es obligatoria',
            'duration.min' => 'La duración debe ser al menos 1',
            'category_id.required' => 'La categoría es obligatoria',
            'category_id.exists' => 'La categoría no existe',
            'teacher_id.required' => 'El profesor es obligatorio',
            'teacher_id.exists' => 'El profesor no existe',
        ];
    }
}
