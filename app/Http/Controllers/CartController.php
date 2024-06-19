<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;

class CartController extends Controller
{
    public function index()
    {
        $cart = Auth::user()->cart;
        if (!$cart) {
            $cart = new Cart(['user_id' => Auth::id()]);
            $cart->save();
        }

        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer',
        ]);

        $cart = Auth::user()->cart;
        if (!$cart) {
            $cart = new Cart(['user_id' => Auth::id()]);
            $cart->save();
        }

        $cartItem = $cart->cartItems()->where('product_id', $product->id)->first();
        if($cartItem) {
            $cartItem->quantity += $request->quantity;
        }else{
            $cartItem = new CartItem([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }

        $cartItem->save();

        return redirect()->route('cart.index');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer',
        ]);

        $cartItem->update(['quantity' => $request->quantity]);
        return redirect()->route('cart.index');
    }

    public function remove(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->route('cart.index');
    }
}
