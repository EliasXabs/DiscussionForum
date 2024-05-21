<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {

        return view('register');
    }

    public function register(Request $request)
    {
       $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'avatar' => 'nullable'
    ]);

        

        $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'avatar_url' => $request->avatar ?? null,
        'is_active' => true,
        'is_admin' => false,
    ]);
        

        auth()->login($user);

        return redirect()->route('index'); // Redirect to a 'home' route after registration
    }

    public function login(Request $request)
    {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        
        if (Auth::user()->is_admin) {
            return redirect()->intended('admin/dashboard'); // Redirect to admin dashboard
        }

        return redirect()->route('index'); // Redirect to index
    } else {
        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }
    }

    public function logout(Request $request)
    {
        Auth::logout();  

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

}
