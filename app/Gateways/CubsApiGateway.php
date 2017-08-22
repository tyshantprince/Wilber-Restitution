<?php

namespace App\Gateways;

use App\Exceptions\CountyLookupException;
use App\State;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

class CubsApiGateway extends Gateway
{
    public function __construct()
    {
        $this->client = new Client();
    }

    public function getLocationInfo($cubsNumber)
    {
        try {
            $response = $this->client->get('https://capi.wilbergroup.com/v1/get_claim_details?wilber_file_number=' . $cubsNumber);

            $meta = json_decode($response->getBody())->data->meta;

            $location = [
                'city' => trim($meta->loss_location_city),
                'state' => trim($meta->loss_location_state),
            ];

            $this->checkForMissingLocation($location);

            return $location;

        } catch (BadResponseException $e) {
            Storage::append('bad_cubs_numbers.txt', implode('|', $cubsNumber));
            throw new CountyLookupException('Cubs number was not found.');
        }

    }

    private function checkForMissingLocation($location)
    {

        if (empty($location['city']) || empty($location['state'])) {
            throw new CountyLookupException('Invalid or missing loss location.');
        }

        if (is_null(State::where('abbr', $location['state'])->first())) {
            throw new CountyLookupException('Invalid loss location state.');
        }
    }

}
