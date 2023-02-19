<?php

namespace App\Http\Controllers;

use App\Tools\DniRuc;
use App\Models\District;
use App\Models\Province;
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

    public function getBussiness(Request $request)
    {
        $bussines = DniRuc::getData('RUC', $request->ruc);
        $name = gettype($bussines) == 'object'
            ? "{$bussines->razonSocial}"
            : null;

        return response()->json(['name' => $name ]);
    }
}
