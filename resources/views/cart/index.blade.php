@extends('layouts.mainLayout')

@section('content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        .checkbox-custom {
            appearance: none;
            background-color: #fff;
            border: 2px solid #ddd;
            border-radius: 4px;
            width: 20px;
            height: 20px;
            display: inline-block;
            position: relative;
            cursor: pointer;
        }

        .checkbox-custom:checked {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }

        .checkbox-custom:checked::after {
            content: '✔';
            color: #fff;
            position: absolute;
            top: 0;
            left: 4px;
            font-size: 14px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 16px;
            margin-bottom: 16px;
        }

        .cart-item img {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            object-fit: cover;
        }

        .cart-item-details {
            flex-grow: 1;
            margin-left: 16px;
        }

        .cart-item-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .cart-item-price,
        .cart-item-total {
            font-size: 1rem;
            margin-top: 8px;
        }

        .cart-item-quantity {
            display: flex;
            align-items: center;
        }

        .cart-item-quantity input {
            width: 50px;
            text-align: center;
            margin: 0 8px;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .cart-item-quantity button {
            border: none;
            padding: 8px;
            cursor: pointer;
            border-radius: 4px;
        }

        .cart-item-remove {
            color: #f44336;
            cursor: pointer;
        }

        .cart-item-remove:hover {
            text-decoration: underline;
        }

        .total-price {
            font-size: 1.5rem;
            font-weight: 600;
            text-align: right;
            margin-top: 16px;
        }

        .cart-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 32px;
        }

        .cart-actions a {
            padding: 10px 24px;
            border-radius: 30px;
            text-decoration: none;
            color: #fff;
            text-align: center;
        }

        .continue-shopping {
            background-color: #9b9999;
            color: #333;
        }

        .continue-shopping:hover {
            background-color: #5c5b5b;
        }

        .checkout {
            background-color: rgb(190, 103, 248);
        }

        .checkout:hover {
            background-color: #ad6df7;
        }

        footer {
            margin-top: 200px;
            padding-top: 120px;
        }

        footer .gambar {
            padding-bottom: 100px;
        }

        @media (max-width: 768px) {
            .cart-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .cart-item img {
                width: 80px;
                height: 80px;
                margin-bottom: 16px;
            }

            .cart-item-details {
                margin-left: 0;
                margin-bottom: 16px;
            }

            .cart-item-title {
                font-size: 1rem;
            }

            .cart-item-price,
            .cart-item-total {
                font-size: 0.875rem;
            }

            .cart-item-quantity {
                margin-bottom: 16px;
            }

            .cart-actions {
                flex-direction: column;
                gap: 16px;
            }

            .cart-actions a {
                width: 100%;
                text-align: center;
            }

            .total-price {
                text-align: center;
            }
        }
    </style>

    <div class="container mx-auto py-8 px-4">
        <a href="{{ url('/home') }}" class="text-gray-600 hover:text-gray-900 mb-4 inline-block">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <h2 class="text-3xl font-bold mb-6">My Cart</h2>
        @if ($cart->cartItems->count() > 0)
            @foreach ($cart->cartItems as $cartItem)
                <div class="cart-item">
                    <img src="{{ asset('storage/' . $cartItem->product->image) }}" alt="{{ $cartItem->product->name }}">
                    <div class="cart-item-details">
                        <h3 class="cart-item-title">{{ $cartItem->product->name }}</h3>
                        <p class="cart-item-price">Rp{{ number_format($cartItem->product->price, 0, ',', '.') }}</p>
                        <p class="cart-item-total">Total:
                            Rp{{ number_format($cartItem->product->price * $cartItem->quantity, 0, ',', '.') }}</p>
                    </div>
                    <div class="cart-item-quantity flex items-center justify-center h-24">
                        <form method="POST" action="{{ route('cart.update', $cartItem->id) }}"
                            class="flex items-center md:pt-4 md:mr-4 update-quantity-form">
                            @csrf
                            @method('PUT')
                            <button type="button"
                                class="text-gray-600 hover:text-gray-700 p-2 rounded-l-lg focus:outline-none"
                                onclick="updateQuantity(this, -1)">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1"
                                class="w-12 text-center border border-gray-300 rounded quantity-input">
                            <button type="button"
                                class="text-gray-600 hover:text-gray-700 p-2 rounded-r-lg focus:outline-none"
                                onclick="updateQuantity(this, 1)">
                                <i class="fas fa-plus"></i>
                            </button>
                        </form>
                    </div>
                    <div class="cart-item-remove -mt-[85px] md:mt-0 ml-[140px] lg:ml-[16px] mb-[15px] md:mb-0"
                        onclick="document.getElementById('remove-form-{{ $cartItem->id }}').submit();">
                        <i class="fas fa-trash-alt text-2xl pr-4"></i>
                    </div>
                    <form id="remove-form-{{ $cartItem->id }}" method="POST"
                        action="{{ route('cart.remove', $cartItem->id) }}" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            @endforeach
            <div class="total-price">
                Total:
                Rp{{ number_format($cart->cartItems->sum(function ($cartItem) {return $cartItem->product->price * $cartItem->quantity;}),0,',','.') }}
            </div>
            <div class="cart-actions">
                <a href="{{ url('/home') }}" class="continue-shopping">Lanjut Belanja</a>
                <a href="{{ url('/checkout') }}" class="checkout">Checkout</a>
            </div>
        @else
            <p class="text-center text-gray-700">Your cart is empty.</p>
        @endif
    </div>

    <script>
        function updateQuantity(button, change) {
            const form = button.closest('.update-quantity-form');
            const input = form.querySelector('.quantity-input');
            input.value = Math.max(1, parseInt(input.value) + change);
            form.submit();
        }
    </script>

    @include('layouts.footer')
@endsection
@vite('resources/js/app.js')
