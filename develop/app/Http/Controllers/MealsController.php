<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meals;
use App\Models\Allgericlist;

class MealsController extends Controller
{
    // get meals by restaurant id
    public function getMealsByRestaurantId($id)
    {
        $meals = Meals::where('rid', $id)
            -> join ('restaurant', 'meals.rid', '=', 'restaurant.id')
            -> join ('ref_category', 'meals.category', '=', 'ref_category.id')
            -> select ( 'restaurant.name as restaurant_name',
                        'ref_category.name as category_name',
                        'meals.id', 'meals.name', 'meals.price')
            -> get();

        foreach ($meals as $meal) {
            $meal->allergies = 
                Allgericlist::where('mid', $meal->id)
                    -> join('ref_allergic', 'allgericlist.aid', '=', 'ref_allergic.id')
                    -> select('ref_allergic.id', 'ref_allergic.name')
                    -> get();
        }
        $returnMeals = $meals->shuffle();
        return $returnMeals;
    }

    // store
    public function store(Request $request)
    {
        $data = $request->all();
        $meal = Meals::store($data);
        return $meal;
    }

    // update
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $meal = Meals::updatebyId($data, $id);
        return $meal;
    }

    // get all
    public function getAll()
    {
        $meals = Meals::getAll();
        return response()->json([
            'data' => $meals
        ], 200);
    }

    // get getMealsById
    public function getMealsById($id)
    {
        $meal = Meals::where('id', $id)->first();
        if (!$meal) {
            return response()->json([
                'message' => 'Meal not found'
            ], 404);
        }
        $meal->allergies = 
            Allgericlist::where('mid', $meal->id)
                -> join('ref_allergic', 'allgericlist.aid', '=', 'ref_allergic.id')
                -> select('ref_allergic.id', 'ref_allergic.name')
                -> get();
        return response()->json([
            'data' => $meal
        ], 200);
    }

    // delete
    public function delete($id)
    {
        $meal = Meals::deletebyId($id);
        return response()->json([
            'data' => $meal
        ], 200);
    }
}

