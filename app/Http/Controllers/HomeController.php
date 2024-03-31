<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index() {
        if (auth()->check()) {
            
                return view('home.index'); 
        } else {
            return view('auth.login');
        };
}}


