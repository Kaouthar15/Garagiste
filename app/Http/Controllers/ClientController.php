<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function dashboard()
    {
        return view('client.dashboard');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('client.profile.edit', compact('user'));
    }

    public function update(Request $request)
{
    // Validate form data
    $validatedData = $request->validate([
        'username' => 'required|string|max:255',
        'phoneNumber' => 'required|string|max:255',
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
        'address' => 'required|string|max:255',
        'password' => 'required|string|min:8',

    ]);

    // Update user profile information
    $user = Auth::user();
    $user->update($validatedData);

    return redirect()->back()->with('success', 'Profile updated successfully!');
}

}
