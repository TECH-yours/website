<?php

use Illuminate\Support\Facades\Route;

use App\Models\Restaurant;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('pages.index');
});

Route::get('/restaurants', function () {
    $restaurants = Restaurant::getAll();
    return view('pages.restaurant', ['restaurants' => $restaurants]);
});

Route::get('/restaurant/{id}/menu', function ($id) {
    $restaurant = Restaurant::getRestaurantById($id);
    // $meals = Restaurant::getMealsByI。d($id);
    return view('pages.menu', ['restaurant' => $restaurant, 'meals' => $restaurant->meals]);
});

Route::prefix('admin')->group(function () {
	Route::get('/login',		function () { return view('pages.admin.login'); })->name('login');
	Route::get('/restaurant',	function () { return view('pages.admin.restaurant'); })->name('restaurant');
});
