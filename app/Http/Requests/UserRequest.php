<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class UserRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'login' => 'required|string|unique:users,login',
            'password_verify' => 'required|same:password'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Email обязателен для заполнения',
            'email.unique' => 'Email уже зарегестрирован',
            'password.min' => 'Пароль должен быть не менее 8 символов',
            'password.required' => 'Пароль обязателен для заполнения',
            'login.required' => 'Логин обязателен для заполнения',
            'login.unique' => 'Логин уже зарегестрирован',
            'password_verify.required'=> 'Пароль обязателен для заполнения',
            'password_verify.same' => 'Пароли должны совпадать'
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'errors' => $validator->errors()
            ], 400)
        );
    }
}
