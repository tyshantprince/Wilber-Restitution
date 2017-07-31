<?php

namespace App\Http\Controllers;

use App\Contact;
use App\County;
use App\State;
use Illuminate\Http\Request;

class StateCountiesController extends Controller
{
    public function index(State $state)
    {
        return $state->counties;
    }

    public function create()
    {
        //
    }

    public function store(State $state)
    {
        $this->validateWith([
            'state_id' => 'required',
            'name' => 'required'
        ]);

        return $state->addCounty(request(['state_id', 'name']));
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
        $county = $state->counties()->findOrFail($county->id);

        $this->validateWith([
            'name' => 'required'
        ]);

        $county->update(request(['name']));

        return $county;
    }

    public function destroy(State $state, County $county)
    {
        $county = $state->counties()->findOrFail($county->id);
        $county->delete();
        return $county;
    }
}
