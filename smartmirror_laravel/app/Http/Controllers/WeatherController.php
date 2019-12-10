<?php

namespace App\Http\Controllers;

use App\Events\Message;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class WeatherController
{
    public function getCities()
    {
        if(Storage::exists('city.list.json')) {
            return collect(json_decode(Storage::get('city.list.json'), true))->where('country', 'PL');
        }
        return collect([]);
    }

    public function getInfo()
    {
        //api.openweathermap.org/data/2.5/forecast?id={city ID}
//        api.openweathermap.org/data/2.5/weather?id={city ID}
        $client = new Client();
        $response = $client->request('GET',
            'http://api.openweathermap.org/data/2.5/weather?units=metric&lang=pl&id=' . config('mirror.weather.city').'&appid='.env('WEATHER_KEY'));
        $weatherInfo = [];
        dd(json_decode($response->getBody()->getContents()));
        foreach (json_decode($response->getBody()->getContents()) as $station) {

            $airInfo[] = [
                'name' => ucfirst($station->param->paramName),
                'code' => $station->param->paramCode,
            ];
        }
        broadcast(new Message('air', $airInfo));
        return response()->json($airInfo);
    }
}
