<?php

namespace Tests\Browser;

use App\Note;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StateNotesTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testAddNote()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->select('stateDropdown', '1')
                    ->assertSelected('stateDropdown', '1')
                    ->waitForText('STATE NOTES')
                    ->clickLink('New Note')
                    ->pause(500)
                    ->whenAvailable('#newNote', function ($modal) {
                        $modal->type('#body', 'I am testing Dusk and I think its AWESOME!');
                    })
                    ->click('#create')
                    ->pause(500)
                    ->assertSee('I am testing Dusk and I think its AWESOME!');
        });
    }



    public function testEditNote()
    {
        $note = Note::all()->last();
        $this->browse(function (Browser $browser) use ($note) {
            $browser->visit('/')
                ->select('stateDropdown', '1')
                ->assertSelected('stateDropdown', '1')
                ->waitForText('STATE NOTES')
                ->click('a[name=edit' . $note->id . ']')
                ->pause(1000)
                ->whenAvailable('#edit' . $note->id, function ($modal) use ($note) {
                    $modal->type('#' . $note->id, 'I am testing editing a note with laravel dusk');
                })
                ->click('#edit')
                ->pause(500)
                ->assertSee('I am testing editing a note with laravel dusk');
        });
    }

    public function testDeleteNote()
    {
        $note = Note::all()->last();
        $this->browse(function (Browser $browser) use ($note) {
            $browser->visit('/')
                ->select('stateDropdown', '1')
                ->assertSelected('stateDropdown', '1')
                ->waitForText('STATE NOTES')
                ->click('a[name=delete' . $note->id . ']')
                ->pause(1000)
                ->whenAvailable('#delete' . $note->id, function ($modal) {
                    $modal->click('#delete');
                })
                ->pause(500)
                ->assertDontSee('I am testing editing a note with laravel dusk');
        });
    }
}
