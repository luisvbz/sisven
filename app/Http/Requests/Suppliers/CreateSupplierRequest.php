<?php

namespace App\Http\Requests\Suppliers;

use Illuminate\Foundation\Http\FormRequest;

class CreateSupplierRequest extends FormRequest
{

    public function authorize()
    {
        return $this->user()->hasPermissionTo('pv:create');
    }

    public function rules()
    {
        return [
            'ruc' => 'required|digits:11|unique:suppliers,ruc',
            'name' => 'required',
            'phone_number' => 'nullable|numeric'
        ];
    }

    public function messages()
    {
        return [
            'ruc.required' => 'Debe agreagar el ruc',
            'ruc.digits' => 'El ruc debe contener 11 dígitos',
            'ruc.unique' => 'Ya exite un proveedore registrado con el mismo ruc',
            'name' => 'Debe escribir la razon social',
            'phone_number' => 'Solo puede escribir números'
        ];
    }
}
