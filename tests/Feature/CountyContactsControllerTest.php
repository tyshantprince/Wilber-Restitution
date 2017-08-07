<?php

namespace Tests\Feature;

use App\Contact;
use App\County;
use App\Note;
use App\State;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CountyContactsControllerTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function can_list_out_all_contacts()
    {
        $user = factory(User::class)->create();
        $state = factory(State::class)->create();
        $county = factory(County::class)->create(['state_id' => $state->id]);
        $contact = factory(Contact::class, 10)->create(['county_id' => $county->id]);

        $this->actingAs($user)->get(route('county.contacts.index', $county))->assertSuccessful();

        $this->assertEquals(10, $county->contacts->count());
    }

    /** @test */
    public function can_create_new_contact()
    {
        $user = factory(User::class)->create();
        $state = factory(State::class)->create();
        $county = factory(County::class)->create(['state_id' => $state->id]);

        $this->actingAs($user)->post(route('county.contacts.store', $county), [
            'contact_name' => 'Tyshan Prince',
            'phone' => '773-123-4567',
            'ext' => '3662',
            'address1' => '19 Traders Circle',
            'address2' => '51',
            'city' => 'Chicago',
            'zip' => '60612',
            'fax' => '321',
            'email'=> 'tprin@gmail.com',
            'website' => 'www.google.com',
            'fee' => '56456',
            'notes' => 'dges'
        ])
            ->assertSuccessful();

        $this->assertEquals('1', Contact::all()->count());
    }

    /** @test */
    public function can_edit_a_contact()
    {
        $user = factory(User::class)->create();
        $state = factory(State::class)->create();
        $county = factory(County::class)->create(['state_id' => $state->id]);
        $contact = factory(Contact::class)->create(['county_id'=> $county->id]);

        $this->actingAs($user)->patch(route('county.contacts.update', [$county, $contact]), [
            'county_id'    => $county->id,
            'contact_name' => 'Bill Gates',
            'phone' => '773-123-4567',
            'ext' => '3662',
            'address1' => 'Micosoft Land',
            'address2' => '51',
            'city' => 'Chicago',
            'zip' => '60612',
            'fax' => '321',
            'email' => 'BGates@gmail.com',
            'website' => 'www.google.com',
            'fee' => '321',
            'notes' => 'dges'
        ])
            ->assertSuccessful();

    }

    /** @test */
    public function can_delete_a_contact()
    {
        $user = factory(User::class)->create();
        $state = factory(State::class)->create();
        $county = factory(County::class)->create(['state_id' => $state->id]);

        $contact = factory(Contact::class)->create(['county_id'=> $county->id]);

        $this->actingAs($user)->delete(route('county.contacts.destroy', [$county, $contact]))->assertStatus(204);

        $this->assertEquals(0, Note::all()->count());


    }


}
