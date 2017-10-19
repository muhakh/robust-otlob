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
        return Cart::with('menu_items')->get();
    }

    public function show($id)
    {
        return Cart::find($id)->with('menu_items')->get();
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
        $cart->update($request->all());

        return response()->json($cart, 200);
    }

    public function destroy(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();

        return response()->json(null, 204);
    }
}
