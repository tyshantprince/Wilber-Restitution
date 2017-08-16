<?php

namespace App\Gateways;

use Carbon\Carbon;
use GuzzleHttp\Client;

class GoogleApiGateway extends Gateway
{
    public function __construct()
    {
        $this->client = new Client();
        $this->apikey = 'AIzaSyAAK-Blg6TN6PMjZdPkahbMs-CKRx-aXbY';
    }

    public function getCounty($location)
    {
        $response = $this->client->get('https://maps.googleapis.com/maps/api/geocode/json?address=' . $location['city'] . ',' . $location['state'] . '&key=' . $this->apikey);

        return array_filter(json_decode($response->getBody())->results[0]->address_components, function ($address_components) {
            return $address_components->types[0] === 'administrative_area_level_2' ;
        })[1]->long_name;
    }

}