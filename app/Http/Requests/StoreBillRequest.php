<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBillRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'client_id' => 'required',
            'document_type' => 'required|in:FACT,BOL,NDD,NDC',
            'serie' => 'required',
            'number' => 'required|numeric',
            'total_gravada' => 'required|numeric',
            'total_inafecta' => 'nullable|numeric',
            'total_exonerada' => 'nullable|numeric',
            'total_igv' => 'required|numeric',
            'total' => 'required|numeric|min:0',
            'observations' => '',
            'emition_date' => 'required|date',
            'products' => 'required|array',
            'products.*.product_id' => 'required',
            'products.*.full_name' => 'required|string|max:255',
            'products.*.measure' => 'required|string|max:10',
            'products.*.cant' => 'required|integer|min:1',
            'products.*.unit_price' => 'required|numeric|min:0',
            'products.*.total_price' => 'required|numeric|min:0',
            'file' => 'nullable|mimes:pdf'
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => 'El campo cliente es obligatorio.',
            'document_type.required' => 'El campo tipo es obligatorio.',
            'document_type.in' => 'El campo tipo debe ser DOC o UNID.',
            'serie.required' => 'El campo serie es obligatorio.',
            'number.required' => 'El campo número es obligatorio.',
            'number.numeric' => 'El campo número debe ser numérico.',
            'currency.required' => 'El campo moneda es obligatorio.',
            'total_gravada.required' => 'El campo total grabada es obligatorio.',
            'total_gravada.numeric' => 'El campo total grabada debe ser numérico.',
            'total_inafecta.numeric' => 'El campo total inafecta debe ser numérico.',
            'total_exonerada.numeric' => 'El campo total exonerada debe ser numérico.',
            'total_igv.required' => 'El campo total IGV es obligatorio.',
            'total_igv.numeric' => 'El campo total IGV debe ser numérico.',
            'total.required' => 'El campo total es obligatorio.',
            'total.numeric' => 'El campo total debe ser numérico.',
            'total.min' => 'El campo total debe ser mayor a cero.',
            'emition_date.required' => 'El campo fecha de emisión es obligatorio.',
            'emition_date.date' => 'El campo fecha de emisión debe ser una fecha válida.',
            'file.mimes' => 'El archivo debe ser un pdf'
        ];
    }
}
