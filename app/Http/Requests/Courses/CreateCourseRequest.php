<?php

namespace App\Http\Requests\Courses;

use Illuminate\Foundation\Http\FormRequest;

class CreateCourseRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'category_id' => 'required|integer|exists:categories,id',
            'teacher_id' => 'required|integer|exists:users,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.max' => 'Name must be 255 characters or less',
            'description.required' => 'Description is required',
            'description.max' => 'Description must be 255 characters or less',
            'duration.required' => 'Duration is required',
            'duration.min' => 'Duration must be at least 1',
            'category_id.required' => 'Category is required',
            'category_id.exists' => 'Category does not exist',
            'teacher_id.required' => 'Teacher is required',
            'teacher_id.exists' => 'Teacher does not exist',
        ];
    }
}
