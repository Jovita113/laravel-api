<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
        return $restaurants;
    }

    public function store(Request $request)
    {
        $restaurant = new Restaurant();
        $restaurant->title = $request->title;
        $restaurant->code = $request->code;
        $restaurant->adress = $request->adress;

        $restaurant->save();
    }

    public function show($id)
    {
        $restaurant = Restaurant::find($id);
        return $restaurant;
    }

    public function update(Request $request, $id)
    {
        $restaurant = Restaurant::findOrFail($request->id);
        $restaurant->title = $request->title;
        $restaurant->code = $request->code;
        $restaurant->adress = $request->adress;

        $restaurant->save();
        return $restaurant;
    }

    public function destroy($id)
    {
        $restaurant = Restaurant::destroy($id);
        return $restaurant;
    }
}
