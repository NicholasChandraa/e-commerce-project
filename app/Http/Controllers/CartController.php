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
        $cart = Auth::user()->cart;
        if (!$cart) {
            $cart = new Cart(['user_id' => Auth::id()]);
            $cart->save();
        }

        $cartItem = $cart->cartItems()->where('product_id', $product->id)->first();
    }
}
