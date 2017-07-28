<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestitutionController extends Controller
{
    public function index()
    {
        $states = State::all()->toArray();
        return view('index', compact('states'));
    }
}
