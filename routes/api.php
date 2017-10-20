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
Route::post('restaurants/{restaurant_id}/area/{area_id}', 'RestaurantController@storeArea');
Route::delete('restaurants/{restaurant_id}/area/{area_id}', 'RestaurantController@deleteArea');
// Area's Routes
Route::resource('areas', 'AreaController',
                ['except' => ['create', 'edit']]);


// Menus Routes
Route::post('restaurants/{restaurant_id}/menu/items', 'MenuController@store');
Route::put('restaurants/{restaurant_id}/menu/items/{item_id}', 'MenuController@update');
Route::delete('restaurants/{restaurant_id}/menu/items/{item_id}', 'MenuController@destroy');

// Order Routes
Route::resource('orders', 'OrderController',
                ['except' => ['create', 'edit']]);
Route::post('orders/{id}', 'OrderController@submit');
Route::put('orders/{order_id}/items/{item_id}', 'OrderController@updateItem');
Route::delete('orders/{order_id}/items/{item_id}', 'OrderController@deleteItem');

// Cart Routes
Route::get('users/{user_id}/cart', 'CartController@show');
Route::post('users/{user_id}/cart/items', 'CartController@storeItem');
Route::post('users/{user_id}/cart/checkout', 'CartController@checkout');
Route::post('users/{user_id}/cart/empty', 'CartController@empty');
Route::put('users/{user_id}/cart', 'CartController@update');
Route::put('users/{user_id}/cart/items/{item_id}', 'CartController@updateItem');
Route::delete('users/{user_id}/cart/items/{item_id}', 'CartController@deleteItem');
