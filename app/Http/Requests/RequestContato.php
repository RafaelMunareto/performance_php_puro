<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestContato extends FormRequest
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
                'nome' => 'required|min:3',
                'cod_func' => 'required|integer',
                'email' => 'required|min:3|email',
                'mensagem' => 'required|min:3',
            ];

    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'min' => 'O campo :attribute precisa ter pelo menos 3 caracteres',
            'integer' => 'O campo :attribute aceita somente números',
            'email' => 'O campo :attribute aceita somente o formato de email'

        ];
    }
}
