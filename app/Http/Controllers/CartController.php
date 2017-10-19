<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;

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

    public function index()
    {
        $this->authorize('viewIndex', Cart::class);
        return Cart::with('menu_items')->get();
    }

    public function show($id)
    {
        $cart = Cart::find($id)->with('menu_items')->first();
        $this->authorize('view', $cart);
        return $cart;
    }

    public function store(Request $request)
    {
        $cart = Cart::create(['user_id' => auth()->id()]);
        $cart->menu_items()->attach($request->menu_items);
        return response()->json($cart, 201);
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $this->authorize('update', $cart);
        $cart->update($request->all());

        return response()->json($cart, 200);
    }

    public function destroy(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $this->authorize('delete', $cart);
        $cart->delete();

        return response()->json(null, 204);
    }
}
