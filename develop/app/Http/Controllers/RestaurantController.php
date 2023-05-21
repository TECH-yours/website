<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    // get top5 closest restaurants
    public function  getRestaurant(Request $request)
    {
        $restaurants = Restaurant::getTop5ClosestRestaurants($request->lat, $request->lng);
        
        return $restaurants;
    }
}
