<?php

namespace App\Http\Controllers;

use App\Contact;
use App\County;
use App\State;
use Illuminate\Http\Request;

class CountyContactsController extends Controller
{
    public function index(State $state, County $county)
    {
        return $state->counties()->findOrFail($county->id)->contacts;
    }

    public function store(State $state, County $county)
    {
        $this->validateWith([
            'user_id' => 'required|',
            'county_id'  => 'required|',
            'contact_name'  => 'required|',
            'phone' => 'nullable|',
            'ext' => 'nullable|',
            'address1' => 'nullable|',
            'address2' => 'nullable|',
            'city' => 'nullable|',
            'zip' => 'nullable|',
            'fax' => 'nullable|',
            'email' => 'nullable',
            'website' => 'nullable',
            'fee' => 'nullable|',
            'notes' => 'nullable|',
        ]);

        return $state->counties()->findOrFail($county->id)->addContact(request([
            'user_id',
            'county_id',
            'contact_name',
            'phone',
            'ext',
            'address1',
            'address2',
            'city',
            'zip',
            'fax',
            'email',
            'website',
            'fee',
            'notes',
        ]));
    }

    public function update(State $state, County $county, Contact $contact)
    {
        $contact = $state->counties()->findOrFail($county->id)->contacts()->findOrFail($contact->id);

        $this->validateWith([
            'user_id' => 'required|',
            'county_id'  => 'required|',
            'contact_name'  => 'required|',
            'phone' => 'nullable|',
            'ext' => 'nullable|',
            'address1' => 'nullable|',
            'address2' => 'nullable|',
            'city' => 'nullable|',
            'zip' => 'nullable|',
            'fax' => 'nullable|',
            'email' => 'nullable',
            'website' => 'nullable',
            'fee' => 'nullable|',
            'notes' => 'nullable|',
        ]);



        $contact->update(request([
            'user_id',
            'county_id',
            'contact_name',
            'phone',
            'ext',
            'address1',
            'address2',
            'city',
            'zip',
            'fax',
            'email',
            'website',
            'fee',
            'notes',
        ]));

        return $contact;
    }

    public function destroy(State $state, County $county, Contact $contact)
    {
        $contact = $state->counties()->findOrFail($county->id)->contacts()->findOrFail($contact->id);
        $contact->delete();
        return $contact;
    }
}
