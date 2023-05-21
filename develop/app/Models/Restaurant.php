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
}
