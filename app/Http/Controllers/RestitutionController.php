<?php

namespace App\Http\Controllers;

use App\State;

class RestitutionController extends Controller
{
    public function index()
    {
        return view('index', [
            'states' => State::select(['id', 'name', 'abbr'])->get(),
        ]);
    }

    public function show(State $state)
    {
        return $state->load('notes', 'counties', 'counties.contacts');
    }
}
