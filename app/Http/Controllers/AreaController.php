<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;

class AreaController extends Controller
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
        return Area::all();
    }

    public function show($id)
    {
        $area = Area::with('restaurants')->findOrFail($id);
        $this->authorize('view', $area);

        return $area;
    }

    public function store(Request $request)
    {
        $this->authorize('create', Area::class);
        $area = Area::create($request->all());

        return response()->json($area, 201);
    }

    public function update(Request $request, $id)
    {
        $area = Area::findOrFail($id);
        $this->authorize('update', $area);
        $area->update($request->all());

        return response()->json($area, 200);
    }

    public function destroy(Request $request, $id)
    {
        $area = Area::findOrFail($id);
        $this->authorize('delete', $area);
        $area->delete();

        return response()->json(null, 204);
    }
}
