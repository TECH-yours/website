<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Allgericlist;


class Meals extends Model
{
    use HasFactory;
    
    protected $table = 'meals';

    public function allgericlist(){
        return $this->hasMany('App\Models\Allgericlist', 'mid', 'id');
    }

    // store
    public static function store($data){
        $meals = new Meals;
        $meals->rid = $data['restaurant_id'];
        $meals->name = $data['name'];
        $meals->price = $data['price'];
        $meals->category = $data['category'];
        $meals->description = $data['description'];
        $meals->calorie = intval($data['calorie']);
        $meals->save();
        return $meals->id;
    }

    // get all
    public static function getAll(){
        return Meals::all();
    }

    //updatebyId
    public static function updatebyId($data, $id){
        $meals = Meals::find($id);
        $meals->rid = $data['restaurant_id'];
        $meals->name = $data['name'];
        $meals->price = $data['price'];
        $meals->category = $data['category'];
        $meals->description = $data['description'];
        $meals->calorie = intval($data['calorie']);
        $meals->save();
        return $meals;
    }

    //deletebyId
    public static function deletebyId($id){
        $meals = Meals::find($id)->delete();
        return $meals;
    }

    //deleteByRid
    public static function deleteByRid($rid){
        $meals = Meals::where('rid', $rid)->delete();
        return $meals;
    }

}