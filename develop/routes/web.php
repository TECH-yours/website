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
    $restaurants = Restaurant::getAll();
    $categories = ['中式料理', '日式料理', '美式料理', '義式料理', '韓式料理', '泰式料理', '素食料理', '其他'];
    return view('pages.restaurant', ['restaurants' => $restaurants, 'categories' => $categories]);
    // return view('pages.index');
});

Route::get('/restaurants', function () {
    $restaurants = Restaurant::getAll();
    $categories = ['中式料理', '日式料理', '美式料理', '義式料理', '韓式料理', '泰式料理', '素食料理', '其他'];
    return view('pages.restaurant', ['restaurants' => $restaurants, 'categories' => $categories]);
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

Route::get('/line/signin', function () {
    return redirect('https://access.line.me/oauth2/v2.1/authorize?response_type=code&client_id=' . env('LINE_CLIENT_ID') . '&redirect_uri='. env('APP_URL') .'/signin&bot_prompt=aggressive&state=' . env('LINE_STATE') . '&scope=profile%20openid%20email');
});

use App\Http\Controllers\UserController;
Route::get('/signin', [UserController::class, 'signin'])->name('signin');

Route::get('/user', function () {
    return view('pages.user.index');
})->name('user');

Route::get('/user/profile', function () {
    return view('pages.user.profile');
})->name('profile');

