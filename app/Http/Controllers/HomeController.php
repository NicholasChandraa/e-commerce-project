<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function main()
    {
        return view('users.main');
    }
    public function index(Request $request)
    {
        $query = Product::query();
        $cart = Auth::user()->cart;
        // Filter berdasarkan kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('category')) {
            $query->whereIn('category_id', $request->category);
        }

        // Pencarian Produk
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%')
                ->orWhere('price', 'like', '%' . $request->search . '%');
            });
        }

         // Filter berdasarkan rentang harga
         if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Pagination
        $products = $query->paginate(15);
        $categories = Category::all();

        if ($request->ajax()) {
            $hasMorePages = $products->hasMorePages();
            return response()->json([
                'products' => view('partials.products', compact('products'))->render(),
                'total' => $products->total(),
                'hasMorePages' => $hasMorePages
            ]);
        }            

        return view('users.home', compact('products', 'categories', 'cart'));
    }
}
