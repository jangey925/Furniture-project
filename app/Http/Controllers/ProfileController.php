<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage; 

class ProfileController extends Controller
{
    
    public function showProfile()
    {
        
        return view('profile.show');
    }

    // Edit profile
    public function editProfile()
    {
        return view('profile.edit');
    }

    // Update profile
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|digits:10',
            'address' => 'required|string',
            'gender' => 'required|string',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
    

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
             
            // Store the new image and save the path
            $file = $request->file('profile_image');
            $path = $file->store('profile_image', 'public');
            $user->profile_image = $path;
        }
         \Log::info('Profile image before saving:', ['profile_image' => $user->profile_image]);

    
    $user->save();

    // Log the profile image path after saving
    \Log::info('Profile image after saving:', ['profile_image' => $user->profile_image]);
    
    
        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }

   
    // Show change password form
    public function showChangePasswordForm()
    {
        return view('password.change');
    }

    // Handle password change logic
    public function changePassword(Request $request)
    {
        
        $validatedData = $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Check if the current password matches
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update the password
        Auth::user()->update([
            'password' => Hash::make($request->new_password),
        ]);

          Auth::logout();

        // Redirect to the login page with a success message
        return redirect()->route('login')->with('success', 'Password updated successfully! Please log in with your new password.');
      }
}
