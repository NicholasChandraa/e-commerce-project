<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Page</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">
  <!-- Header -->
  <header class="bg-white shadow-md">
    <div class="container mx-auto flex justify-between items-center p-5">
      <div class="flex items-center space-x-3">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8">
        <span class="text-xl font-bold">EXPLORE ECO</span>
      </div>
      <div>
        <button class="bg-purple-600 text-white px-4 py-2 rounded">Sign Up</button>
      </div>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="bg-white text-center py-10">
    <div class="container mx-auto">
      <h1 class="text-3xl md:text-4xl font-bold mb-4">Discover the greenest products for you</h1>
      <div class="flex justify-center mb-4">
        <input type="text" placeholder="Search for eco products" class="border border-gray-300 rounded-l px-4 py-2 w-full max-w-md">
        <button class="bg-purple-600 text-white px-4 py-2 rounded-r">Search</button>
      </div>
      <div class="flex justify-center space-x-4">
        <img src="{{ asset('images/eco-products.png') }}" alt="Eco Products" class="h-32">
        <img src="{{ asset('images/eco-badges.png') }}" alt="Eco Badges" class="h-32">
      </div>
    </div>
  </section>

  <!-- Learn about sustainability Section -->
  <section class="container mx-auto my-10">
    <h2 class="text-2xl font-bold mb-4">Learn about sustainability</h2>
    <div class="grid md:grid-cols-3 gap-4">
      <div class="bg-white p-5 rounded shadow-md">
        <img src="{{ asset('images/step1.png') }}" alt="Step 1" class="h-24 mx-auto mb-4">
        <h3 class="text-xl font-semibold mb-2">Step 1</h3>
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
    @vite('resources/js/app.js')
</body>
</html>