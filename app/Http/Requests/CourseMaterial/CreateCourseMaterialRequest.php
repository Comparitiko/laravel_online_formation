<?php

namespace App\Http\Requests\CourseMaterial;

use App\Enums\MaterialType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCourseMaterialRequest extends FormRequest
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
            'file' => ['required', 'file', 'mimes:pdf,docx,xlsx,pptx,mp4,mp3,jpg,jpeg,png,gif,txt,csv,zip'],
            'type' => ['required', Rule::in(MaterialType::names())],
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'El archivo es obligatorio',
            'file.file' => 'El archivo debe ser un archivo',
            'file.mimes' => 'El archivo debe ser un archivo de tipo :values',
            'type.required' => 'El tipo del material es obligatorio',
            'type.in' => 'El tipo del material debe ser uno de los siguientes valores: :values',
        ];
    }
}
