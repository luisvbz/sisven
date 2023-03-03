<?php

namespace App\Http\Requests\Warehouse;

use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'warehouse_id' => 'required',
            'store_id' => 'required',
            'products' => 'required',
            'products.*.quantity' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'warehouse_id.required' => 'Seleccione el proveedor',
            'store_id.required' => 'Seleccione la tienda de destino',
            'products.required' => 'Seleccione los productos',
            'products.*.quantity.required' => 'Ingrese la cantidad',
            'products.*.quantity.numeric' => 'Solo números',
        ];
    }
}
