<?php

use Illuminate\Http\Request;
use App\Resaurant;

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

Route::get('restaurants', 'RestaurantController@index');
Route::get('restaurants/{id}', 'RestaurantController@display');
Route::post('restaurants', 'RestaurantController@create');
Route::put('restaurants/{id}', 'RestaurantController@update');
Route::delete('restaurants/{id}', 'RestaurantController@delete');
