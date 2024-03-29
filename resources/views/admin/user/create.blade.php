
@extends('layouts.app-master')
@section('content')
<style>
    .mt-4{
        width: 100px;
        height: 100px;

    }
</style>
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-md-6">
            <div class="card-body">
                <div class="mt-4">
                </div>
                <form method="POST" action={{ route('admin.store') }}>
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
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="username" aria-describedby="username">
                        </div>
                        <div class="col-md-6">
                            <label for="phoneNumber" class="form-label">Phone Number</label>
                            <input type="text" name="phoneNumber" class="form-control" id="phoneNumber"
                                aria-describedby="phoneNumber">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" name="firstName" class="form-control" id="firstName"
                                aria-describedby="firstName">
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" name="lastName" class="form-control" id="lastName" aria-describedby="lastName">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email </label>
                            <input type="email" name="email" class="form-control" id="email" aria-describedby="email">
                        </div>
                        <div class="col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" id="address" aria-describedby="address">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Role </label>
                            <div class="form-check">
                                <label class="form-check-label col-md-6">
                                    <input type="checkbox" class="form-check-input" name="isMechanic" value="0" />
                                    Mechanic
                                </label>
                                <label class="form-check-label">
                                    <input type="checkbox" class="form-check-input" name="isClient" value="0" />
                                    Client
                                </label>
                            </div>
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
    <script>
        const passwordField = document.getElementById('passwordField');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
@endsection
