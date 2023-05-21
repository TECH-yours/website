<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Meals;

class Allgericlist extends Model
{
    use HasFactory;

    protected $table = 'allgericlist';

    public function meals(){
        return $this->belongsTo('App\Modles\Meals', 'mid', 'id');
    }
}
