<?php

namespace App\Jobs;

use App\Gateways\CubsApiGateway;
use App\Gateways\GoogleApiGateway;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

class FetchCounty
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $cubsNumber;
    /**
     * @var
     */
    private $location;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($cubsNumber, $city, $state)
    {
        $this->cubsNumber = $cubsNumber;
        $this->location = ['city' => $city, 'state' => $state];
    }

    public function handle(GoogleApiGateway $gapi)
    {
        $county = $gapi->getCounty($this->location);
        $this->saveCounty($county);

    }

    private function saveCounty($county)
    {
        if ($county) {
            Storage::append('good_cubs_numbers_counties.txt', $this->cubsNumber.'|'.$county);
        }

        Storage::append('good_cubs_numbers_counties.txt', $this->cubsNumber);
    }
}