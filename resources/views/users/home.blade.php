<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NJS | Shop Page</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        .custom-checkbox input[type="checkbox"] {
            accent-color: rgb(139 92 246);
        }

        .custom-checkbox label {
            color: #333333;
        }
    </style>
</head>

<body class="bg-gray-100">

    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center space-x-4 mb-4 md:mb-0 mr-3">
                <a href="{{ url("/") }}" class="lg:text-2xl font-bold">NJS HELMET</a>
                <form method="GET" action="{{ url('/home') }}" class="flex items-center relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text" id="search" name="search" value="{{ request('search') }}" class="pl-10 p-2 border border-gray-300 rounded-l focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari produk...">
                    <button type="submit" class="bg-purple-600 text-white h-[42px] p-2 rounded-r hover:bg-purple-700 transition duration-200">Search</button>
                </form>
            </div>
            <nav class="flex space-x-4 items-center">
                <a href="{{ route('main') }}" class="text-gray-700 hover:text-blue-500">Home</a>
                <a href="{{ url('/cart') }}" class="text-gray-700 hover:text-blue-500 text-center">Keranjang (<span id="cart-count">{{ $cart->cartItems->count() ?? 0 }}</span>)</a>
                <a href="#" class="text-gray-700 hover:text-blue-500">About</a>
                <a href="#" class="text-gray-700 hover:text-blue-500 text-center">Contact Us</a>
                <div class="flex items-center space-x-4 relative">
                    @if(Auth::user()->profile_photo)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}" class="w-10 h-10 md:w-12 md:h-12 rounded-full object-cover cursor-pointer" onclick="toggleMenu(event)">
                    <img src="{{ asset('images/dropdownGudang.png') }}" alt="drop down gudang" class="w-4 object-cover cursor-pointer" onclick="toggleMenu(event)">
                    @endif
                </div>
            </nav>
        </div>
    </header>

    <!-- Profile -->
    <div class="md:flex md:justify-end absolute right-0">
        <div id="menu" class="hidden md:w-full bg-white shadow-md py-3 sm:p-4 mb-4 space-y-4 relative">
            <ul>
                <li><a href="{{ route('user.settings') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Setting</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                    </form>
                </li>
                @if (Auth::user()->role === 'admin')
                <li><a href="{{ route('products.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Manage Produk</a></li>
                @endif
            </ul>
        </div>
    </div>

    <!-- Konten Utama -->
    <main class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center rounded-md mb-4 bg-white p-6">
            <h2 class="text-2xl font-bold">
                @if(request('search'))
                Hasil Pencarian Untuk "{{ request('search') }}"
                @else
                Hello, {{ Auth::user()->name }}
                @endif
            </h2>
            <span id="total-products" class="text-gray-600">Total Produk : {{ $products->total() }}</span>
        </div>

        <div class="flex flex-col lg:flex-row">
            <!-- Sidebar -->
            <aside class="w-full lg:w-1/4 lg:pr-4 mb-4 lg:mb-0">
                <div class="bg-white p-4 rounded-lg shadow-md mb-6">
                    <h3 class="font-bold text-lg pb-6 border-b">Filter Kategori</h3>
                    <form method="GET" action="{{ route('home') }}" id="filterForm">
                        <select name="category_id" id="category_id" class="py-2 px-4 mt-6 w-full border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>

                        <div class="my-6 border-t border-b py-6">
                            @foreach($categories as $category)
                            <div class="flex items-center mb-2 custom-checkbox">
                                <input id="category-{{ $category->id }}" name="category[]" value="{{ $category->id }}" type="checkbox" class="h-4 w-4" {{ in_array($category->id, (array) request('category')) ? 'checked' : '' }}>
                                <label for="category-{{ $category->id }}" class="ml-3 min-w-0 flex-1 text-gray-700">{{ $category->name }}</label>
                            </div>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            <label for="min_price" class="block text-gray-700 font-medium mb-2">Minimal Harga</label>
                            <input type="number" id="min_price" name="min_price" value="{{ request('min_price') }}" class="py-2 px-4 w-full border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <div class="mt-4">
                            <label for="max_price" class="block text-gray-700 font-medium mb-2">Maksimal Harga</label>
                            <input type="number" id="max_price" name="max_price" value="{{ request('max_price') }}" class="py-2 px-4 w-full border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </form>
                </div>
            </aside>

            <!-- List Produk -->
            <section class="w-full lg:w-3/4">
                @if($products->isEmpty())
                <div class="bg-white p-4 rounded-lg shadow-md flex flex-col items-center">
                    <h3 class="text-lg font-bold text-gray-700">Produk Tidak Ada</h3>
                </div>
                @else
                <div id="product-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($products as $product)
                    <div class="bg-white p-4 rounded-lg shadow-md flex flex-col">
                        <a href="{{ route('products.show', $product->id) }}">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover mb-4">
                        </a>
                        <h3 class="text-lg font-bold">{{ $product->name }}</h3>
                        <p class="text-gray-600 description" data-full-description="{{ $product->description }}"></p>
                        <div class="mt-auto">
                            <p class="text-lg font-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                            <a href="{{ route('products.show', $product->id) }}" class="text-indigo-500 hover:text-indigo-800">Detail Produk</a>
                            <form id="add-to-cart-form-{{ $product->id }}" class="grid grid-2 gap-4 mt-4 bg-white add-to-cart-form" data-product-id="{{ $product->id }}">
                                @csrf
                                <div class="flex items-center space-x-2">
                                    <label for="quantity-{{ $product->id }}" class="text-gray-700">Jumlah:</label>
                                    <input type="number" id="quantity-{{ $product->id }}" name="quantity" value="1" min="1" class="w-full text-end p-2 border rounded-md focus:ring-blue-500 focus:border-blue-500">
                                </div>
                                <button type="submit" class="w-full bg-purple-600 hover:bg-purple-800 text-white font-semibold py-2 px-4 rounded-md transition duration-300">+ Keranjang</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
                @if($products->hasMorePages())
                <div class="mt-4 text-center">
                    <button id="show-more-button" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-800 transition duration-200" data-next-page="{{ $products->currentPage() + 1 }}">Show more</button>
                </div>
                @endif
                @endif
            </section>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Toggle menu mobile
        function toggleMenu() {
            document.getElementById('menu').classList.toggle('hidden');
        }

        // Close menu ketika klik apapun di luar menu
        document.addEventListener('click', function(event) {
            var menu = document.getElementById('menu');
            var isClickInsideMenu = menu.contains(event.target);
            var isClickOnToggle = event.target.closest('.flex.items-center.relative');

            if (!isClickInsideMenu && !isClickOnToggle) {
                menu.classList.add('hidden');
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // untuk filter

            const filterForm = document.getElementById('filterForm');
            document.querySelectorAll('#filterForm input').forEach(input => {
                input.addEventListener('change', function() {
                    filterForm.submit();
                });
            });

            document.getElementById('category_id').addEventListener('change', function() {
                document.getElementById('filterForm').submit();
            });

            document.getElementById('min_price').addEventListener('change', function() {
                document.getElementById('filterForm').submit();
            });

            document.getElementById('max_price').addEventListener('change', function() {
                document.getElementById('filterForm').submit();
            });

            // untuk search
            document.getElementById('search').addEventListener('input', function() {
                document.getElementById('filterForm').submit();
            });

            function truncateDescriptions() {
                const descriptions = document.querySelectorAll('.description');
                descriptions.forEach(description => {
                    const fullDescription = description.getAttribute('data-full-description');
                    const words = fullDescription.split(' ');
                    if (words.length > 10) {
                        const truncated = words.slice(0, 6).join(' ') + '...';
                        description.textContent = truncated;
                    } else {
                        description.textContent = fullDescription;
                    }
                });
            }

            truncateDescriptions();

            // Untuk fitur "Show More"
            const showMoreButton = document.getElementById('show-more-button');
            if (showMoreButton) {
                showMoreButton.addEventListener('click', function() {
                    const nextPage = this.getAttribute('data-next-page');
                    axios.get('{{ route("home") }}', {
                            params: {
                                page: nextPage,
                                category_id: '{{ request("category_id") }}',
                                search: '{{ request("search") }}',
                                min_price: '{{ request("min_price") }}',
                                max_price: '{{ request("max_price") }}'
                            }
                        })
                        .then(response => {
                            const productList = document.getElementById('product-list');
                            productList.insertAdjacentHTML('beforeend', response.data.products);

                            // Update total produk
                            const totalProductsElement = document.getElementById('total-products');
                            totalProductsElement.textContent = 'Total: ' + response.data.total;

                            // Truncate deskripsi untuk produk baru
                            truncateDescriptions();

                            // untuk mengecek apakah ada page lagi yang tersedia
                            if (!response.data.hasMorePages) {
                                showMoreButton.remove();
                            } else {
                                showMoreButton.setAttribute('data-next-page', parseInt(nextPage) + 1);
                            }
                        })
                        .catch(error => {
                            console.error('Error loading more products:', error);
                        });
                });
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
                            // Reset quantity input ke 1
                            quantityInput.value = 1;
                            // Update hitung keranjang
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
