<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefCategory extends Model
{
    use HasFactory;

    protected $table = 'ref_category';

    // get all
    public static function getAll()
    {
        return RefCategory::all();
    }
}
