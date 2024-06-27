@extends('layouts.mainLayout')

@section('content')
    <style>
        .profile-header {
            background: url("{{ asset('images/background.jpg') }}") no-repeat center center;
            background-size: cover;
            height: 200px;
        }

        .profile-avatar {
            margin-top: -90px;
        }
    </style>

    <!-- Profile Section -->
    <section class="pb-[50px] bg-white">
        <div class="profile-header"></div>
        <div class="container mx-auto px-4 lg:px-0 py-8">
            <div class="lg:flex-col">
                <!-- Profile Information -->
                <div class="text-center mb-8 lg:mb-0">
                    <div class="profile-avatar">
                        <img class="rounded-full w-32 h-32 mx-auto" src="{{ asset('storage/' . $user->profile_photo) }}"
                            alt="{{ $user->name }}">
                    </div>
                    <h2 class="text-3xl font-bold mt-4">{{ $user->name }}</h2>
                    <p class="text-gray-500">{{ $user->email }}</p>
                </div>
                <!-- Additional Information -->
                <div class="lg:w-2/3 bg-white p-8 rounded-lg  mx-auto mt-3">
                    <h3 class="text-2xl font-bold mb-4">Personal Info</h3>
                    <p class="text-gray-500 mb-8">You can change your personal information by click edit profile button.</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <h4 class="text-lg font-bold mb-2">Nama Lengkap</h4>
                            <p class="text-gray-700 border rounded-lg p-3">{{ $user->name }}</p>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold mb-2">Email </h4>
                            <p class="text-gray-700 border rounded-lg p-3">{{ $user->email }}</p>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold mb-2">No. Handphone</h4>
                            <p class="text-gray-700 border rounded-lg p-3">{{ $user->phone }}</p>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold mb-2">Tipe Akun</h4>
                            <p class="text-gray-700 border rounded-lg p-3">{{ Auth::user()->role }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <h4 class="text-lg font-bold mb-2">Address</h4>
                            <p class="text-gray-700 border rounded-lg p-3">{{ $user->address }}</p>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold mb-2">City</h4>
                            <p class="text-gray-700 border rounded-lg p-3">{{ $user->city }}</p>
                        </div>
                        <div>
                            <h4 class="text-lg font-bold mb-2">Postal Code</h4>
                            <p class="text-gray-700 border rounded-lg p-3">{{ $user->postal_code }}</p>
                        </div>
                    </div>
                    <div class="flex justify-end mt-8">
                        <a href="{{ route('user.settings') }}" class="bg-gray-200 text-gray-600 px-4 py-2 rounded">Edit
                            Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')
@endsection
@vite('resources/js/app.js')
