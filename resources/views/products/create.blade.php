<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Product</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen p-5">
        <div class="bg-white shadow-md rounded-lg p-5 w-full max-w-3xl">
            <h1 class="text-3xl font-bold mb-6 text-center">Create Product</h1>
            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-semibold">Name</label>
                    <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded mt-2 focus:outline-none focus:ring-2 focus:ring-purple-600" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-semibold">Description</label>
                    <textarea id="description" name="description" rows="4" class="w-full p-2 border border-gray-300 rounded mt-2 focus:outline-none focus:ring-2 focus:ring-purple-600" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-semibold">Price</label>
                    <input type="text" id="price" name="price" class="w-full p-2 border border-gray-300 rounded mt-2 focus:outline-none focus:ring-2 focus:ring-purple-600" required>
                </div>
                <div class="mb-4">
                    <label for="stock" class="block text-gray-700 font-semibold">Stock</label>
                    <input type="text" id="stock" name="stock" class="w-full p-2 border border-gray-300 rounded mt-2 focus:outline-none focus:ring-2 focus:ring-purple-600" required>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-semibold">Image</label>
                    <input type="file" id="image" name="image" class="w-full p-2 border border-gray-300 rounded mt-2 focus:outline-none focus:ring-2 focus:ring-purple-600">
                </div>
                <div class="flex justify-center">
                    <button type="submit" class="bg-purple-600 text-white py-2 px-4 rounded hover:bg-purple-700 transition duration-200">Create</button>
                </div>
            </form>
        </div>
    </div>
    @vite('resources/js/app.js')
</body>

</html>