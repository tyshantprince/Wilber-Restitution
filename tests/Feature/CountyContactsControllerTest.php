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

        $this->actingAs($user)->get(route('county.contacts.index', [$state,$county]))->assertSuccessful();

        $this->assertEquals(10, $county->contacts->count());
    }

    /** @test */
    public function can_create_new_contact()
    {
        $user = factory(User::class)->create();
        $state = factory(State::class)->create();
        $county = factory(County::class)->create(['state_id' => $state->id]);

        $response = $this->actingAs($user)->post(route('county.contacts.store', [$state,$county]), [
            'user_id' => 1,
            'county_id' => $county->id,
            'contact_name' => 'Tyshan Prince',
            'phone' => '773-123-4567',
            'ext' => '3662',
            'address1' => '19 Traders Circle',
            'address2' => '51',
            'city' => 'Chicago',
            'zip' => '60612',
            'fax' => '321',
            'email'=> 'tprince@wilbergroup.com',
            'website' => 'google.com',
            'fee' => '321',
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

       $this->actingAs($user)->post(route('county.contacts.store', [$state,$county]), [
            'user_id' => 1,
            'county_id' => $county->id,
            'contact_name' => 'Tyshan Prince',
            'phone' => '773-123-4567',
            'ext' => '3662',
            'address1' => '19 Traders Circle',
            'address2' => '51',
            'city' => 'Chicago',
            'zip' => '60612',
            'fax' => '321',
            'email'=> 'tprince@wilbergroup.com',
            'website' => 'google.com',
            'fee' => '321',
            'notes' => 'dges'
        ])
            ->assertSuccessful();

        $this->assertEquals('1', Contact::all()->count());

        $response = $this->actingAs($user)->patch(route('county.contacts.update', [$state,$county, Contact::first()]), [
            'user_id' => 1,
            'county_id' => $county->id,
            'contact_name' => 'Bill Gates',
            'phone' => '773-123-4567',
            'ext' => '3662',
            'address1' => 'Micosoft Land',
            'address2' => '51',
            'city' => 'Chicago',
            'zip' => '60612',
            'fax' => '321',
            'email'=> 'BGates@microsoft.com',
            'website' => 'google.com',
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

        $response = $this->actingAs($user)->post(route('county.contacts.store', [$state,$county]), [
            'user_id' => 1,
            'county_id' => $county->id,
            'contact_name' => 'Tyshan Prince',
            'phone' => '773-123-4567',
            'ext' => '3662',
            'address1' => '19 Traders Circle',
            'address2' => '51',
            'city' => 'Chicago',
            'zip' => '60612',
            'fax' => '321',
            'email'=> 'tprince@wilbergroup.com',
            'website' => 'google.com',
            'fee' => '321',
            'notes' => 'dges'
        ])
            ->assertSuccessful();


        $this->assertEquals(1, Contact::all()->count());

        $this->actingAs($user)->delete(route('county.contacts.destroy', [$state, $county, Contact::first()]))->assertSuccessful();

        $this->assertEquals(0, Note::all()->count());


    }


}
