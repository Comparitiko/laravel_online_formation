<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'dni' => ['required', 'string', 'max:9', 'regex:/^[0-9]{8}[A-Z]$/', 'unique:users'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'surnames' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'string', 'max:9', 'unique:users', 'regex:/^[0-9]{9}$/'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'string', 'min:8', 'same:password'],
        ];
    }

    public function messages()
    {
        return [
            'dni.required' => 'DNI is required',
            'dni.unique' => 'DNI already exist',
            'dni.max' => 'DNI must be 9 digits',
            'dni.regex' => 'DNI must be valid',
            'username.required' => 'Username is required',
            'username.max' => 'Username must be 255 characters or less',
            'username.unique' => 'Username already exist',
            'name.required' => 'Name is required',
            'surnames.required' => 'Surnames is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is invalid',
            'email.unique' => 'Email already exist',
            'phone_number.required' => 'Phone number is required',
            'phone_number.max' => 'Phone number must be 9 digits',
            'phone_number.unique' => 'Phone number already exist',
            'phone_number.regex' => 'Phone number must be valid',
            'address.required' => 'Address is required',
            'city.required' => 'City is required',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters',
            'confirm_password.required' => 'Password confirmation is required',
            'confirm_password.same' => 'Password confirmation must match password',
            'confirm_password.min' => 'Password confirmation must be at least 8 characters',
        ];
    }
}
