<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RegistrationController extends Controller
{
    // Show Login Form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle Login
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // Redirect based on  role
            // if ($user->role === 'admin') {
            //     return redirect()->route('admin.dashbord');
            // } elseif ($user->role === 'customer') {
            //     return redirect()->route('customer.dashbord');
            // }
            return redirect()->route('home');
        }

        // Redirect back with an error if login fails
        return redirect('login')->with('error', 'Invalid details');
    }



    // for signup or register page
    // Show Signup Form
    public function showSignupForm()
    {
        return view('auth.signup');
    }

    // Handle Signup
    public function signup(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255|regex:/^([A-Z][a-z]+\s?)+$/',
            'email' => 'required|email|unique:users',
            'gender' => 'required',
            'phone' => 'required|digits:10',
            'address' => 'required|string|max:255',
            'password' => 'required|confirmed|min:8',
        ]);

        // Prepare user data
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ];

        // Create user
        $user = User::create($data);
        if (!$user) {
            return redirect('register')->with('error', 'Registration failed. Please try again.');
        }

        return redirect('login')->with('success', 'Registration successful. Please log in to access.');
    }

    // Logout
    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('home');
    }
}
