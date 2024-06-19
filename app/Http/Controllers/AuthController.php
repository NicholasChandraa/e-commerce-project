<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view("auth.register");
    }

    public function register(request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', //Default role is User
        ]);

        return redirect('login');
    }

    public function showLoginForm()
    {
        return view("auth.login");
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password')))
        {
            $request->session()->regenerate(); // code ini artinya session di regenerate untuk memastikan bahwa sesi lama dihancurkan dan sesi baru dibuat. Untuk mengurangi risiko penyalahgunaan sesi.

            return redirect()->intended('/home');
        } else {
            return redirect('login')->with('error_message','Email atau Password Salah');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login');
    }

}
