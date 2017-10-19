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
Route::get('restaurants', 'RestaurantController@index');
Route::get('restaurants/{id}', 'RestaurantController@display');
Route::post('restaurants', 'RestaurantController@create');
Route::put('restaurants/{id}', 'RestaurantController@update');
Route::delete('restaurants/{id}', 'RestaurantController@delete');

// Menus Routes
Route::get('restaurants/{id}/menu/items/{id}', 'MenuController@display');
Route::post('restaurants/{id}/menu/items', 'MenuController@create');
Route::put('restaurants/{id}/menu/items/{id}', 'MenuController@update');
Route::delete('restaurants/{id}/menu/items/{id}', 'MenuController@delete');
