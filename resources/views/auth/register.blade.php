<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize Free</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('../assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('../assets/css/styles.min.css') }}" />
    <style>
        .card {
            width: 600px; /* Adjust the width as per your requirement */
            margin: auto; /* Centers the div horizontally */
            position: absolute; /* Allows vertical centering */
            top: 50%; /* Positions the top edge of the div at 50% of the containing element's height */
            left: 50%; /* Positions the left edge of the div at 50% of the containing element's width */
            transform: translate(-50%, -50%); /* Translates the div up and left by half of its own width and height */
        }
    </style>

</head>

<body>
    <!--  Body Wrapper -->
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
                                <a href="" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="{{ asset('../assets/images/logos/dark-logo.svg') }}" width="180"
                                        alt="">
                                </a>
                                {{-- <p class="text-center">Your Social Campaigns</p> --}}
                                <form method="POST" action="{{ route('register.perform') }}">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="username" class="form-label">Username </label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                required>
                                        </div>
                                        <div class="col">
                                            <label for="phoneNumber" name="" class="form-label">Phone
                                                Number</label>
                                            <input type="text" class="form-control" id="phoneNumber"
                                                name="phoneNumber" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="firstName" class="form-label">First Name </label>
                                            <input type="text" class="form-control" id="firstName" name="firstName"
                                                required>
                                        </div>
                                        <div class="col">
                                            <label for="lastName" class="form-label"> Last Name</label>
                                            <input type="text" class="form-control" name="lastName" id="lastName"
                                                required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                required>
                                        </div>
                                        <div class="col">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control" name="address" id="address"
                                                required>
                                        </div>

                                    </div>
                                    <div class="row mb-3">

                                        <div class="col">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                required>
                                        </div>
                                        <div class="col">
                                            <label for="confirmation" class="form-label">Confirmation</label>
                                            <input type="password" class="form-control" name="confirmation"
                                                id="confirmation" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label class="form-label">Select Role</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="client"
                                                    id="client" name="isClient" value="0">
                                                <label class="form-check-label" for="client">Client</label>
                                            </div>
                                            <input type="hidden" name="isClient" value="0">
                                        </div>
                                        <div class="col">
                                            <label class="form-label">&nbsp;</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="mechanic"
                                                    id="mechanic" name="isMechanic" value="0">
                                                <label class="form-check-label" for="mechanic">Mechanic</label>
                                            </div>
                                            <input type="hidden" name="isMechanic" value="0">

                                        </div>
                                    </div>
                                    <button href="{{ route('login.show') }}"
                                        class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign
                                        Up</button>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                                        <a class="text-primary fw-bold ms-2" href="{{ route('login.show') }}">Sign
                                            In</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
