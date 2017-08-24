<?php

namespace App\Jobs;

use App\Gateways\CubsApiGateway;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

class FetchCubsInfo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public $cubsNumber;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($cubsNumber)
    {
        $this->cubsNumber = $cubsNumber;
    }

    public function handle(CubsApiGateway $capi)
    {
        $response = $capi->getLocationInfo($this->cubsNumber);

        $this->saveNumber($response['city'], $response['state']);
    }

    private function saveNumber($city, $state)
    {
        if ($city && $state) {
            Storage::append('bad_county.txt', $this->cubsNumber.'|'.$city.'|'.$state);
        }
    }
}
