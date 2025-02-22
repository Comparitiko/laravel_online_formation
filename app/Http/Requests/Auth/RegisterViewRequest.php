<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterViewRequest extends FormRequest
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
            'dni.required' => 'El dni es obligatorio',
            'dni.unique' => 'El dni ya existe',
            'dni.max' => 'El dni debe tener 9 digitos',
            'dni.regex' => 'El dni debe ser valido',
            'username.required' => 'El nombre de usuario es obligatorio',
            'username.max' => 'El nombre de usuario debe tener 255 caracteres o menos',
            'username.unique' => 'El nombre de usuario ya existe',
            'name.required' => 'El nombre es obligatorio',
            'surnames.required' => 'El apellidos es obligatorio',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email es invalido',
            'email.unique' => 'El email ya existe',
            'phone_number.required' => 'El numero de telefono es obligatorio',
            'phone_number.max' => 'El numero de telefono debe tener 9 digitos',
            'phone_number.unique' => 'El numero de telefono ya existe',
            'phone_number.regex' => 'El numero de telefono debe ser valido',
            'address.required' => 'La direccion es obligatoria',
            'city.required' => 'La ciudad es obligatoria',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'confirm_password.required' => 'La confirmacion de la contraseña es obligatoria',
            'confirm_password.same' => 'La confirmacion de la contraseña debe ser igual a la contraseña',
            'confirm_password.min' => 'La confirmacion de la contraseña debe tener al menos 8 caracteres',
        ];
    }
}
