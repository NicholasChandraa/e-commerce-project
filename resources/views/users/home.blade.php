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

<body class="bg-gray-100">
    <div class="container mx-auto py-8 px-4">
        <nav class="bg-white shadow-md rounded-lg py-3 sm:p-4 mb-24 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/njs-logo.png') }}" alt="Logo" class="w-0 h-0 md:w-14 md:h-8">
                <h1 class=" text-[0px]  md:text-lg sm:text-base lg:text-2xl font-bold">Welcome, {{ Auth::user()->name }}</h1>
            </div>
            <ul class="flex space-x-4">
                <li><a href="{{ route('home') }}" class="lg:text-lg text-blue-500 lg:hover:text-white lg:hover:bg-blue-500 lg:py-3 lg:px-4 rounded-lg transition duration-200 font-bold lg:mr-6">Home</a></li>
                <li><a href="#" class="lg:text-lg text-blue-500 lg:hover:text-white lg:hover:bg-blue-500 lg:py-3 lg:px-4 rounded-lg transition duration-200 font-bold lg:mr-6">Search</a></li>
                <li><a href="#" class="lg:text-lg text-blue-500 lg:hover:text-white lg:hover:bg-blue-500 lg:py-3 lg:px-4 rounded-lg transition duration-200 font-bold lg:mr-6">Keranjang</a></li>
            </ul>
            <div class="flex items-center space-x-4 relative">
                @if(Auth::user()->profile_photo)
                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}" class="w-12 h-12 md: w-14 md:h-14 rounded-full object-cover">
                @endif
                <button class="flex items-center text-gray-600 focus:outline-none pr-4" onclick="toggleMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>

                <!-- Ini untuk menu burger -->
                <div id="menu" class="absolute right-0 sm:-right-4 mt-[205px] w-34 text-sm sm:text-md sm:w-48 bg-white border border-gray-200 rounded-lg shadow-md hidden">
                    <a href="{{ route('user.settings') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Settings</a>
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                    </form>
                    @if (Auth::user()->role === 'admin')
                    <a href="{{ route('products.index') }}"  class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                        Manage Products
                    </a>
                    @endif
                </div>
            </div>
        </nav>

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
                            <form method="POST" action="{{ route('cart.add', $product->id) }}">
                                @csrf
                                <input type="number" name="quantity" value="1" min="1">
                                <button type="submit">Add to Cart</button>
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
                        <form method="POST" action="{{ route('cart.add', $product->id) }}">
                            @csrf
                            <input type="number" name="quantity" value="1" min="1">
                            <button type="submit">Add to Cart</button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
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
    </script>
    @vite('resources/js/app.js')
</body>

</html>