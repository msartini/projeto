<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;

class ProductRequest extends FormRequest
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
        $id = "";
        if (isset(request()->route()->parameters['produto'])) {
            $id = request()->route()->parameters['produto'];
        }

        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name' => 'required|unique:products'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => 'required|unique:products,id,'.$id
                ];
            }
            default:break;
        }
       
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
