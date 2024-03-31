<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>Modernize</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Bootstrap core CSS -->
    <link href="{!! url('assets/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{ asset('../assets/images/logos/favicon.png') }}" />

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="{!! url('assets/css/app.css') !!}" rel="stylesheet">
</head>

<body>

    {{-- @include('layouts.partials.navbar') --}}

    <main class="page-wrapper">
        {{-- @include('layouts.partials.messages') --}}

        @if (!Auth::user())
            @include('auth.register')
        @elseif (Auth::user()->isAdmin) 
            @include('layouts.partials.admin')
        @elseif (!Auth::user()->isMechanic && Auth::user()->isClient) 
            @include('layouts.partials.client')
        @elseif (Auth::user()->isMechanic && !Auth::user()->isClient)
            @include('layouts.partials.mechanic')
        @elseif (Auth::user()->isMechanic && Auth::user()->isClient)
            @include('layouts.partials.both')
        @endif
        @yield('content')
    </main>
    @yield('scripts')

    <script src="{!! url('assets/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>

</body>

</html>
