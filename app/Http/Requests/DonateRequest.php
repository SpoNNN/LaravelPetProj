<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DonateRequest extends FormRequest
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
            'donator_name' => 'required_if:anonymous,false|string|max:30',
            'message' => 'required|string|max:1000',
            'amount' => 'required|numeric|min:10',
            'anonymous' => 'in:0,1',
            'email' => 'nullable|email|max:255'
        ];
    }

    protected function prepareForValidation()
    {
        $anonymous = $this->has('anonymous') ? 1 : 0;

        $this->merge([
            'anonymous' => $anonymous,
            'donator_name' => $anonymous ? 'Аноним' : $this->input('donator_name'),
        ]);
    }

    public function messages(): array
    {
        return [
            'donator_name.required_if' => 'Имя обязательно, или выберите отправку анонимно',
            'donator_name.string' => 'Имя должно быть строкой',
            'donator_name.max' => 'Имя слишком большое',
            'message.required' => 'Сообщение обязательно',
            'message.string' => 'Сообщение должно быть строкой',
            'message.max' => 'Сообщение слишком большое',
            'amount.required' => 'Сумма обязательна',
            'amount.numeric' => 'Сумма должно быть числом',
            'amount.min' => 'Сумма не может быть ниже 10',
            'anonymous.in' => 'Значение анонимности может быть 1 или 0',
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
