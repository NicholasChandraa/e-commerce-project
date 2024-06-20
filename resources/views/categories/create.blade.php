<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Kategori</title>
</head>
<body>
    <form method="POST" action="{{ route('categories.store') }}">
        @csrf
        <div>
            <label for="name">Nama Kategori</label>
            <input type="text" id="name" name="name">
        </div>
        <div>
            <button type="submit">Tambah Kategori</button>
        </div>
    </form>

    <div>
        <h1>Kategori List</h1>


        @foreach ($categories as $category)
        <ul>
            <li>{{ $category->name }}</li>
        </ul>
        @endforeach
    </div>

    <a href="{{ route('categories.index') }}"> Kembali</a>
</body>
</html>