<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class ProfileRequest extends FormRequest
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
            'name' => 'required|string|max:25',
            'image' => 'nullable|image|size:2048',
            'description' => 'nullable|string|max:125',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Поле имя обязателен для заполнения',
            'image.image' => 'Файл должен быть изображением',
            'image.size' => 'Файл слишком большой',
            'description.max' => 'Максимум 125 символов',

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
