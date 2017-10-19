<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;

class RestaurantController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->only(['store', 'update', 'destroy']);
    }

    public function index()
    {
        return Restaurant::all();
    }

    public function show($id)
    {
        return Restaurant::findOrFail($id)->with('menu_items')->first();
    }

    public function store(Request $request)
    {
        $this->authorize('create', Restaurant::class);
        $restaurant = Restaurant::create($request->all());

        return response()->json($restaurant, 201);
    }

    public function update(Request $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $this->authorize('update', $restaurant);
        $restaurant->update($request->all());

        return response()->json($restaurant, 200);
    }

    public function destroy(Request $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $this->authorize('delete', $restaurant);
        $restaurant->delete();

        return response()->json(null, 204);
    }
}
