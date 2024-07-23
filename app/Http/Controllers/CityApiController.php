<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityApiController extends Controller
{
    //
    public function index()
    {
        $cities = City::with('images')->get();
        return response()->json($cities);
    }


    public function show($city_id)
    {
        $city = City::with('images')->find($city_id);

        if (!$city) {
            return response()->json(['error' => 'City not found'], 404);
        }

        return response()->json($city);
    }
}
