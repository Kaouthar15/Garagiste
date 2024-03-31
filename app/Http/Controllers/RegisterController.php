<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if (!Auth::check()) {
            return view('login.show'); 
        }

        return redirect()->route('login.show')->with('error', 'Opps! You do not have access');
    }
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

        $userData['isClient'] = $request->has('isClient') ? 1 : 0;
        $userData['isMechanic'] = $request->has('isMechanic') ? 1 : 0;
        $userData['isAdmin'] = 0; 
        $userData['password'] = Hash::make($userData['password']);

        $user = User::create($userData);

        $token = Str::random(64);

        UserVerify::create([
            'user_id' => $user->id,
            'token' => $token
        ]);

        $this->sendEmailVerification($user, $token);

        auth()->login($user);

        return view('auth.login')->with('success', "Account successfully registered. Please verify your email.");
    }

    /**
     * Send email verification to the user.
     * 
     * @param User $user
     * @param string $token
     * 
     * @return void
     */
    protected function sendEmailVerification(User $user, $token)
    {
        Mail::send('email.emailVerificationEmail', ['token' => $token], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Email Verification Mail');
        });
    }
    public function verifyAccount($token)
{
    $userVerify = UserVerify::where('token', $token)->first();

    if (!$userVerify || !$userVerify->user) {
        return redirect()->route('login.show')->with('error', 'Invalid or expired verification token.');
    }

    if ($userVerify->user->email_verified_at !== null) {
        return redirect()->route('login.show')->with('error', 'Your email is already verified.');
    }

    $userVerify->user->markEmailAsVerified();

    $userVerify->delete();

    return redirect()->route('login.show')->with('success', 'Your email has been verified. You can now log in.');
}

}
