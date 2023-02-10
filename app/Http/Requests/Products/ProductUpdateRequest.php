<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasPermissionTo('pr:edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product.price' => 'required|numeric',
            'product.cost' => 'required|numeric',
            'product.minimun_stock' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'product.price.required' => 'Ingrese el monto',
            'product.price.numeric' => 'Debe ser un número',
            'product.cost.required' => 'Ingrese el monto',
            'product.cost.numeric' => 'Debe ser un número',
            'product.minimun_stock.required' => 'Debe especificar el stock minimo',
        ];
    }
}
