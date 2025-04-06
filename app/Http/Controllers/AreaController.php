<?php

namespace App\Http\Controllers;

use App\Models\Area;

class AreaController extends Controller
{
    public function getByCity($city_id)
    {
        $areas = Area::where('city_id', $city_id)->get();

        return response()->json($areas);
    }
}
