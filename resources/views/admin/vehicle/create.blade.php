@extends('layouts.app-master')

@section('content')
    
    <style>
        .mt-4 {
            width: 100px;
            height: 100px;

        }
    </style>
    <div class="container ">
        <div class="row justify-content-center ">
            <div class="col-md-6">
                <div class="card-body">
                    <div class="mt-4">
                    </div>
                    <form method="POST" action={{ route('vehicle.store') }} enctype="multipart/form-data">
                        @csrf
                        <!-- Error message when data is not inputted -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="make" class="form-label">Make</label>
                                <input type="text" name="make" class="form-control" id="make"
                                    aria-describedby="make">
                            </div>
                            <div class="col-md-6">
                                <label for="model" class="form-label">Model</label>
                                <input type="text" name="model" class="form-control" id="model"
                                    aria-describedby="model">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="fuelType" class="form-label">Fuel Type</label>
                                <input type="text" name="fuelType" class="form-control" id="fuelType"
                                    aria-describedby="fuelType">
                            </div>
                            <div class="col-md-6">
                                <label for="registration" class="form-label">Registration</label>
                                <input type="text" name="registration" class="form-control" id="registration"
                                    aria-describedby="registration">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="userId" class="form-label">User Id</label>
                                <input type="number" min='2' name="userId" class="form-control" id="userId"
                                    aria-describedby="userId">
                            </div>
                            <div class="col-md-6">
                                <label for="images" class="form-label">Image</label>
                                <input type="file" min='0' name="images[]" multiple class="form-control" id="images"
                                    aria-describedby="images">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
