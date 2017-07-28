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
        $this->validateWith(['body' => 'required']);

        return $state->addNote(request(['body']));
    }

    public function update(State $state, Note $note)
    {
        $note = $state->notes()->findOrFail($note->id);

        $this->validateWith(['body' => 'required']);

        $note->update(request(['body']));

        return $note;
    }





}
