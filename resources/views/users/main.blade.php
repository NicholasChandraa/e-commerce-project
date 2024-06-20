<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Page</title>
    @vite('resources/css/app.css')

    <style>
    #jumbotron {
        height: 40vh;
        z-index: 10;
    }

    @media (min-width: 768px) {
        #jumbotron {
            height: 55vh;
            z-index: 10;
        }
    }
</style>
</head>

<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-md relative z-50">
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
                <a href="#" class="text-gray-700 hover:text-blue-500">About</a>
                <a href="#" class="text-gray-700 hover:text-blue-500 text-center">Contact Us</a>
                <div class="flex items-center space-x-4 relative">
                    @if(Auth::user()->profile_photo)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}" class="w-10 h-10 md:w-12 md:h-12 rounded-full object-cover cursor-pointer" onclick="toggleMenu(event)">
                    <img src="{{ asset('images/dropdownGudang.png') }}" alt="drop down gudang" class="w-4 object-cover cursor-pointer" onclick="toggleMenu(event)">
                    @endif
                </div>
            </nav>
            <!-- Profile --> 
            <div class="md:flex md:justify-end absolute top-[130px] md:top-20 right-0 z-999">
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
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative flex flex-col items-center justify-center bg-cover bg-center text-white py-24" id="jumbotron" style="background-image: url('{{ asset('images/gambar-login3.webp') }}');">
    <div class="absolute inset-0 bg-black opacity-50"></div> <!-- Overlay -->
    
    <div class="container relative z-10 mx-auto text-center">
        <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-4">Discover The Greatest Products <br>FOR YOU.</h1>
        <form method="GET" action="{{ route('home') }}" class="flex justify-center mb-4">
            <input type="text" id="search" name="search" placeholder="Search for eco products" class="border border-gray-300 rounded-l px-4 py-2 sm:w-full max-w-md focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition-all duration-300">
            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-r hover:bg-purple-700 transition-all duration-300">Search</button>
        </form>
    </div>
</section>


    <!-- Learn about sustainability Section -->
    <section class="container mx-auto my-10">
        <h2 class="text-2xl font-bold mb-4">Learn about sustainability</h2>
        <div class="grid md:grid-cols-3 gap-4">
            <div class="bg-white p-5 rounded shadow-md">
                <img src="{{ asset('images/helm3.jpg') }}" alt="Step 1" class="mx-auto mb-4 rounded-lg">
                <h3 class="text-xl font-semibold mb-2">NJS Kairoz GT Nebula Sky</h3>
                <p>Enter your address. Prepare your location for eco-friendly delivery.</p>
            </div>
            <div class="bg-white p-5 rounded shadow-md">
                <img src="{{ asset('images/step2.png') }}" alt="Step 2" class="h-24 mx-auto mb-4">
                <h3 class="text-xl font-semibold mb-2">Step 2</h3>
                <p>Select your favorite eco products. One step closer to a sustainable lifestyle.</p>
            </div>
            <div class="bg-white p-5 rounded shadow-md">
                <img src="{{ asset('images/step3.png') }}" alt="Step 3" class="h-24 mx-auto mb-4">
                <h3 class="text-xl font-semibold mb-2">Step 3</h3>
                <p>Complete your eco-friendly purchase. Sit back and relax while we prepare your order.</p>
            </div>
        </div>
    </section>

    <!-- Join EcoMarket's Mission Section -->
    <section class="bg-white py-10">
        <div class="container mx-auto">
            <h2 class="text-2xl font-bold mb-4">Join EcoMarket's mission</h2>
            <div class="grid md:grid-cols-3 gap-4">
                <div class="bg-gray-100 p-5 rounded shadow-md">
                    <img src="{{ asset('images/courier.png') }}" alt="As a courier" class="h-24 mx-auto mb-4">
                    <h3 class="text-xl font-semibold mb-2">As a courier</h3>
                    <p>Deliver eco goods sustainably. All you need is a bike and a passion for the environment.</p>
                    <button class="bg-purple-600 text-white px-4 py-2 rounded mt-4">Deliver with us</button>
                </div>
                <div class="bg-gray-100 p-5 rounded shadow-md">
                    <img src="{{ asset('images/vendor.png') }}" alt="As a vendor" class="h-24 mx-auto mb-4">
                    <h3 class="text-xl font-semibold mb-2">As a vendor</h3>
                    <p>Grow your eco business with online sales, green initiatives, and more.</p>
                    <button class="bg-purple-600 text-white px-4 py-2 rounded mt-4">Sell with us</button>
                </div>
                <div class="bg-gray-100 p-5 rounded shadow-md">
                    <img src="{{ asset('images/team.png') }}" alt="As a team member" class="h-24 mx-auto mb-4">
                    <h3 class="text-xl font-semibold mb-2">As a team member</h3>
                    <p>Join a team dedicated to eco-friendly practices and sustainable deliveries.</p>
                    <button class="bg-purple-600 text-white px-4 py-2 rounded mt-4">Join our team</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Get our eco app Section -->
    <section class="container mx-auto my-10">
        <h2 class="text-2xl font-bold mb-4">Get our eco app</h2>
        <div class="bg-white p-5 rounded shadow-md text-center">
            <img src="{{ asset('images/eco-app.png') }}" alt="Eco App" class="h-24 mx-auto mb-4">
            <p>Shop sustainably! Receive eco-friendly products at your doorstep. Excellent delivery from ethical brands.</p>
            <button class="bg-purple-600 text-white px-4 py-2 rounded mt-4">Get App</button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-5">
        <div class="container mx-auto text-center">
            <p>© EcoMarket 2022</p>
            <div class="flex justify-center space-x-4 mt-2">
                <a href="#" class="hover:underline">Instagram</a>
                <a href="#" class="hover:underline">Twitter</a>
                <a href="#" class="hover:underline">Contact</a>
            </div>
        </div>
    </footer>

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

     document.addEventListener('DOMContentLoaded', function () {
        const images = [
            "{{ asset('images/gambar-login3.webp') }}",
            "{{ asset('images/gambar-login4.webp') }}",
            "{{ asset('images/gambar-login5.webp') }}",
            // Add more image URLs as needed
        ];
        
        let currentIndex = 0;
        const jumbotron = document.getElementById('jumbotron');
        
        function changeImage() {
            currentIndex = (currentIndex + 1) % images.length;
            jumbotron.style.backgroundImage = `url('${images[currentIndex]}')`;
        }

        setInterval(changeImage, 3000);
    });
</script>
    @vite('resources/js/app.js')
</body>

</html>