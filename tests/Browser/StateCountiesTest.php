<?php

namespace Tests\Browser;

use App\County;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StateCountiesTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testAddCounty()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->select('stateDropdown', '1')
                ->assertSelected('stateDropdown', '1')
                ->waitForText('STATE COUNTIES')
                ->clickLink('New County')
                ->pause(500)
                ->whenAvailable('#newCounty', function ($modal) {
                    $modal->type('county', 'test');
                })
                ->click('#makeCounty')
                ->pause(500)
                ->assertSee('test');
        });
    }
    public function testAddContact()
    {
        $county = County::all()->last();

        $this->browse(function (Browser $browser) use ($county) {
            $browser->visit('/')
                ->select('stateDropdown', '1')
                ->assertSelected('stateDropdown', '1')
                ->waitForText('STATE COUNTIES')
                ->click('#' . $county->id)
                ->pause(200)
                ->click('#addButton' . $county->id)
                ->whenAvailable('#createContact' . $county->id, function ($modal) {
                    $modal->assertSee('CREATE COUNTY CONTACT');
                    $modal->type('name', 'State Attorney');
                   $modal->type('phone', '(773)456-8945');
                   $modal->type('address1', '1 University Street');
                   $modal->type('city', 'Normal');
                   $modal->type('zip', '61761');
                   $modal->type('fax', '+13123546972');
                   $modal->type('email', 'StateAttorney@alabama.gov');
                   $modal->type('website', 'Alabama.gov');
                   $modal->type('fee', '$149.99');
                   $modal->type('notes', 'They charge just for a call !!!');
                })
               ->click('.make-contact')
                ->pause(5000)
               ->assertSee('STATE ATTORNEY')
            ;
        });
    }
}
