<?php

namespace App\Http\Requests\Stores;

use App\Rules\UniquePrincipal;
use Illuminate\Foundation\Http\FormRequest;

class StoreSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasPermissionTo('ti:create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code' => 'required|unique:stores,code',
            'name' => 'required',
            'type' => 'required',
            'departament_id' => 'required',
            'province_id' => 'required',
            'district_id' => 'required',
            'address' => 'required',
            'phone_number' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Debe escribir el código',
            'code.unique' => 'El codigo esta siendo usado',
            'name.required' => 'Debe ingresar el nombre',
            'type.required' => 'Debe seleccionar el tipo',
            'departament_id.required' => 'Seleccione el departamento',
            'province_id.required' => 'Seleccione la provincia',
            'district_id.required' => 'Seleccione el distrito',
            'address.required' => 'Escriba la dirección',
            'phone_number.required' => 'Ingrese en teléfono',
            'phone_number.numeric' => 'Solo se permiten numeros'
        ];
    }
}
