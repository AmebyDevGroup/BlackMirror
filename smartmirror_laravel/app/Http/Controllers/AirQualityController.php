<?php

namespace App\Http\Controllers;

use App\Events\Message;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use \GuzzleHttp\Client;

class AirQualityController
{
    public function getStations()
    {
        //http://api.gios.gov.pl/pjp-api/rest/station/findAll
        $client = new Client();
        $response = $client->request('GET', 'http://api.gios.gov.pl/pjp-api/rest/station/findAll');
        return response()->json(collect(json_decode($response->getBody()->getContents()))->sortBy('stationName')->pluck('stationName',
            'id'));
    }
}
