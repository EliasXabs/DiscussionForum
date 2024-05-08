<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $posts = $user->posts()->latest()->paginate(10); // Fetch posts with pagination
        return view('userprofile', compact('user', 'posts'));
    }
    
    
    public function edit()
    {
        $user = auth()->user();
        return view('useredit', compact('user'));
    }
    
    public function update(Request $request)
    {
        $user = auth()->user();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);
    
        // Check if a new password is provided
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']); // Remove password from array if not provided
        }
    
        // Update the user with the validated data
        $user->update($data);
    
        return redirect()->route('user.profile')->with('success', 'Profile updated successfully!');
    }
    
    
    

}
