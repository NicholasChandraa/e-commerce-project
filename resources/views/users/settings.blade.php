<!DOCTYPE html>
<html>
<head>
    <title>Settings</title>
</head>
<body>
    <h1>Settings</h1>
    @if(session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif
    <form method="POST" action="{{ route('user.settings.update') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}">
        </div>
        <div>
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone" value="{{ $user->phone }}">
        </div>
        <div>
            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="{{ $user->address }}">
        </div>
        <div>
            <label for="city">City</label>
            <input type="text" id="city" name="city" value="{{ $user->city }}">
        </div>
        <div>
            <label for="postal_code">Postal Code</label>
            <input type="text" id="postal_code" name="postal_code" value="{{ $user->postal_code }}">
        </div>
        <div>
            <label for="profile_photo">Profile Photo</label>
            <input type="file" id="profile_photo" name="profile_photo">
            @if($user->profile_photo)
                <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" width="100">
            @endif
        </div>
        <div>
            <button type="submit">Save Settings</button>
        </div>
    </form>
    <a href="{{ route('user.profile') }}">Back to User Detail</a>
</body>
</html>