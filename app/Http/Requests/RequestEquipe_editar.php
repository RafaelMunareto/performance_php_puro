<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestEquipe_editar extends FormRequest
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
                'cod_func' => 'integer|required',
                'nome' => 'string|min:3|required'
            ];

    }

    public function messages()
    {
        return [
            'min' => 'O campo :attribute precisa de 3 digitos',
            'required' => 'O campo :attribute é obrigatório',
            'integer' => 'O campo :attribute só aceita números',
            'string' => 'O campo :attribute só aceita letras'
        ];
    }
}
