<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori List</title>
</head>
<body>
    <h1>Kategori List</h1>
    @foreach ($categories as $category)
    
    <ul>
        <li>{{ $category->name }}</li>
    </ul>

    @endforeach

    <a href="{{ route('categories.create') }}"> Tambah Kategori</a>
    <a href="{{ url('products') }}">Kembali ke Produk</a>
</body>
</html>