<?php

namespace App\Http\Controllers;

use App\County;
use App\State;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class CubsSearchController extends Controller
{
    public function __construct()
    {
        $this->client = new Client();
        $this->apikey = 'AIzaSyAAK-Blg6TN6PMjZdPkahbMs-CKRx-aXbY';
    }

    public function find($cubsNumber)
    {
        //Cubs Search
        $location = $this->searchCubs($cubsNumber);

        // Set state object based on cubs state
        $state = State::where('abbr', $location['state'])->firstOrFail();

        //Google County Lookup
        $cubsCounty = $this->searchGoogleForCounty($location);

        return $this->findOrCreateCounty($state, $cubsCounty);

    }

    private function searchCubs($cubsNumber)
    {
        $cubsSearch = $this->client->get('https://capi.wilbergroup.com/v1/get_claim_details?wilber_file_number=' . $cubsNumber);
        return [
          'city' => json_decode($cubsSearch->getBody())->data->meta->loss_location_city,
          'state' => json_decode($cubsSearch->getBody())->data->meta->loss_location_state
        ];
    }

    private function searchGoogleForCounty($location)
    {
        $googleSearch = $this->client->get('https://maps.googleapis.com/maps/api/geocode/json?address=' . $location['city'] . ',' . $location['state'] . '&key=' . $this->apikey);
          return array_filter(json_decode($googleSearch->getBody())->results[0]->address_components, function ($address_components) {
            return $address_components->types[0] === 'administrative_area_level_2' ;
        })[1]->long_name;
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
