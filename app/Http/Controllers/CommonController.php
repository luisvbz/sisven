<?php

namespace App\Http\Controllers;

use App\Tools\DniRuc;
use App\Models\Product;
use App\Models\District;
use App\Models\Province;
use App\Models\Transfer;
use App\Models\ProductType;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function getProvices($departamentId)
    {
        return response()->json(Province::where('departament_id', $departamentId)->get());
    }

    public function getDistricts($provinceId)
    {
        return response()->json(District::where('province_id', $provinceId)->get());
    }

    public function getCategory($typeId)
    {
        $type = ProductType::find($typeId);

        return response()->json(['category' => $type->category]);
    }

    public function getPerson(Request $request)
    {
        $person = DniRuc::getData('DNI', $request->dni);
        $name = gettype($person) == 'object'
            ? "{$person->nombres} {$person->apellidoPaterno} {$person->apellidoMaterno}"
            : null;

        return response()->json(['name' => $name ]);
    }

    public function getClient(Request $request)
    {

    }

    public function getBussiness(Request $request)
    {
        $bussines = DniRuc::getData('RUC', $request->ruc);
        $name = gettype($bussines) == 'object'
            ? "{$bussines->razonSocial}"
            : null;

        return response()->json(['name' => $name ]);
    }

    public function getProduct(Request $request)
    {
        $product = Product::find($request->product);

        if(!$product) {
            return response()->json(['error' => 'No se ha encontrado'], 422);
        }

        $response = [];
        $response['id'] = $product->id;
        $response['name'] = $product->full_name." ({$product->measure->name})";
        $response['packages'] = null;
        $response['quantity_per_packages'] = null;
        $response['cost'] = 0;

        return response()->json(['product' => $response]);
    }

    public function transferDetail($transfer)
    {
        $transfer = Transfer::find($transfer);
        return view('modules.commons.transfer-detail', ['transfer' => $transfer]);
    }
}
