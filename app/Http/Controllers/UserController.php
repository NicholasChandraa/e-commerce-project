<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function showUser()
    {
        $user = Auth::user();
        return view('users.userProfile', compact('user'));
    }
    
    
    public function settings()
    {
        $user = Auth::user();
        return view('users.settings', compact('user'));
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:10',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $user = Auth::user();
        $user->update(array_filter($request->only(['name','email','phone','address','city','postal_code'])));

        if ($request->hasFile('profile_photo')) {
            $profilePhotoPath = $request->file('profile_photo')->store('profile_photos', 'public');
            $data['profile_photo'] = $profilePhotoPath;
        }

        $user->update($data);

        return redirect()->route('user.settings')->with('success', 'Settings updated successfully.');
    }
    
}
