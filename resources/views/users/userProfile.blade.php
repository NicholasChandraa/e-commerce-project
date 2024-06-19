<!-- resources/views/users/userProfile.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
</head>
<body>
    <h1>User Profile</h1>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div>
        <h2>Name:</h2>
        <p>{{ $user->name }}</p>
    </div>
    <div>
        <h2>Email:</h2>
        <p>{{ $user->email }}</p>
    </div>
    <div>
        <h2>Phone:</h2>
        <p>{{ $user->phone }}</p>
    </div>
    <div>
        <h2>Address:</h2>
        <p>{{ $user->address }}</p>
    </div>
    <div>
        <h2>City:</h2>
        <p>{{ $user->city }}</p>
    </div>
    <div>
        <h2>Postal Code:</h2>
        <p>{{ $user->postal_code }}</p>
    </div>
    <div>
        <h2>Profile Photo:</h2>
        @if(Auth::user()->profile_photo)
                <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}" width="100">
                @endif
    </div>
   

    <a href="{{ route('home') }}">Back to Home</a>
    <a href="{{ route('user.settings') }}">Edit Settings</a>
</body>
</html>
