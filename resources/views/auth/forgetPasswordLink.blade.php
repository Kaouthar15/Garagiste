@extends('layouts.auth-master')

@section('content')
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Modernize Free</title>
        <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
    </head>

    <body>
        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
            data-sidebar-position="fixed" data-header-position="fixed">
            <div
                class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
                <div class="d-flex align-items-center justify-content-center w-100">
                    <div class="row justify-content-center w-100">
                        <div class="col-md-8 col-lg-6 col-xxl-3">
                            <div class="card mb-0">
                                @include('layouts.partials.messages')

                                <div class="card-body">
                                    <a href="{{ route('home.index') }}"
                                        class="text-nowrap logo-img text-center d-block py-3 w-100">
                                        <img src="{{ asset('assets/images/logos/dark-logo.svg') }}" width="180"
                                            alt="">
                                    </a>
                                    {{-- <p class="text-center">Your Social Campaigns</p> --}}
                                    <form method="post" action="{{ route('reset.password.post') }}">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $token }}">

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="email" name="email"
                                                value="{{ old('email') }}" required autofocus>
                                            @if ($errors->has('email'))
                                                <span class="text-danger">{{ $message }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password"
                                                name="password" required>
                                            @if ($errors->has('password'))
                                                <span class="text-danger">{{ $message }}</span>
                                            @endif
                                        </div>
                                        <div class="mb-4">
                                            <label for="confirmation" class="form-label">Confirmation</label>
                                            <input type="password" class="form-control" id="confirmation"
                                                name="confirmation" required> 
                                            @if ($errors->has('confirmation'))
                                                <span class="text-danger">{{ $message }}</span>
                                            @endif
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Reset
                                            Password
                                        </button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    </body>

    </html>
@endsection
