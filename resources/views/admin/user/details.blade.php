@extends('layouts.app-master')

@section('content')
    <style>
        .mt-4 {
            width: 100px;
            height: 100px;

        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="mt-4"></div>

                <div class="card overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <p class="text-dark me-1 fs-3 mb-0"><b>Username :</b> {{ $user->username }}</p>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <p class="text-dark me-1 fs-3 mb-0"><b>First Name :</b> {{ $user->firstName }}</p>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <p class="text-dark me-1 fs-3 mb-0"><b>Last Name :</b> {{ $user->lastName }}</p>
                        </div>
                        
                        <div class="d-flex align-items-center mb-3">
                            <p class="text-dark me-1 fs-3 mb-0"><b>Email :</b> {{ $user->email }}</p>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <p class="text-dark me-1 fs-3 mb-0"><b>Phone Number :</b> {{ $user->phoneNumber }}</p>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <p class="text-dark me-1 fs-3 mb-0"><b>Address :</b> {{ $user->address }}</p>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <p class="text-dark me-1 fs-3 mb-0"><b>Status :</b> {{ $user->isClient ? 'Client' : ''}} {{ $user->isMechanic ? '- Mechanic' : ''}}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
