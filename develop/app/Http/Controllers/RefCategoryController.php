<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RefCategory;

class RefCategoryController extends Controller
{
    // get all
    public function getAll()
    {
        $ref_category = RefCategory::getAll();
        return response()->json([
            'data' => $ref_category
        ], 200);
    }
}
