<?php

namespace App\Http\Requests\Stores;

use App\Models\Store;
use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->hasPermissionTo('ti:edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code' => ['required',Rule::unique(Store::class)->ignore($this->id)],
            'name' => 'required',
            'departament_id' => 'required',
            'province_id' => 'required',
            'district_id' => 'required',
            'address' => 'required',
            'phone_number' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Debe escribir el código',
            'name.required' => 'Debe ingresar el nombre',
            'departament_id.required' => 'Seleccione el departamento',
            'province_id.required' => 'Seleccione la provincia',
            'district_id.required' => 'Seleccione el distrito',
            'address.required' => 'Escriba la dirección',
            'phone_number.required' => 'Ingrese en teléfono',
            'phone_number.numeric' => 'Solo se permiten numeros'
        ];
    }
}
