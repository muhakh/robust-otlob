<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuItem;
use App\Restaurant;

class MenuController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function store(Request $request, $restaurant_id)
    {
        $restaurant = Restaurant::findOrFail($restaurant_id);
        $this->authorize('create', $restaurant, MenuItem::class);
        $data = $request->all();
        $data['restaurant_id'] = $restaurant_id;
        $menu = MenuItem::create($data);
        return response()->json($menu, 201);
    }

    public function update(Request $request, $restaurant_id, $item_id)
    {
        $menu = MenuItem::findOrFail($item_id);
        $this->authorize('update', $menu);
        $data = $request->all();
        $data['restaurant_id'] = $restaurant_id;
        $menu->update($data);

        return response()->json($menu, 200);
    }

    public function destroy(Request $request, $restaurant_id, $item_id)
    {
        $menu = MenuItem::findOrFail($item_id);
        $this->authorize('delete', $menu);
        $menu->delete();

        return response()->json(null, 204);
    }

}
