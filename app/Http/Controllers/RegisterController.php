<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.register');
    }
    /**
     * Handle account registration request
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request) 
    {
        $userData = $request->validated();

        // Handle role selection
        $userData['isClient'] = $request->has('isClient') ? 1 : 0;
        $userData['isMechanic'] = $request->has('isMechanic') ? 1 : 0;
        $userData['isAdmin'] = 0; 
        $userData['password'] = Hash::make($userData['password']);

        // Create the user
        $user = User::create($userData);

        // Log in the user
        auth()->login($user);

        // Redirect after successful registration
        return redirect('/')->with('success', "Account successfully registered.");
    }
}
