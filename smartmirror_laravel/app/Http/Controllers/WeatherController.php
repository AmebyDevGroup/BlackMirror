<?php

namespace App\Http\Controllers;

use App\Events\Message;
use App\WeatherCity;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class WeatherController
{
    public function getCities()
    {
        return WeatherCity::all();
        // return WeatherCity::cursor();
    }

    public function getInfo()
    {
        //api.openweathermap.org/data/2.5/forecast?id={city ID}
//        api.openweathermap.org/data/2.5/weather?id={city ID}
        $client = new Client();
        $response = $client->request('GET',
            'http://api.openweathermap.org/data/2.5/weather?units=metric&lang=pl&id=' . config('mirror.weather.city') . '&appid=' . env('WEATHER_KEY'));
        $data = json_decode($response->getBody()->getContents());
        $weatherInfo = [
            'city' => $data->name,
            'temperature' => $data->main->temp,
            'pressure' => $data->main->pressure,
            'humidity' => $data->main->humidity,
            'wind_speed' => $data->wind->speed,
            'wind_gust' => $data->wind->gust,
            'clouds' => $data->clouds->all,
            'sunrise' => $data->sys->sunrise,
            'sunset' => $data->sys->sunset,
            'description' => $data->weather[0]->description,
            'icon' => $data->weather[0]->icon,
            'time' => Carbon::parse($data->dt)->format('Y-m-d H:i:s'),
         ];
        broadcast(new Message('current_weather', $weatherInfo));
        return response()->json($weatherInfo);
    }
}
