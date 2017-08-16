<?php

namespace App\Http\Controllers;

use App\County;
use App\Gateways\CubsApiGateway;
use App\Gateways\GoogleApiGateway;
use App\State;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class CubsSearchController extends Controller
{
    public function find(CubsApiGateway $cubsapi, GoogleApiGateway $googleApi, $cubsNumber)
    {
        //Cubs Search
        $location = $cubsapi->getLocationInfo($cubsNumber);

        // Set state object based on cubs state
        $state = State::where('abbr', $location['state'])->firstOrFail();

        $cubsCounty = $googleApi->getCounty($location);

        return $this->findOrCreateCounty($state, $cubsCounty);

    }


    private function findOrCreateCounty($state, $cubsCounty)
    {
        $county = County::firstOrCreate([
            'state_id' => $state->id,
            'name' => $cubsCounty,
        ]);

        return [
            'stateID' => $state->id,
            'countyID' => $county->id,
        ];
    }

}
