<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function create()
    {
        return view('admin.user.create');
    }

    public function show()
    {
        $users = User::orderBy('id', 'desc')->simplePaginate(5);

        return view('admin.user.show', ['users' => $users])->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'phoneNumber' => 'required|string',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'isClient' => 'boolean',
            'isMechanic' => 'boolean',
            'address' => 'string',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->phoneNumber = $request->phoneNumber;
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->address = $request->address;
        $user->isAdmin = 0;

        $user->isClient = $request->has('isClient') ? true : false;
        $user->isMechanic = $request->has('isMechanic') ? true : false;

        $user->save();


        return redirect()->route('admin.show')->with('success', 'User created successfully');
    }
    public function edit(User $user)
    {

        return view('admin.user.edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'username' => 'required|string',
            'phoneNumber' => 'required|string',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'isClient' => 'boolean',
            'isMechanic' => 'boolean',
            'address' => 'string',
        ]);
        $user->fill($request->except('password', 'isClient', 'isMechanic'));

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->isClient = $request->has('isClient') ? true : false;
        $user->isMechanic = $request->has('isMechanic') ? true : false;

        $user->save();

        return redirect()->route('admin.show')->with('success', 'User updated successfully');
    }
    public function search()
    {
        $users = User::where('username', 'like', '%' . request('search') . '%')
            ->simplePaginate(5);
        // ->latest()->paginate(5); 

        return view('admin.search', compact('users'))->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.show')->with('success', 'User deleted successfully');
    }
    public function details($id)  
    {
        // $user = User::find(1);
        $user = User::findOrFail($id);
        return view('admin.user.details',compact('user')); 
    }
}
