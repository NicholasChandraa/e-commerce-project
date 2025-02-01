@extends('layouts.mainLayout')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.min.css">
    <section class="bg-white">
        <div class="container py-16 mx-auto">
            @if (session('error'))
                <div class="card card-danger">
                    <div class="card-body">
                        {{ session('error') }}
                    </div>
                </div>
            @endif
            <div class="font-bold text-3xl mb-5 text-center">Order Confirmation</div>
            <div class="border-b-2 border-black pb-8 text-center">
                <h1 class="font-semibold text-xl">Hello {{ Auth::user()->name }},</h1>
                <p class="text-gray-500 px-8">Pastikan bahwa alamat dan produk yang dibeli sudah sesuai dengan keinginan
                    anda.</p>
                <p class="text-gray-500 px-8">Anda bisa mengubah informasi sesuai dengan kebutuhan anda.</p>
            </div>

            <div class="">
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <div class="grid md:grid-cols-3 grid-cols-1 px-12 md:space-x-4">
                        <div class="flex flex-col mt-8">
                            <label for="name" class="text-gray-700 ml-[9px]">Nama</label>
                            <input type="text" id="name" name="name" value="{{ $user->name }}"
                                class="border rounded-full py-1 px-2 font-semibold" required>
                        </div>
                        <div class="flex flex-col mt-8">
                            <label for="email" class="text-gray-700 ml-[9px]">Email</label>
                            <input type="email" id="email" name="email" value="{{ $user->email }}"
                                class="border rounded-full py-1 px-2 font-semibold" required>
                        </div>
                        <div class="flex flex-col mt-8">
                            <label for="phone" class="text-gray-700 ml-[9px]">Phone</label>
                            <input type="text" id="phone" name="phone" value="{{ $user->phone }}"
                                class="border rounded-full py-1 px-2 font-semibold" required>
                        </div>
                    </div>
                    <div class="grid md:grid-cols-3 grid-cols-1 px-12 md:space-x-4">
                        <div class="flex flex-col mt-8">
                            <label for="city" class="text-gray-700 ml-[9px]">City</label>
                            <input type="text" id="city" name="city" value="{{ $user->city }}"
                                class="border rounded-full py-1 px-2 font-semibold" required>
                        </div>
                        <div class="flex flex-col mt-8">
                            <label for="address" class="text-gray-700 ml-[9px]">Address</label>
                            <textarea type="text" id="address" name="address" value="{{ $user->address }}" rows="2"
                                class="border rounded-[20px] py-1 px-2 font-semibold" required>{{ $user->address }}</textarea>
                        </div>
                        <div class="flex flex-col mt-8">
                            <label for="postal_code" class="text-gray-700 ml-[9px]">Postal Code</label>
                            <input type="text" id="postal_code" name="postal_code" value="{{ $user->postal_code }}"
                                class="border rounded-full py-1 px-2 font-semibold" required>
                        </div>
                    </div>
                    <div class="flex flex-col mt-8 border-b-2 border-black pb-10">
                        <label for="shipping_method" class="text-gray-700 ml-[9px]">Metode Pengiriman</label>
                        <select id="shipping_method" name="shipping_method" class="border rounded-full py-1 px-2 font-semibold" required>
                            @if(strpos($user->city, 'Jakarta') !== false || strpos($user->city, 'Bogor') !== false || strpos($user->city, 'Depok') !== false || strpos($user->city, 'Tangerang') !== false || strpos($user->city, 'Bekasi') !== false)
                                <option value="Gratis">Gratis (Hanya Untuk Jabodetabek)</option>
                                <option value="Coming Soon" @disabled(true)>Coming Soon (Diluar Jabodetabek)</option>
                            @else
                                <option value="Coming Soon">Coming Soon (Diluar Jabodetabek)</option>
                                <option value="Gratis" @disabled(true)>Gratis (Hanya Untuk Jabodetabek)</option>
                            @endif
                        </select>
                    </div>
                    <div class="py-10 px-4 md:px-[50px] space-y-6">
                        @if ($cart->cartItems->count() > 0)
                            @foreach ($cart->cartItems as $cartItem)
                                <div class="flex flex-col md:flex-row justify-between border-b-2 pb-10">
                                    <div class="flex flex-col md:flex-row">
                                        <img src="{{ asset('storage/' . $cartItem->product->image) }}"
                                            alt="{{ $cartItem->product->name }}"
                                            class="w-[150px] h-[150px] md:w-[250px] md:h-[250px] mb-4 md:mb-0 md:mr-[50px]">

                                        <div class="mr-0 md:mr-[50px]">
                                            <h3 class="font-semibold text-lg md:text-xl mt-2">
                                                {{ $cartItem->product->name }}</h3>
                                            <h3 class="text-gray-700">Kategori: {{ $cartItem->product->category->name }}
                                            </h3>
                                            <p class="text-gray-700">Jumlah: {{ $cartItem->quantity }} </p>
                                        </div>
                                    </div>
                                    <div class="mt-2 flex flex-col md:items-end">
                                        <p class="text-start md:text-end">
                                            Rp{{ number_format($cartItem->product->price, 0, ',', '.') }}</p>
                                        <p class="font-semibold text-lg mt-auto text-start md:text-end">Subtotal:
                                            Rp{{ number_format($cartItem->product->price * $cartItem->quantity, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="total-price text-start md:text-end font-semibold text-xl md:text-2xl">
                                Total:
                                Rp{{ number_format($cart->cartItems->sum(function ($cartItem) {return $cartItem->product->price * $cartItem->quantity;}),0,',','.') }}
                            </div>
                        @else
                            <p class="text-center text-gray-700">Your cart is empty.</p>
                        @endif

                        <div class="flex justify-between">
                            <a href="/checkout"
                                class="py-2 px-6 bg-gray-400 hover:bg-gray-500 font-semibold rounded-full text-white block mt-4">Cancel</a>
                            <button type="submit"
                                class="py-2 px-6 bg-purple-500 hover:bg-purple-600 font-semibold rounded-full text-white block mt-4">Checkout
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    @include('layouts.footer')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.10/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
    
            $('#city').on('input', function() {
                var city = $(this).val();
                var shippingMethod = $('#shipping_method');

                if (city.includes('Jakarta') || city.includes('Bogor') || city.includes('Depok') || city.includes('Tangerang') || city.includes('Bekasi')) {
                    shippingMethod.html('<option value="Gratis">Gratis (Hanya untuk Jabodetabek)</option>');
                } else {
                    shippingMethod.html('<option value="Coming Soon">Coming Soon (Diluar Jabodetabek)</option>');
                }
            });

            $('#shipping_method').on('change', function() {
                var shippingMethod = $(this).val();
                var city = $('#city').val();

                if (shippingMethod === 'Coming Soon' && (city.includes('Jakarta') || city.includes('Bogor') || city.includes('Depok') || city.includes('Tangerang') || city.includes('Bekasi'))) {
                    Swal.fire({
                        title: 'Perhatian!',
                        text: 'Pengiriman Coming Soon hanya berlaku untuk diluar Jabodetabek',
                        icon: 'info',
                        confirmButtonText: 'OK'
                    });
                }
            });

            $('#city').on('input', function() {
                var city = $(this).val();
                var shippingMethod = $('#shipping_method');

                if (city.includes('Jakarta') || city.includes('Bogor') || city.includes('Depok') || city.includes('Tangerang') || city.includes('Bekasi')) {
                    shippingMethod.html('<option value="Gratis">Gratis (Hanya untuk Jabodetabek)</option><option value="Coming Soon" disabled>Coming Soon (Diluar Jabodetabek)</option>');
                } else {
                    shippingMethod.html('<option value="Coming Soon">Coming Soon (Diluar Jabodetabek)</option>');
                }
            });

            $('#city').on('input', function() {
                var city = $(this).val();
                var shippingMethod = $('#shipping_method');

                if (city.includes('Jakarta') || city.includes('Bogor') || city.includes('Depok') || city.includes('Tangerang') || city.includes('Bekasi')) {
                    shippingMethod.html('<option value="Gratis">Gratis (Hanya untuk Jabodetabek)</option><option value="Coming Soon" disabled>Coming Soon (Diluar Jabodetabek)</option>');
                } else {
                    shippingMethod.html('<option value="Coming Soon">Coming Soon (Diluar Jabodetabek)</option><option value="Gratis" disabled>Gratis (Hanya untuk Jabodetabek)</option>');
                }
            });

            function updateShippingMethod() {
                var city = $('#city').val().toLowerCase();
                var shippingMethod = $('#shipping_method');

                if (city.includes('jakarta') || city.includes('bogor') || city.includes('depok') || city.includes('tangerang') || city.includes('bekasi')) {
                    shippingMethod.html('<option value="Gratis">Gratis (Hanya untuk Jabodetabek)</option><option value="Coming Soon" disabled>Coming Soon (Diluar Jabodetabek)</option>');
                } else {
                    shippingMethod.html('<option value="Coming Soon">Coming Soon (Diluar Jabodetabek)</option><option value="Gratis" disabled>Gratis (Hanya untuk Jabodetabek)</option>');
                }
            }

            $('#city').on('input', function() {
                updateShippingMethod();
            });

            $('button[type="submit"]').click(function(event) {
                var city = $('#city').val().toLowerCase();

                if (!(city.includes('jakarta') || city.includes('bogor') || city.includes('depok') || city.includes('tangerang') || city.includes('bekasi'))) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Perhatian!',
                        text: 'Pengiriman hanya berlaku untuk Jabodetabek',
                        icon: 'info',
                        confirmButtonText: 'OK'
                    });
                } else {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Konfirmasi',
                        text: 'Apakah Anda yakin ingin melanjutkan checkout?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, lanjutkan',
                        cancelButtonText: 'Tidak, batalkan'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).unbind('click').click();
                        }
                    });
                }

                updateShippingMethod();
            });

        });

        
    </script>
@endsection
