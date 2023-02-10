<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasPermissionTo('pr:create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code' => 'required',
            'type_id' => 'required',
            'description' => 'required',
            'measure_id' => 'required',
            'price' => 'required|numeric',
            'cost' => 'required|numeric',
            'minimum_stock' => 'required|numeric',
            'stores.*.quantity' => 'required_if:add_stock,1',
            'stores.*.package_quantity' => 'required_if:add_stock,1',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Debe ingresar el codigo',
            'type_id.required' => 'Debe seleccionar el tiṕo',
            'description.required' => 'Debe ingresar la descrioción',
            'measure_id.required' => 'Debe seleccionar la unidad de medida',
            'price.required' => 'Ingrese el monto',
            'price.numeric' => 'Debe ser un número',
            'cost.required' => 'Ingrese el monto',
            'cost.numeric' => 'Debe ser un número',
            'minimum_stock.required' => 'Debe llenar este campo',
            'stores.*.quantity.required_if' => 'Ingrese la cantidad',
            'stores.*.package_quantity.required_if' => 'Ingrese la descripción',
        ];
    }
}

