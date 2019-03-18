<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;

class StandardRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a efetuar o request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * VAlidação padrão para os controles que as utilizam.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'name' => 'required'
        ];
    }

    /**
     * Exibe as mensagens para as regras de validações definidas.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //'name.required' => 'A name is required',
        ];
    }
}
