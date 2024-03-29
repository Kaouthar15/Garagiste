@extends('layouts.app-master')

@section('content')
<style>
    .mt-4 {
        width: 100px;
        height: 100px;
    }
</style>
<link rel="shortcut icon" type="image/png" href="{{ asset('../assets/images/logos/favicon.png') }}" />

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mt-4"></div>

            <div class="bg-light p-5 rounded">
                @auth
                <h1 >Welcome {{ Auth::user()->firstName }} {{ Auth::user()->lastName }} !</h1>
                <p class="lead">Today is {{ now()->format('l, F j, Y') }}.</p>
                @if (Auth::user()->isAdmin)
                <p class="lead">Only administrators can see this section.</p>
                @endif

                @if (Auth::user()->isClient && !Auth::user()->isMechanic)
                <p class="lead">Only clients can see this section.</p>
                @elseif (Auth::user()->isMechanic && !Auth::user()->isClient)
                <p class="lead">Only mechanics can see this section.</p>
                @elseif (Auth::user()->isMechanic && Auth::user()->isClient)
                <p class="lead">Only those who are mechanics and clients at the same time can see this section.</p>
                @endif

                @endauth

                @guest
                <h1>Homepage</h1>
                <p class="lead">You are viewing the home page. Please login to view the restricted data.</p>
                @endguest
            </div>
        </div>
    </div>
</div>
@endsection
