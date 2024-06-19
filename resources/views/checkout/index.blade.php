<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>
    <h1>Checkout</h1>
    @if(session('error'))
        <div>
            {{ session('error') }}
        </div>
    @endif
    <form method="POST" action="{{ route('checkout.store') }}">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div>
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone" value="{{ $user->phone }}" required>
        </div>
        <div>
            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="{{ $user->address }}" required>
        </div>
        <div>
            <label for="city">City</label>
            <input type="text" id="city" name="city" value="{{ $user->city }}" required>
        </div>
        <div>
            <label for="postal_code">Postal Code</label>
            <input type="text" id="postal_code" name="postal_code" value="{{ $user->postal_code }}" required>
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>
    <a href="{{ route('cart.index') }}">Back to Cart</a>
</body>
</html>