<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    @vite('resources/css/app.css')
    <style>
        .scroll-smooth::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>

<body class="bg-white">
    <div class="container mx-auto py-8 px-4">

        <!-- NAVIGASI -->
        <nav class="bg-white shadow-md rounded-lg py-3 sm:p-4 mb-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/njs-logo.png') }}" alt="Logo" class="w-0 h-0 lg:w-14 lg:h-8">
                <h1 class=" text-[0px]  md:text-md sm:text-base lg:text-2xl font-bold">Welcome, {{ Auth::user()->name }}</h1>
            </div>
            <ul class="hidden md:flex space-x-4">
                <li><a href="{{ route('home') }}" class="lg:text-lg text-blue-500 lg:hover:text-white lg:hover:bg-blue-500 lg:py-3 lg:px-4 rounded-lg transition duration-200 font-bold lg:mr-6">Home</a></li>
                <li>
                    <form method="GET" action="{{ url('/home') }}" class="flex">
                        <input type="text" id="search" name="search" value="{{ request('search') }}" class="p-2 border border-gray-300 rounded-l focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Search products...">
                        <button type="submit" class="bg-blue-500 text-white p-2 rounded-r hover:bg-blue-600 transition duration-200">Search</button>
                    </form>
                </li>
                <li><a href="{{ url('/cart') }}" class="lg:text-lg text-blue-500 lg:hover:text-white lg:hover:bg-blue-500 lg:py-3 lg:px-4 rounded-lg transition duration-200 font-bold lg:mr-6">Keranjang (<span id="cart-count">{{ $cart->cartItems->count() ?? 0 }}</span>)
                    </a></li>
            </ul>
            <div class="flex items-center space-x-4 relative">
                @if(Auth::user()->profile_photo)
                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}" class="w-10 h-10 md:w-14 md:h-14 rounded-full object-cover cursor-pointer" onclick="toggleMenu()">
                @endif
                <button class="flex items-center text-gray-600 focus:outline-none pr-4" onclick="toggleMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </nav>

        <!-- Mobile Menu -->
         <div class="md:flex md:justify-end">
        <div id="menu" class="hidden md:w-1/5 bg-white shadow-md rounded-lg py-3 sm:p-4 mb-4 space-y-4 hidden">
            <ul>
                <li class="block lg:text-lg text-blue-500 hover:text-white hover:bg-blue-500 py-3 px-4 rounded-lg transition duration-200 font-bold md:w-0 md:h-0 md:py-0 md:px-0 md:text-[0px]">
                    <form method="GET" action="{{ url('/home') }}" class="flex">
                        <input type="text" id="search" name="search" value="{{ request('search') }}" class="w-full p-2 border border-gray-300 rounded-l focus:outline-none focus:ring-2 focus:ring-blue-500 md:w-0 md:h-0 md:p-0" placeholder="Search products...">
                        <button type="submit" class="bg-blue-500 text-white p-2 rounded-r hover:bg-blue-600 transition duration-200 md:w-0 md:w-0 md:h-0 md:p-0 md:text-[0px]">Search</button>
                    </form>
                </li>
                <li><a href="{{ route('home') }}" class="block text-blue-500 hover:text-white hover:bg-blue-500 py-3 px-4 rounded-lg transition duration-200 font-bold md:w-0 md:h-0 md:py-0 md:px-0 md:text-[0px]">Home</a></li>
                <li><a href="{{ url('/cart') }}" class="block text-blue-500 hover:text-white hover:bg-blue-500 py-3 px-4 rounded-lg transition duration-200 font-bold md:w-0 md:h-0 md:py-0 md:px-0 md:text-[0px]">Keranjang (<span id="cart-count">{{ $cart->cartItems->count() ?? 0 }}</span>)
                    </a></li>
                <li><a href="{{ route('user.settings') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Settings</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                    </form>
                </li>
                @if (Auth::user()->role === 'admin')
                <li><a href="{{ route('products.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Manage Products</a></li>
                @endif
            </ul>
        </div>
        </div>
        <!-- Filter dan Pencarian -->
        <div class="mb-6">
            <form method="GET" action="{{ url('/home') }}" id="filterForm" class="bg-white shadow-md rounded-lg p-4 flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                <div class="flex flex-col w-full md:w-auto">
                    <label for="category_id" class="text-gray-700 font-semibold mb-2">Category</label>
                    <select name="category_id" id="category_id" class="p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="document.getElementById('filterForm').submit();">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col w-full md:w-auto">
                    <label for="min_price" class="text-gray-700 font-semibold mb-2">Min Price</label>
                    <input type="number" id="min_price" name="min_price" value="{{ request('min_price') }}" class="p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Min Price">
                </div>
                <div class="flex flex-col w-full md:w-auto">
                    <label for="max_price" class="text-gray-700 font-semibold mb-2">Max Price</label>
                    <input type="number" id="max_price" name="max_price" value="{{ request('max_price') }}" class="p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Max Price">
                </div>
                <div class="flex flex-col w-full md:w-auto justify-end">
                    <button type="submit" class="mt-6 md:mt-0 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">Filter</button>
                </div>
            </form>
        </div>

        @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            {{ session('success') }}
        </div>
        @endif

        <!-- Section Products Bagian Atas -->
        <div>
            <h2 class="text-2xl font-bold mb-4">List Produk</h2>
            <div class="relative">
                <button id="prev" class="absolute left-0 top-1/3 transform -translate-y-1/2 bg-white border border-gray-300 p-2 rounded-full shadow-md focus:outline-none">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <div id="product-list" class="flex overflow-x-auto scroll-smooth space-x-4 pb-12">
                    @foreach($products as $product)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden w-44 md:w-80 flex-shrink-0">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                            <p class="text-gray-700 description" data-full-description="{{ $product->description }}"></p>
                            <a href="{{ route('products.show', $product->id) }}" class="text-blue-500 hover:underline">(Selengkapnya)</a>
                            <div class="md:flex block items-center justify-between mt-4">
                                <span class="text-xl block mb-2 md:mb-0 md:inline font-bold text-red-500">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                            <form id="add-to-cart-form-{{ $product->id }}" class="add-to-cart-form" data-product-id="{{ $product->id }}">
                                @csrf
                                <input type="number" name="quantity" value="1" min="1">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button id="next" class="absolute right-0 top-1/3 transform -translate-y-1/2 bg-white border border-gray-300 p-2 rounded-full shadow-md focus:outline-none">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Section Product Bagian Bawah -->
        <div>
            <h2 class="text-2xl font-bold mb-4">Produk Lengkap</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                <!-- Contoh Produk -->
                @foreach($products as $product)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">{{ $product->name }}</h3>
                        <p class="text-gray-700 description" data-full-description="{{ $product->description }}"></p>
                        <div>
                            <a href="{{ route('products.show', $product->id) }}" class="text-blue-500 hover:underline">(Selengkapnya)</a>
                        </div>
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-xl font-bold text-red-500">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                        </div>
                        <form id="add-to-cart-form-{{ $product->id }}" class="add-to-cart-form" data-product-id="{{ $product->id }}">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add to Cart</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Toggle menu mobile
        function toggleMenu() {
            document.getElementById('menu').classList.toggle('hidden');
        }

        // untuk filter
        document.getElementById('category_id').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });

        // untuk list produk
        document.getElementById('next').onclick = function() {
            document.getElementById('product-list').scrollBy({
                left: 600,
                behavior: 'smooth'
            });
        };

        document.getElementById('prev').onclick = function() {
            document.getElementById('product-list').scrollBy({
                left: -600,
                behavior: 'smooth'
            });
        };

        document.addEventListener('DOMContentLoaded', function() {
            const descriptions = document.querySelectorAll('.description');
            descriptions.forEach(description => {
                const fullDescription = description.getAttribute('data-full-description');
                const words = fullDescription.split(' ');
                if (words.length > 10) {
                    const truncated = words.slice(0, 10).join(' ') + '...';
                    description.textContent = truncated;
                } else {
                    description.textContent = fullDescription;
                }
            });
        });

        // Untuk Menu Burger
        function toggleMenu() {
            document.getElementById('menu').classList.toggle('hidden');
        }

        document.addEventListener('click', function(event) {
            var isClickInside = document.querySelector('.relative').contains(event.target);

            if (!isClickInside) {
                document.getElementById('menu').classList.add('hidden');
            }
        });


        // Untuk add to cart agar page tidak refresh saat tambah produk ke keranjang
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.add-to-cart-form');
            const cartCountElement = document.getElementById('cart-count');

            forms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    const productId = form.getAttribute('data-product-id');
                    const quantityInput = form.querySelector('input[name="quantity"]');
                    const quantity = quantityInput.value;

                    axios.post(`/cart/add/${productId}`, {
                            quantity: quantity,
                            _token: '{{ csrf_token() }}'
                        })
                        .then(response => {
                            console.log('Product added to cart');
                            Swal.fire({
                                title: 'Success!',
                                text: 'Product added to cart',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                            // Reset quantity input to 1
                            quantityInput.value = 1;
                            // Update cart count
                            cartCountElement.textContent = response.data.cartItemCount;
                        })
                        .catch(error => {
                            console.error('There was an error!', error);
                            Swal.fire({
                                title: 'Error!',
                                text: 'There was an error adding the product to the cart.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        });
                });
            });
        });
    </script>
    @vite('resources/js/app.js')
</body>

</html>