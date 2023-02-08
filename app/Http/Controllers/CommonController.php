<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
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
}
