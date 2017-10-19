<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuItem;

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

    public function store(Request $request)
    {
        $this->authorize('create', $request->manager_id, MenuItem::class);
        $menu = MenuItem::create($request->all());
        return response()->json($menu, 201);
    }

    public function update(Request $request, $id)
    {
        $menu = MenuItem::findOrFail($id);
        $this->authorize('update', $menu);
        $menu->update($request->all());

        return response()->json($menu, 200);
    }

    public function destroy(Request $request, $id)
    {
        $menu = MenuItem::findOrFail($id);
        $this->authorize('update', $menu);
        $menu->delete();

        return response()->json(null, 204);
    }

}
