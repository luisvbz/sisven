<?php

namespace App\Http\Requests\Orders;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'supplier_id' => 'required',
            'date' => 'required|date',
            'cost' => 'required|numeric',
            'warehouse_id' => 'required',
            'products' => 'required',
            'products.*.packages' => 'required|numeric',
            'products.*.quantity_per_packages' => 'required|numeric',
            'products.*.cost' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'supplier_id.required' => 'Seleccione el proveedor',
            'date.required' => 'Seleccione la fecha',
            'date.date' => 'Debe ser una fecha válida',
            'cost.required' => 'Ingrese el costro total de la compra',
            'cost.numeric' => 'Solo se aceptan números',
            'warehouse_id.required' => 'Seleccione el alamacen de destino',
            'products.required' => 'Debe agreagar los productos',
            'products.*.packages.required' => 'Requerido',
            'products.*.packages.numeric' => 'Solo se aceptan números',
            'products.*.quantity_per_packages.required' => 'Requerido',
            'products.*.quantity_per_packages.numeric' => 'Solo se aceptan números',
            'products.*.cost.required' => 'Requerido',
            'products.*.cost.numeric' => 'Solo se aceptan números',


        ];
    }
}
