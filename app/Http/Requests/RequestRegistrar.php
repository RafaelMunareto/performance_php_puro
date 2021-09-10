<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestRegistrar extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                    'min:6',             // must be at least 10 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                //'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'attributes' => [
                'email' => 'email',
                'name' => 'nome',
                'password' => 'senha'
            ]
        ];


    }

    public function messages()
    {
        return [
            'require' => 'O campo :attribute é obrigatório.',
            'string' => 'O campo :attribute aceita somente letras.',
            'email' => 'O campo :attribute deve ser um email',
            'max' => 'O campo :attribute aceita no máximo 255 caracteres',
            'unique' => 'Você já é registrado clique em "esqueceu a senha?" na aba login.',
            'min' => 'O campo :attribute deve conter no mínimo 6 caracteres.',
            'confirmed' => 'As senhas devem ser iguais',
            'regex' => 'Essa senha não foi aceita! É necessário uma senha alfanumérica com o mínimo de 6 caracteres.'

        ];

    }
}
