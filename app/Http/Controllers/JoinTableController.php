<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class JoinTableController extends Controller
{
    function index()
    {
    	$data = Restaurant::join('restaurant', 'restaurant.meniu_id', '=', 'menius.id')
              		->join('dishes', 'dishes.meniu_id', '=', 'menius.id')
              		->get(['restaurant.title', 'menius.name', 'dishes.dishes_name']);

        return view('join_table', compact('data'));
    }
}
