<?php

namespace App\Http\Controllers;

use App\State;

class RestitutionController extends Controller
{
    public function index()
    {
        $states = State::all()->toArray();
        return view('index', compact('states'));
    }
}
