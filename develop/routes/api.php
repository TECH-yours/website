<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LineBotController;
use App\Http\Controllers\MealsController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\RefCategoryController;
use App\Http\Controllers\RefAllergicController;

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
    Route::post('/create',                  [MealsController::class, 'store']);
    Route::get('/{id}',                     [MealsController::class, 'getMealsById']);
    Route::put('/{id}',                     [MealsController::class, 'update']);
    Route::delete('/{id}',                  [MealsController::class, 'delete']);
    Route::get('/list',                     [MealsController::class, 'getAll']);
});

Route::prefix('restaurant')->group(function () {
    Route::post('/create',                  [RestaurantController::class, 'store']);
    Route::get('/{id}',                     [RestaurantController::class, 'getRestaurantById']);
    Route::put('/{id}',                     [RestaurantController::class, 'update']);
    Route::delete('/{id}',                  [RestaurantController::class, 'delete']);
    Route::get('/list',                     [RestaurantController::class, 'getAll']);
    Route::post('/{id}/thumbnail',          [RestaurantController::class, 'thumbnail']);
});


Route::prefix('category')->group(function () {
    // Route::post('/create',                  [RestaurantController::class, 'store']);
    // Route::get('/{id}',                     [RestaurantController::class, 'getRestaurantById']);
    // Route::put('/{id}',                     [RestaurantController::class, 'update']);
    Route::get('/list',                     [RefCategoryController::class, 'getAll']);
});


Route::prefix('allgery')->group(function () {
    // Route::post('/create',                  [RestaurantController::class, 'store']);
    // Route::get('/{id}',                     [RestaurantController::class, 'getRestaurantById']);
    // Route::put('/{id}',                     [RestaurantController::class, 'update']);
    Route::get('/list',                     [RefAllergicController::class, 'getAll']);
});


Route::prefix('admin')->group(function () {
    Route::get('/list/restaurant',          [RestaurantController::class, 'getAdminList']);
    Route::get('/list',                     [RestaurantController::class, 'getAll']);
});

Route::get('/meals', [MealsController::class, 'getMeals']);


use App\Http\Controllers\UserController;
Route::middleware('auth:sanctum')->group(function () {

    // use preflix
    Route::get('/user', [UserController::class, 'show']); // Get user's profile
    Route::put('/user', [UserController::class, 'update']); // Update user's profile

    Route::get('/points', [UserPointsController::class, 'index']); // Get user's points
});