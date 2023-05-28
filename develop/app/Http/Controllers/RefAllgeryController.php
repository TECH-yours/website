<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RefAllergic;

class RefAllgeryController extends Controller
{
    //

    // get all
    public function getAll()
    {
        $ref_allergic = RefAllergic::getAll();
        return response()->json([
            'data' => $ref_allergic
        ], 200);
    }
}
