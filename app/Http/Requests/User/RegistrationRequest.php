<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'course_id' => ['required', 'exists:courses,id'],
            'student_id' => ['required', 'exists:users,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'course_id.required' => 'The course is required.',
            'course_id.state' => 'The course is not active.',
            'course_id.exists' => 'The course does not exist.',
            'student_id.required' => 'The student id is required.',
            'student_id.exists' => 'The student does not exist.',
        ];
    }
}
