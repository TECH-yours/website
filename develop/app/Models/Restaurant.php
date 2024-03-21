<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Ramsey\Uuid\Uuid;

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
        $restaurant->area = $data['area'];
        $restaurant->address = $data['address'];
        $restaurant->tel = $data['tel'];
        $restaurant->email = $data['email'];
        $restaurant->lat = $data['lat'];
        $restaurant->lng = $data['lng'];
        $restaurant->google_map_url = $data['google_map_url'];
        // $restaurant->thumbnailImageUrl = $data['thumbnailImageUrl'];
        $restaurant->save();
        return $restaurant->id;
    }

    // update
    public static function updatebyId($data, $id)
    {
        $restaurant = Restaurant::where('id', $id)->first();
        if (!$restaurant) {
            return null;
        }
        $restaurant->name = $data['name'];
        $restaurant->area = $data['area'];
        $restaurant->address = $data['address'];
        $restaurant->lat = $data['lat'];
        $restaurant->lng = $data['lng'];
        $restaurant->google_map_url = $data['google_map_url'];
        $restaurant->tel = $data['tel'];
        $restaurant->email = $data['email'];
        // $restaurant->thumbnailImageUrl = $data['thumbnailImageUrl'];
        $restaurant->save();
        return $restaurant->id;
    }

    // get all
    public static function getAll()
    {
        $restaurants = Restaurant::all()->orderBy('restaurant.id', 'desc');
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

    // get getRestaurantById
    public static function getRestaurantById($id)
    {
        $restaurant = Restaurant::where('id', $id)->first();
        if (!$restaurant) {
            return null;
        }
        $restaurant->meals = Meals::where('rid', $restaurant->id)
            ->join('restaurant', 'meals.rid', '=', 'restaurant.id')
            ->join('ref_category', 'meals.category', '=', 'ref_category.id')
            ->select('restaurant.name as restaurant_name', 'ref_category.name as category_name', 'meals.id', 'meals.name', 'meals.price')
            ->get();
        $restaurant->meals_count = ($restaurant->meals) ? count($restaurant->meals) : 0;
        return $restaurant;
    }

    // deleteById
    public static function deleteById($id)
    {
        $restaurant = Restaurant::where('id', $id)->first();
        if (!$restaurant) {
            return null;
        }
        $restaurant->delete();
        return $restaurant->id;
    }

    // saveThumbnail
    public static function saveThumbnail($id, $data)
    {
        $restaurant = Restaurant::where('id', $id)->first();
        $filename = null;
        
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $oldFile = $restaurant->thumbnailImageUrl;
            
            if ($oldFile && $oldFile != 'logo_test.png') {
                if (file_exists(public_path('images/restaurant/' . $oldFile)))
                    unlink(public_path('images/restaurant/' . $oldFile));
            }
            
            $file = $data['image'];
            $filename = Uuid::uuid4() . '.' . $file->extension();
            $file->move(public_path('images/restaurant'), $filename);
            
            $restaurant['thumbnailImageUrl'] = "restaurant/" . $filename;
        }
        
        $restaurant->save();
        return $filename;
    }


    // unlink($_SERVER['DOCUMENT_ROOT']."/upload/Image/".$row->uuid_name);

}
