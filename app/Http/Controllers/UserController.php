<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Import Storage facade
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('user.dashboard', ['user' => Auth::user()]); // Pass authenticated user to the dashboard
    }

    public function edit()
    {
        return view('user.profile', ['user' => Auth::user()]); // Pass authenticated user to the profile page
    }

    public function updateProfile(Request $request)
    {
        // Validate the uploaded profile picture
        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validation rule for image file
        ]);

        $user = Auth::user(); // Get the currently authenticated user

        if ($request->hasFile('profile_picture')) {
            // If a profile picture is uploaded, store it in the 'profile_pictures' directory in public storage
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');

            // If the user already has a profile picture, delete the old one
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            // Save the new profile picture path in the database
            $user->profile_picture = $profilePicturePath;
        }

        // Update any other fields if necessary (not shown here)
        $user->save();

        // Redirect back to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Profile updated successfully!');
    }
}
