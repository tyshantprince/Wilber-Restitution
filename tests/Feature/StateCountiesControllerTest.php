<?php

namespace Tests\Feature;

use App\County;
use App\State;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StateCountiesControllerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_list_out_all_counties()
    {
        $user = factory(User::class)->create();
        $state = factory(State::class)->create();
        factory(County::class, 10)->create(['state_id' => $state->id]);

        $this->actingAs($user)->get(route('state.counties.index', $state))->assertSuccessful();

        $this->assertEquals(10, $state->counties->count());
    }

    /** @test */
    public function can_create_new_county()
    {
        $user = factory(User::class)->create();
        $state = factory(State::class)->create();

        $response = $this->actingAs($user)->post(route('state.counties.store', $state), [
            'state_id' => $state->id,
            'name' => 'cook'
        ])
            ->assertSuccessful();

        tap(County::first(), function ($county) {
            $this->assertEquals('1', $county->state_id);
        });
    }

    /** @test */
    public function can_edit_a_county()
    {
        $user = factory(User::class)->create();
        $state = factory(State::class)->create();
        $county = $state->addCounty([
            'state_id' => '1',
            'name' => 'McLean'
        ]);

        $this->actingAs($user)->patch(route('state.counties.update', [$state, $county]), [
            'name' => 'Cook',
        ])->assertSuccessful();

        tap($state->counties->first(), function ($counties) {
            $this->assertEquals('Cook', $counties->name);
        });
    }

    /** @test */
    public function can_delete_a_note()
    {
        $user = factory(User::class)->create();
        $state = factory(State::class)->create();
        $county = $state->addCounty([
            'state_id' => '1',
            'name' => 'McLean'
        ]);

        $this->assertEquals(1, County::all()->count());

        $this->actingAs($user)->delete(route('state.counties.destroy', [$state, $county]))->assertSuccessful();

        $this->assertEquals(0, County::all()->count());
    }
}
