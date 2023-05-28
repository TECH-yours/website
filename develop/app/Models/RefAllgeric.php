<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefAllgeric extends Model
{
    use HasFactory;

    protected $table = 'ref_allergic';

    // get all
    public static function getAll()
    {
        return RefAllgeric::all();
    }   
}
