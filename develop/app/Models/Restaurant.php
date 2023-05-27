<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Restaurant extends Model
{
    use HasFactory;

    protected $table = 'restaurant';

    public static function getTop5ClosestRestaurants($lat, $lng)
    {
        $restaurants = DB::select(
            "SELECT id, name, address, lat, lng, google_map_url, thumbnailImageUrl, SQRT(POW(69.1 * (lat - $lat), 2) + POW(69.1 * ($lng - lng) * COS(lat / 57.3), 2)) AS distance
            FROM restaurant
            ORDER BY distance
            -- LIMIT 5
            "
        );

        return $restaurants;
    }

    // store
    public static function store($data)
    {
        $restaurant = new Restaurant;
        $restaurant->name = $data['name'];
        $restaurant->address = $data['address'];
        $restaurant->lat = $data['lat'];
        $restaurant->lng = $data['lng'];
        $restaurant->google_map_url = $data['google_map_url'];
        // $restaurant->thumbnailImageUrl = $data['thumbnailImageUrl'];
        $restaurant->save();
        return $restaurant->id;
    }

    // get all
    public static function getAll()
    {
        $restaurants = Restaurant::all();
        foreach ($restaurants as $restaurant) {
            $restaurant->meals = Meals::where('rid', $restaurant->id)
                ->join('restaurant', 'meals.rid', '=', 'restaurant.id')
                ->join('ref_category', 'meals.category', '=', 'ref_category.id')
                ->select('restaurant.name as restaurant_name', 'ref_category.name as category_name', 'meals.id', 'meals.name', 'meals.price')
                ->get();
            $restaurant->meals_count = ($restaurant->meals) ? count($restaurant->meals) : 0;
        }
        return $restaurants;
    }
}
