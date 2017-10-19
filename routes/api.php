<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Restaurant's Routes
Route::resource('restaurants', 'RestaurantController',
                ['except' => ['create', 'edit']]);

// Menus Routes
Route::post('restaurants/{restaurant_id}/menu/items', 'MenuController@store');
Route::put('restaurants/{restaurant_id}/menu/items/{item_id}', 'MenuController@update');
Route::delete('restaurants/{restaurant_id}/menu/items/{item_id}', 'MenuController@destroy');

// Order Routes
Route::resource('orders', 'OrderController',
                ['except' => ['create', 'edit']]);

// Cart Routes
Route::resource('carts', 'CartController',
                ['except' => ['create', 'edit']]);
