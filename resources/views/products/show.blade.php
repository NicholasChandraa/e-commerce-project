<!DOCTYPE html>
<html>
<head>
    <title>Product Details</title>
</head>
<body>
    <h1>Product Details</h1>
    <div>
        <strong>Name:</strong> {{ $product->name }}
    </div>
    <div>
        <strong>Description:</strong> {{ $product->description }}
    </div>
    <div>
        <strong>Price:</strong> {{ $product->price }}
    </div>
    <div>
        <strong>Stock:</strong> {{ $product->stock }}
    </div>
    <div>
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="200">
        @endif
    </div>
    <div>
        <a href="{{ route('products.index') }}">Back to Products</a>
    </div>
</body>
</html>
