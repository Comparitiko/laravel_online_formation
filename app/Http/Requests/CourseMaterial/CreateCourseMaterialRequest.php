<?php

namespace App\Http\Requests\CourseMaterial;

use App\Enums\MaterialType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

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
            'type' => ['required', new Enum(MaterialType::class)]
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'El campo file es obligatorio',
            'file.file' => 'El campo file debe ser un archivo',
            'file.mimes' => 'El campo file debe ser un archivo de tipo :values',
            'type.required' => 'El campo type es obligatorio',
            'type.enum' => 'El campo type debe ser uno de los siguientes valores: :values',
        ];
    }
}
