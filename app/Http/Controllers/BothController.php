<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BothController extends Controller
{
    public function dashboard()
    {
        return view('both.dashboard');
    }
}
