@extends('layouts.app-master')

@section('content')
    @auth
        @if (Auth::user()->isClient && Auth::user()->isMechanic)
            <p>BOTH</p>
        @endif
    @endauth
@endsection