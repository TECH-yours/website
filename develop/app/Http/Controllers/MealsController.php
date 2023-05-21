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

        return $meals;
    }
}

