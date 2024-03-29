{{-- @extends('layouts.app-master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Edit Profile</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update', $user->id) }}"> 
                        @csrf
                        @method('PUT')

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

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" required value="{{ $user->username }}" name="username" class="form-control" id="username">
                        </div>

                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label">Phone Number</label>
                            <input type="text" required name="phoneNumber" value="{{ $user->phoneNumber }}" class="form-control" id="phoneNumber">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">First Name</label>
                                <input type="text" required name="firstName" value="{{ $user->firstName }}" class="form-control" id="firstName">
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" required name="lastName" value="{{ $user->lastName }}" class="form-control" id="lastName">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" required name="email" value="{{ $user->email }}" class="form-control" id="email">
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" required name="address" value="{{ $user->address }}" class="form-control" id="address">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" required name="password" class="form-control" id="password">
                        </div>


                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        // Script for toggling password visibility
        const passwordField = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');

        togglePassword.addEventListener('click', function() {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
@endsection --}}
