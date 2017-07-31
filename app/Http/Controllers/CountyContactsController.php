<?php

namespace App\Http\Controllers;

use App\Contact;
use App\County;
use App\State;

class CountyContactsController extends Controller
{
    public function index(County $county)
    {
        return $county->contacts;
    }

    public function store(County $county)
    {
        $this->validateWith([
            'contact_name' => 'required',
            'phone' => 'nullable',
            'ext' => 'nullable',
            'address1' => 'nullable',
            'address2' => 'nullable',
            'city' => 'nullable',
            'zip' => 'nullable',
            'fax' => 'nullable',
            'email' => 'nullable',
            'website' => 'nullable',
            'fee' => 'nullable',
            'notes' => 'nullable',
        ]);

        return $county->addContact(request([
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

    public function update(County $county, Contact $contact)
    {
//        abort_unless($county->owns($contact));
        $contact = $county->contacts()->findOrFail($contact->id);

        $this->validateWith([
            'contact_name' => 'required',
            'phone' => 'nullable',
            'ext' => 'nullable',
            'address1' => 'nullable',
            'address2' => 'nullable',
            'city' => 'nullable',
            'zip' => 'nullable',
            'fax' => 'nullable',
            'email' => 'nullable',
            'website' => 'nullable',
            'fee' => 'nullable',
            'notes' => 'nullable',
        ]);

        $contact->fill(request([
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
        $contact->user_id = auth()->id();
        $contact->save();

        return $contact;
    }

    public function destroy(County $county, Contact $contact)
    {
        $contact = $county->contacts()->findOrFail($contact->id);
        $contact->delete();
        return response('Contact Deleted', 204);
    }
}
