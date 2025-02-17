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
            'user_id' => ['required', 'exists:users,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'course_id.required' => 'The course is required.',
            'course_id.state' => 'The course is not active.',
            'course_id.exists' => 'The course does not exist.',
            'user_id.required' => 'The user is required.',
            'user_id.exists' => 'The user does not exist.',
            'user_id.role' => 'This user not exist.', // Exist but not student just for security
        ];
    }
}
