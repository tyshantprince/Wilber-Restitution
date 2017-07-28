<?php

namespace Tests\Unit;

use App\Note;
use App\State;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StateTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function add_note()
    {
        $state = factory(State::class)->create();

        $state->addNote(['body' => 'stuff']);

        $this->assertEquals(1, $state->notes->count());
    }
}
