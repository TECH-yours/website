<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LineBotController;
use App\Http\Controllers\MealsController;
use App\Http\Controllers\RestaurantController;

// class LineMessageController extends Controller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request)
{
    return $request->user();
});

Route::any('/callback',  [LineBotController::class, 'callback']);

// Route::get('/restaurants', [RestaurantController::class, 'getRestaurants']);

// get meals by restaurant id
Route::get('/{id}/meals', [MealsController::class, 'getMealsByRestaurantId']);

// meal group
Route::prefix('meals')->group(function () {
    Route::post('/create',                  [MealsController::class, 'create']);
    Route::get('/list',                     [MealsController::class, 'getAll']);
});

Route::prefix('restaurant')->group(function () {
    Route::post('/create',                  [RestaurantController::class, 'create']);
    Route::get('/list',                     [RestaurantController::class, 'getAll']);
});


Route::prefix('admin')->group(function () {
    Route::get('/list/restaurant',          [RestaurantController::class, 'getAdminList']);
    Route::get('/list',                     [RestaurantController::class, 'getAll']);
});

Route::get('/meals', [MealsController::class, 'getMeals']);