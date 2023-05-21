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

}