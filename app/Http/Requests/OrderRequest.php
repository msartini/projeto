<?php

namespace App\Http\Requests;

use App\Product;
use App\Http\Requests\FormRequest;

class OrderRequest extends FormRequest
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
     * Obtem as regras de validação que se aplicam à solicitação.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quantity' => 'required|numeric',
            'product_id' => 'required|numeric',
            'user_id' => 'required|numeric'
        ];
        
    }

    /**
     * Obtem a mensagem de erro configurada na regra de validação.
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
