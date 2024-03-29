<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function create()
    {
        return view('admin.vehicle.create');
    }
    public function show()
    {
        $vehicles = Vehicle::orderBy('id', 'desc')->simplePaginate(5);

        return view('admin.vehicle.show', ['vehicles' => $vehicles])->with(
            'i',
            (request()->input('page', 1) - 1) * 5
        );
    }
    public function search()
    {
        $vehicles = Vehicle::where(
            'model',
            'like',
            '%' . request('search') . '%'
        )
            ->orwhere('fuelType', 'like', '%' . request('search') . '%')
            ->orwhere('registration', 'like', '%' . request('search') . '%')
            ->orwhere('make', 'like', '%' . request('search') . '%')
            ->simplePaginate(5);

        return view('admin.vehicle.show', compact('vehicles'))->with(
            'i',
            (request()->input('page', 1) - 1) * 5
        );
    }
    public function store(Request $request)
    {
        $request->validate([
            'make' => 'required|string',
            'model' => 'required|string',
            'fuelType' => 'required|string',
            'registration' => 'unique|required|string',
            'userId' => 'required|numeric',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $vehicle = new Vehicle();
        $vehicle->make = $request->make;
        $vehicle->model = $request->model;
        $vehicle->fuelType = $request->fuelType;
        $vehicle->registration = $request->registration;
        $vehicle->user_id = $request->userId;
        $vehicle->save();

        $images = [];
        if ($request->hasFile('images')) { 
            foreach ($request->file('images') as $image) {
                $name = Str::random(30) . time();
                $imageName = $name . '_' . $image->getClientOriginalName();
                $image->move(public_path('storage/images'), $imageName);
                $images[] = $imageName;
            }
            $vehicle->images = json_encode($images);
            $vehicle->save();
        }

        return redirect()->route('vehicle.show') 
->with('success', 'Vehicle created successfully');
    }
    public function delete(Request $request)
    {
        $vehicle = Vehicle::find($request->deleteId);
        $vehicle->delete();
        return 'ok';
    }

    public function update(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'editMake' => 'required|string',
            'editModel' => 'required|string',
            'editFuelType' => 'required|string',
            'editRegistration' => 'required|string',
            'editClientPhoneNumber' => 'required|string',
        ]);

        $vehicle = Vehicle::findOrFail($request->vehicle_id);

        $vehicle->make = $request->editMake;
        $vehicle->model = $request->editModel;
        $vehicle->fuelType = $request->editFuelType;
        $vehicle->registration = $request->editRegistration;

        $user = $vehicle->user; 
        $user->phoneNumber = $request->editClientPhoneNumber;

        $vehicle->save();

        return redirect()
            ->route('vehicle.show')
            ->with('success', 'Vehicle updated successfully');
    }   
    public function getImages($id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json(['success' => false, 'message' => 'Vehicle not found'], 404);
        }

        $images = $vehicle->images()->pluck('filename')->toArray();

        return response()->json(['success' => true, 'images' => $images]);
    }
}
