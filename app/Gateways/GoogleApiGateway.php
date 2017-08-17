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

        $address_data = collect(json_decode($response->getBody())->results[0]->address_components);


         $countyLevel = $address_data->first(function($value, $key){
           if(collect($value)->flatten()->contains('administrative_area_level_2'))
            {
                return $value;
            }
        });


         return $countyLevel->long_name;
    }

}