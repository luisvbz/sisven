<?php

namespace App\Http\Requests\Stores;

use App\Models\Store;
use Illuminate\Validation\Rule;
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
            'code' => ['required',Rule::unique(Store::class)->ignore($this->store->id)],
            'name' => 'required',
            'departament_id' => 'required',
            'province_id' => 'required',
            'district_id' => 'required',
            'address' => 'required',
            'phone_number' => 'required|numeric',
            'is_principal' => function ($attr, $value, $fail) {
                if ($value != 0) {
                    if(!Store::where('id', $this->store->id)->where('is_principal', true)->exists()) {
                        if(Store::where('is_principal', true)->exists()) {

                            $fail("Ya éxiste una tienda principal.");
                        }
                    }
                }
            }
        ];
    }

    public function messages()
    {
        return [
            'code.required' => 'Debe escribir el código',
            'code.unique' => 'El codigo esta siendo usado',
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
