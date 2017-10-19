<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
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

    public function index()
    {
        $this->authorize('viewIndex', Order::class);
        return Order::with('menu_items')->get();
    }

    public function show($id)
    {
        $order = Order::findOrFail($id)->with('menu_items')->first();
        $this->authorize('view', $order);
        return $order;
    }

    public function store(Request $request)
    {
        $order = Order::create(['user_id' => auth()->id()]);
        $order->menu_items()->attach($request->menu_items);
        return response()->json($order, 201);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $this->authorize('update', $order);
        $order->update($request->all());

        return response()->json($order, 200);
    }

    public function destroy(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $this->authorize('delete', $order);
        $order->delete();

        return response()->json(null, 204);
    }
}
