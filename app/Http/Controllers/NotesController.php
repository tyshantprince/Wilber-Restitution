<?php

namespace App\Http\Controllers;

use App\Note;
use App\State;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function index(State $state)
    {
        $notes = $state->notes;
        return $notes;
    }

    public function create(Request $request)
    {
        $note = new Note();
        $note->note = $request->note;
        $note->state_id = $request->state;
    }

}
