<?php

namespace App\Http\Controllers;

use App\Contact;
use App\County;

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
        abort_unless($county->owns($contact), 404);
        $this->validateWith([
            'contact_name' => 'required',
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

//        $contact->user_id = auth()->id();
        $contact->save();

        return $contact;
    }

    public function destroy(County $county, Contact $contact)
    {
        abort_unless($county->owns($contact), 404);
        $contact->delete();

        return response('Contact Deleted', 204);
    }
}
