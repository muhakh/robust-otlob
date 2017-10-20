<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Order;

class CartController extends Controller
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

    public function show($user_id)
    {
        $cart = Cart::with('menu_items')->findOrFail($user_id);
        $this->authorize('view', $cart);

        return $cart;
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($user_id);
        $this->authorize('update', $cart);

        $shipping_address = $request->shipping_address != NULL ? $request->shipping_address : $cart->shipping_address;
        $cart->update(['shipping_address' => $shipping_address]);

        if (!empty($request->menu_items))
        {
            foreach ($request->menu_items as $key => $item_id)
            {
                $cart->menu_items()->updateExistingPivot($item_id, ['quantity'=>$request->quantity[$key]]);
            }
        }

        return response()->json($cart, 200);
    }

    public function updateItem(Request $request, $cart_id, $item_id)
    {
        $cart = Cart::findOrFail($cart_id);
        $this->authorize('update', $cart);

        $cart->menu_items()->updateExistingPivot($item_id, ['quantity'=>$request->quantity]);

        return response()->json($cart, 200);
    }

    public function deleteItem(Request $request, $cart_id, $item_id)
    {
        $cart = Cart::findOrFail($cart_id);
        $this->authorize('delete', $cart);

        $cart->menu_items()->detach($item_id);

        return response()->json(null, 204);
    }

    public function storeItem(Request $request, $user_id, $item_id)
    {
        $cart = Cart::findOrFail($user_id);
        $cart->menu_items()->attach($item_id, ['quantity'=>$request->quantity]);

        return response()->json($cart, 201);
    }

    public function checkout(Request $request, $user_id)
    {
        $cart = Cart::with('menu_items')->findOrFail($user_id);
        $this->authorize('update', $cart);
        $menu_items_ids = $cart->menu_items->pluck('id')->toArray();
        $quantities     = $cart->menu_items->pluck('quantity')->toArray();

        $order = Order::create(['user_id' => auth()->id(),
                                'shipping_address' => '']);

        foreach ($menu_items_ids as $key => $item_id)
        {
            $order->menu_items()->attach($item_id, ['quantity'=>$quantities[$key]]);
        }

        return response()->json($order, 201);
    }
}
