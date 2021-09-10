<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestReset extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'email' => 'required|unique:email|email'
        ];

    }

    public function messages()
    {
        return [
            'email.required' => 'O campo email é obrigatório.',
            'email.unique' => 'Cliente já cadastrado.',
            'email' => 'O campo :attribute deve ser um email'
        ];
    }
}
