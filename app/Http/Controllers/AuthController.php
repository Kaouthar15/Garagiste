<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    /**
     * Display login page.
     *
     * @return Renderable
     */
    public function showLogin()
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
            return redirect()
                ->to('login')
                ->withErrors(trans('auth.failed'));
        }

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        $remember = $request->has('remember');

        Auth::login($user, $remember);

        if ($remember) {
            $cookie = Cookie::make(
                'remember_token',
                $user->getRememberToken(),
                60 * 24 * 30
            ); // Remember for 30 days
            return redirect()
                ->intended('/')
                ->withCookie($cookie);
        }

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

    /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function showRegister()
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
        $userData['isMechanic'] = $request->has('isMechanic') ? 1 : 0;
        $userData['isClient'] = $request->has('isClient') ? 1 : 0;
        $userData['isAdmin'] = 0; 
        $userData['password'] = Hash::make($userData['password']);

        // Create the user
        $user = User::create($userData);

        // Log in the user
        auth()->login($user);

        // Redirect after successful registration
        return redirect('/')->with('success', "Account successfully registered.");
    }

    /**
     * Log out account user.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function performLogout()
    {
        Session::flush();
        
        Auth::logout();

        return redirect('login');
    }

    /**
     * Verify user's account.
     *
     * @param string $token
     *
     * @return \Illuminate\Routing\Redirector
     */

    /**
     * Show the login form.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('auth.login');
    }  
      
    /**
     * Show the registration form.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function registration()
    {
        return view('auth.registration');
    }
      
    /**
     * Handle post login.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }
  
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
    
    /**
     * Handle post registration.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $createUser = $this->create($data);
  
        $token = Str::random(64);
  
        UserVerify::create([
              'user_id' => $createUser->id, 
              'token' => $token
            ]);
  
        Mail::send('email.emailVerificationEmail', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Email Verification Mail');
          });
         
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
    
    /**
     * Show the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }
      
    /**
     * Log out the user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout() 
    {
        Session::flush();
        Auth::logout();
  
        return redirect('login');
    }
    
    /**
     * Verify user's account by token.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyAccount($token)
    {
        $verifyUser = UserVerify::where('token', $token)->first();
  
        $message = 'Sorry your email cannot be identified.';
  
        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;
              
            if(!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
                $message = "Your e-mail is verified. You can now login.";
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
        }
  
        return redirect()->route('login')->with('message', $message);
    }
}
