<?php

namespace App\Gateways;

use Carbon\Carbon;
use GuzzleHttp\Client;
use Mockery\Exception;

class CubsApiGateway extends Gateway
{
    public function __construct()
    {
        $this->client = new Client();
    }

    public function getLocationInfo($cubsNumber)
    {
        $response = $this->client->get('https://capi.wilbergroup.com/v1/get_claim_details?wilber_file_number=' . $cubsNumber);

        if(json_decode($response->getBody())->data->meta->loss_location_city && json_decode($response->getBody())->data->meta->loss_location_state)
        {
            return [
                'city' => json_decode($response->getBody())->data->meta->loss_location_city,
                'state' => json_decode($response->getBody())->data->meta->loss_location_state
            ];
        }

        return 'Could Not Find Loss Location';


    }

}
