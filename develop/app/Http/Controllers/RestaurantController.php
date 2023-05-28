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

    // store
    public function store(Request $request)
    {
        $data = $request->all();
        $restaurant = Restaurant::store($data);
        return $restaurant;
    }

    // update
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $restaurant = Restaurant::updatebyId($data, $id);
        return $restaurant;
    }

    // get all
    public function getAll()
    {
        $restaurants = Restaurant::getAll();
        return response()->json([
            'data' => $restaurants
        ], 200);
    }

    // get getAdminList
    public function getAdminList()
    {
        $restaurants = Restaurant::getAll();
        foreach($restaurants as $restaurant)
        {
            $restaurant->meals_count = "<input type='number' value='" . $restaurant->meals_count . "' style='width: 80px; text-align: center;' disabled>";
            // $restaurant->meals_count .= " <button class='btn btn-info view-meals' data-id=" . $restaurant->id . "> 查看餐點 </button>";
            $restaurant->operation =  "<button class='btn btn-secondary edit-btn' data-id=" . $restaurant->id . "> <i class='fas fa-cogs'></i> </button>";
            // $restaurant->operation .= "&ensp;<button class='btn btn-danger delete-btn' data-id=" . $restaurant->id . "> <i class='fas fa-solid fa-trash'></i> </button>";
        }
        return response()->json([
            'data' => $restaurants
        ], 200);
    }

    // get getRestaurantById
    public function getRestaurantById($id)
    {
        $restaurant = Restaurant::getRestaurantById($id);
        return response()->json([
            'data' => $restaurant
        ], 200);
    }
}
