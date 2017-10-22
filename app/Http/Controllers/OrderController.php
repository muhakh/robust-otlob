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
        $order = Order::with('menu_items')->findOrFail($id);
        $this->authorize('view', $order);

        return $order;
    }

    public function store(Request $request)
    {
        $order = Order::create(['user_id' => auth()->id(),
                                'shipping_address' => $request->shipping_address]);

        foreach ($request->menu_items as $key => $item_id)
        {
            $order->menu_items()->attach($item_id, ['quantity'=>$request->quantity[$key]]);
        }

        return response()->json($order, 201);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $this->authorize('update', $order);

        $shipping_address = $request->shipping_address != NULL ? $request->shipping_address : $order->shipping_address;
        $order->update(['shipping_address' => $shipping_address]);

        if (!empty($request->menu_items))
        {
            foreach ($request->menu_items as $key => $item_id)
            {
                $order->menu_items()->updateExistingPivot($item_id, ['quantity'=>$request->quantity[$key]]);
            }
        }

        return response()->json($order, 200);
    }

    public function destroy(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $this->authorize('delete', $order);
        $order->delete();

        return response()->json(null, 204);
    }

    public function updateItem(Request $request, $order_id, $item_id)
    {
        $order = Order::findOrFail($order_id);
        $this->authorize('update', $order);

        $order->menu_items()->updateExistingPivot($item_id, ['quantity'=>$request->quantity]);

        return response()->json($order, 200);
    }

    public function deleteItem(Request $request, $order_id, $item_id)
    {
        $order = Order::findOrFail($order_id);
        $this->authorize('delete', $order);

        $order->menu_items()->detach($item_id);

        return response()->json(null, 204);
    }

    public function submit($order_id)
    {
        $order = Order::findOrFail($order_id);
        $this->authorize('update', $order);
        $order->is_submitted = 1;
        $order->save();

        return response()->json($order, 200);
    }
}
