<?php

namespace App\Http\Controllers;

use App\Note;
use App\State;

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
        abort_unless($state->owns($note), 404);
        $this->validateWith(['body' => 'required']);
        $note->update(request(['body']));
        return $note;
    }

    public function destroy(State $state, Note $note)
    {
        abort_unless($state->owns($note), 404);
        $note->delete();
        return $note;
    }



}
