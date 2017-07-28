<?php

namespace App\Http\Controllers;

use App\Note;
use App\State;
use Illuminate\Http\Request;
use Mockery\Matcher\Not;

class StateNotesController extends Controller
{
    public function index(State $state)
    {
        return $state->notes;
    }

    public function store(State $state)
    {
        $this->validateWith(['note' => 'required']);

        return $state->addNote(request(['note']));
    }

}
