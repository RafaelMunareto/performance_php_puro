<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestEquipe extends FormRequest
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
                'cod_func1' => 'integer',
                'nome_func1' => 'string'
            ];

    }

    public function messages()
    {
        return [
            'integer' => 'O campo :attribute só aceita números',
            'string' => 'O campo :attribute só aceita letras'
        ];
    }
}
