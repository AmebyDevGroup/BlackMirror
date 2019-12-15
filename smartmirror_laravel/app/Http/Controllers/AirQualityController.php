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

    public function getInfo()
    {
        //http://api.gios.gov.pl/pjp-api/rest/station/sensors/{stationId}
        $client = new Client();
        $response = $client->request('GET',
            'http://api.gios.gov.pl/pjp-api/rest/station/sensors/' . config('mirror.air.station'));
        $airInfo = [];
        foreach (json_decode($response->getBody()->getContents()) as $station) {
            //http://api.gios.gov.pl/pjp-api/rest/data/getData/{sensorId}
            $client = new Client();
            $sensor = $client->request('GET',
                'http://api.gios.gov.pl/pjp-api/rest/data/getData/' . $station->id);
            $airInfo[] = [
                'name' => ucfirst($station->param->paramName),
                'code' => $station->param->paramCode,
                'value' => json_decode($sensor->getBody()->getContents())->values[0] ?? false
            ];
        }
        broadcast(new Message('air', $airInfo));
        return response()->json($airInfo);
    }
}
