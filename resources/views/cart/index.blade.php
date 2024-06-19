<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            padding: 10px 15px;
            margin: 5px;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .remove-btn {
            background-color: #f44336;
        }

        .remove-btn:hover {
            background-color: #e60000;
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }

        .total {
            text-align: right;
            font-size: 1.2em;
            font-weight: bold;
        }

        .actions {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Shopping Cart</h1>
        <a href="{{ route('home') }}">Back to Home</a>
        @if ($cart->cartItems->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart->cartItems as $cartItem)
                        <tr>
                            <td>{{ $cartItem->product->name }}</td>
                            <td>
                                <form method="POST" action="{{ route('cart.update', $cartItem->id) }}" style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1">
                                    <button type="submit">Update</button>
                                </form>
                            </td>
                            <td>{{ $cartItem->product->price }}</td>
                            <td>{{ $cartItem->product->price * $cartItem->quantity }}</td>
                            <td>
                                <form method="POST" action="{{ route('cart.remove', $cartItem->id) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="remove-btn">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="total">
                Total: {{ $cart->cartItems->sum(function($cartItem) {
                    return $cartItem->product->price * $cartItem->quantity;
                }) }}
            </div>
            <div class="actions">
                <a href="{{ route('checkout.index') }}"><button>Proceed to Checkout</button></a>
            </div>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
</body>
</html>