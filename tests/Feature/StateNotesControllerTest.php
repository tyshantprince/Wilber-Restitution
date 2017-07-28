<?php

namespace Tests\Feature;

use App\Note;
use App\State;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StateNotesControllerTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    public function can_list_out_all_notes()
    {
        $user = factory(User::class)->create();
        $state = factory(State::class)->create();
        $notes = factory(Note::class, 10)->create(['state_id' => $state->id]);
        $response = $this->actingAs($user)->get(route('state.notes.index', $state))->assertSuccessful();

        $this->assertEquals(10, $state->notes->count());
    }

    /** @test */
    public function can_create_new_note()
    {
        $user = factory(User::class)->create();
        $state = factory(State::class)->create();

        $response = $this->actingAs($user)->post(route('state.notes.store', $state), [
            'body' => 'initial note'
        ])
            ->assertSuccessful();

        tap(Note::first(), function ($note) {
            $this->assertEquals('initial note', $note->body);
        });

    }

    /** @test */
    public function can_edit_a_note()
    {
        $user = factory(User::class)->create();
        $state = factory(State::class)->create();
        $note = $state->addNote(['body' => 'hey']);

        $this->actingAs($user)->patch(route('state.notes.update', [$state, $note]), [
            'body' => 'updated note',
        ])->assertSuccessful();

        tap($state->notes->first(), function ($note) {
            $this->assertEquals('updated note', $note->body);
        });
    }
}
