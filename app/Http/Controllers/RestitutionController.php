<?php

namespace App\Http\Controllers;

use App\State;

class RestitutionController extends Controller
{
    public function index()
    {
        return view('index', [
            'states' => State::with('notes', 'counties', 'counties.contacts')->get(),
        ]);
    }
}
