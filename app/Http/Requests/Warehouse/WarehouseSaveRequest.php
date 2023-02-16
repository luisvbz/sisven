<?php

namespace App\Http\Requests\Warehouse;

use Illuminate\Foundation\Http\FormRequest;

class WarehouseSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasPermissionTo('wr:create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'departament_id' => 'required',
            'province_id' => 'required',
            'district_id' => 'required',
            'address' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Debe ingresar el nombre',
            'departament_id.required' => 'Seleccione el departamento',
            'province_id.required' => 'Seleccione la provincia',
            'district_id.required' => 'Seleccione el distrito',
            'address.required' => 'Escriba la dirección',
            'phone_number.required' => 'Ingrese en teléfono',
        ];
    }
}
