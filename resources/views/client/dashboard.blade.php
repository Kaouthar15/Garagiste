@extends('layouts.app-master')

@section('content')
    @auth
        @if (Auth::user()->isClient)
            <p>Client</p>
        @endif
    @endauth
@endsection