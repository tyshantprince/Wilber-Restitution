<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NotesController extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function retrieve_posts_for_state()
    {
        $this->actingAs(1)
            ->post('/notes/{state}', [
                'state' => 1
            ])
            ->assertSuccessful();
    }
}
