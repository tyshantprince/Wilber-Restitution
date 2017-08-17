<?php

namespace App\Http\Controllers;

use App\County;
use App\Exceptions\CountyLookupException;
use App\Gateways\CubsApiGateway;
use App\Gateways\GoogleApiGateway;
use App\State;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Mockery\Exception;

class CubsSearchController extends Controller
{
    public function find(CubsApiGateway $cubsapi, GoogleApiGateway $googleApi, $cubsNumber)
    {
        try {
            $location = $cubsapi->getLocationInfo($cubsNumber);

            $cubsCounty = $googleApi->getCounty($location);

            $state = State::where('abbr', $location['state'])->firstOrFail();

            return $this->findOrCreateCounty($state, $cubsCounty);

        } catch (CountyLookupException $e) {

            return response()->json(['error' => $e->getMessage()], 404);

        }
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
