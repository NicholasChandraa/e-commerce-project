<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $sortableColumns = ['name', 'category_id', 'price', 'stock', 'created_at'];
        $sort_by = $request->get('sort_by', 'name');
        $sort_order = $request->get('sort_order', 'asc');

        if (in_array($sort_by, $sortableColumns)) {
            $query->orderBy($sort_by, $sort_order);
        }

        $products = $query->paginate(10);

        $categories = Category::all();

        return view('products.index', compact('products', 'categories', 'sort_by', 'sort_order'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);

        $product = new Product($request->all()); //all() mengubah hasil $request ke bentuk array asosiatif

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        session()->flash('success', 'Produk berhasil dibuat.');

        return redirect()->route('products.index');
    }

    public function show(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Ambil produk dengan kategori yang sama, kecuali produk yang sedang dilihat
        $similarProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(3)
            ->get();

        $products = Product::query();
        $cart = Auth::user()->cart;

        if ($request->ajax()) {
            $hasMorePages = $products->hasMorePages();
            return response()->json([
                'products' => view('partials.products', compact('products'))->render(),
                'total' => $products->total(),
                'hasMorePages' => $hasMorePages
            ]);
        }

        return view('products.show', compact('product', 'products', 'similarProducts', 'cart'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp',
        ]);

        $product = Product::findOrFail($id);
        $product->fill($request->except('image'));

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('products.edit', $product->id)->with('success', 'Produk berhasil diupdate.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        session()->flash('success', 'Produk berhasil dihapus.');

        return redirect()->route('products.index');
    }
}
