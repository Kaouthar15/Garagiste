<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Handle account login request
     * 
     * @param LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();
    
        if (!Auth::validate($credentials)) {
            return redirect()->route('login.show')->withErrors(trans('auth.failed'));
        }
    
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
    
        if (!$user->email_verified_at) {
            return redirect()->route('login.show')->with('error', 'Please verify your email first.');
        }
    
        $remember = $request->has('remember');
        Auth::login($user, $remember);
    
        return $this->authenticated($request, $user);
    }
    /**
     * Handle response after user authenticated
     * 
     * @param Request $request
     * @param Auth $user
     * 
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        return redirect()->route('home.index');
    }
}
