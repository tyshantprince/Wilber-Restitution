<?php

namespace App\Gateways;

use App\Exceptions\CountyLookupException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

class GoogleApiGateway extends Gateway
{
    public function __construct()
    {
        $this->client = new Client();
        $this->apikey = 'AIzaSyAAK-Blg6TN6PMjZdPkahbMs-CKRx-aXbY';
    }

    public function getCounty($location)
    {
        try {

            $response = $this->client->get('https://maps.googleapis.com/maps/api/geocode/json?address=' . $location['city'] . ',' . $location['state'] . '&key=' . $this->apikey);

            $payload = json_decode($response->getBody());

            if(empty($payload->results)) {
                throw new CountyLookupException('County could not be found');
            }


             return collect($payload->results[0]->address_components)
                                ->first(function($value, $key){
                                    return collect($value)->flatten()->contains('administrative_area_level_2');
                                })->long_name;

        } catch (BadResponseException $e) {

            throw new CountyLookupException('Could not locate county at this time. Please try again later.');

        }
    }

}