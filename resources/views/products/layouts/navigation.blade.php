<!-- Navigation -->
<nav class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="text-xl font-bold text-gray-800">
            <a href="/products">Manajemen Produk</a>
        </div>
        <div class="flex space-x-4 items-center">
            <a href="{{ route('products.create') }}" class="text-gray-600 hover:text-gray-800 border-r pr-4 lg:pr-6">Buat
                Produk</a>
            <a href="{{ route('categories.index') }}"
                class="text-gray-600 hover:text-gray-800 border-r pr-4 lg:pr-6">Halaman
                Kategori</a>
            <a href="/" class="text-gray-600 hover:text-gray-800">Home</a>
        </div>
    </div>
</nav>
