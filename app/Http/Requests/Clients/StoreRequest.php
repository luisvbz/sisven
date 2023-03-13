<?php

namespace App\Http\Requests\Clients;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'document_type' => 'required',
            'document_number' => 'required|numeric|unique:clients',
            'name' => 'required',
            'phone_office' => 'nullable|numeric',
            'phone_celular' => 'nullable|numeric',
            'email' => 'nullable|email',
        ];
    }

    public function messages()
    {
        return [
            'document_type.required' => 'Requerido',
            'document_number.required' => 'Requerido',
            'document_number.numeric' => 'Solo números',
            'document_number.unique' => 'El documento ya está registrado',
            'name.required' => 'Requerido',
            'phone_office.numeric' => 'Solo números',
            'phone_celular.numeric' => 'Solo números',
            'email.email' => 'El email es inválido',
        ];
    }
}
