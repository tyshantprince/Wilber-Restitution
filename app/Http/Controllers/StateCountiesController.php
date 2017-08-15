<?php

namespace App\Http\Controllers;

use App\County;
use App\State;

class StateCountiesController extends Controller
{
    public function index(State $state)
    {
        return $state->counties;
    }

    public function store(State $state)
    {
        $this->validateWith([
            'name' => 'required'
        ]);
        return $state->addCounty(request(['name']));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(State $state, County $county)
    {
        abort_unless($state->owns($county), 404);
        $this->validateWith([
            'name' => 'required'
        ]);
        $county->update(request(['name']));
        return $county;
    }

    public function destroy(State $state, County $county)
    {
        abort_unless($state->owns($county), 404);
        $county->delete();
        return $county;
    }
}
