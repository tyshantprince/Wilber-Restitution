<?php

namespace App\Http\Controllers;

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

        // Set state objects based on cubs state
        $state = State::where('abbr', $location['state'])->first();

        //Google County Lookup
        $cubsCounty = $this->searchGoogleForCounty($location);

        //create county if it doesn't exist
        if($state->counties->contains('name', $cubsCounty ))
        {
        $county = $state->counties->filter(function ($item) use ($cubsCounty) {
            return $item->name == $cubsCounty;
        })->first();

            return [
                'stateID' => $state->id,
                'countyID' => $county->id

            ];
        }
        else{
            $state->addCounty(['name' => $cubsCounty ]);
            dd($state->counties->last()->id);
            return [
                'stateID' => $state->id,
                'countyID' => $state->counties->last()->id
            ];
        }

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

}
