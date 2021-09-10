<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestAdm extends FormRequest
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
                'cod_item1' => 'integer|required',
                'meta1' => 'required',
                'peso1' => 'required',
                'categoria1' => 'required',
                'nome_item1' => 'string|required|min:2'
            ];

    }

    public function messages()
    {
        return [
            'required' => 'Ocampo :attribute é obrigatório',
            'integer' => 'O campo :attribute só aceita números',
            'numeric' => 'O campo :attribute só aceita o formato numérico',
            'string' => 'O campo :attribute só aceita letras'
        ];
    }
}
