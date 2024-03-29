@extends('layouts.app-master')

@section('content')
    @auth
        @if (Auth::user()->isMechanic)
            <p>Mechanic</p>
        @endif
    @endauth
@endsection