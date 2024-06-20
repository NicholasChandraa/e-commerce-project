<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-8 px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Products</h1>
            <form method="GET" action="{{ url('/products') }}">
            <div>
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="search">Search</label>
                <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search products...">
                <button type="submit">Search</button>
            </div>
        </form>
            <div>
                <a href="{{ route('categories.index') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200">Category</a>
                <a href="{{ route('home') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200">Home</a>
                <a href="{{ route('products.create') }}" class="bg-purple-600 text-white py-2 px-4 rounded hover:bg-purple-700 transition duration-200">Create Product</a>
            </div>
        </div>
        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">Name</th>
                        <th class="py-3 px-4 text-left">Category</th>
                        <th class="py-3 px-4 text-left">Description</th>
                        <th class="py-3 px-4 text-left">Price</th>
                        <th class="py-3 px-4 text-left">Stock</th>
                        <th class="py-3 px-4 text-left">Image</th>
                        <th class="py-3 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($products as $product)
                    <tr class="border-b">
                        <td class="py-3 px-4">{{ $product->name }}</td>
                        <td>{{ $product->category ? $product->category->name : 'Uncategorized' }}</td>
                        <td class="py-3 px-4">{{ $product->description }}</td>
                        <td class="py-3 px-4">{{ $product->price }}</td>
                        <td class="py-3 px-4">{{ $product->stock }}</td>
                        <td class="py-3 px-4">
                            @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 object-cover rounded">
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            <a href="{{ route('products.show', $product->id) }}" class="text-blue-500 hover:underline">View</a>
                            <a href="{{ route('products.edit', $product->id) }}" class="text-yellow-500 hover:underline ml-2">Edit</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @vite('resources/js/app.js')
</body>

</html>