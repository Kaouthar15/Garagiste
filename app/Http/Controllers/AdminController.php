<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\User;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;

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
        // ->latest()->paginate(5);

        return view('admin.user.show', ['users' => $users])->with(
            'i',
            (request()->input('page', 1) - 1) * 5
        );
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

        return redirect()
            ->route('admin.show')
            ->with('success', 'User created successfully');
    }
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|string',
            'phoneNumber' => 'required|string',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string',
            'isClient' => 'boolean',
            'isMechanic' => 'boolean',
            'address' => 'string',
        ]);

        $user->fill($request->except('password'));

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->isClient = $request->has('isClient');
        $user->isMechanic = $request->has('isMechanic');

        $user->save();

        return redirect()->route('admin.show')->with('success', 'User updated successfully');
    }
    public function search()
    {
        $searchQuery = request('search');

        $users = User::where(function ($query) use ($searchQuery) {
            $query
                ->where('username', 'like', '%' . $searchQuery . '%')
                ->orWhere('phoneNumber', 'like', '%' . $searchQuery . '%');
        })->simplePaginate(5);

        return view('admin.user.show', compact('users'))->with(
            'i',
            (request()->input('page', 1) - 1) * 5
        );
    }
    public function destroy(User $user)
{
    try {
        $user->delete(); 
        return response()->json(['success' => true, 'message' => 'User deleted successfully']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Failed to delete user']);
    }
}
    public function details($id)
    {
        // $user = User::find(1);
        $user = User::findOrFail($id);
        return view('admin.user.details', compact('user'));
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new UsersExport(), 'users.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        Excel::import(new UsersImport(), request()->file('file'));

        return back();
    }
    public function chartsUser()
    {
        $clientsCount = DB::table('users')
            ->where('isClient', 1)
            ->count();

        $mechanicsCount = DB::table('users')
            ->where('isMechanic', 1)
            ->count();

        $bothCount = DB::table('users')
            ->where('isClient', 1)
            ->where('isMechanic', 1)
            ->count();

        $data = [
            'labels' => ['Clients', 'Mechanics', 'Clients & Mechanics'],
            'data' => [$clientsCount, $mechanicsCount, $bothCount],
            'colors' => ['#615dff', '#3dd9eb', '#184feb'],
        ];

        return view('charts.userCharts', compact('data'));
    }

    public function downloadPDF(User $user)
    {
        $userData = [
            'username' => $user->username,
            'firstName' => $user->firstName,
            'lastName' => $user->lastName,
            'address' => $user->address,
            'phoneNumber' => $user->phoneNumber,
            'email' => $user->email,
            'isClient' => $user->isClient,
            'isMechanic' => $user->isMechanic,
            // 'isAdmin' => $user->isAdmin,
        ];

        if ($user->isClient) {
            $vehicles = $user->vehicles()->get();
            $userData['vehicles'] = $vehicles;
        }

        $pdf = new Dompdf();
        $pdf->loadHtml(
            View::make('admin.user.pdf', compact('userData'))->render()
        );

        $pdf->setPaper('A4', 'landscape');

        $pdf->render();

        return $pdf->stream('user_data' . $user->phoneNumber . '.pdf');
    }
}
