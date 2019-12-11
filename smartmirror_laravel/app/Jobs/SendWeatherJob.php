<?php

namespace App\Jobs;

use App\Events\Message;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendWeatherJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
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
        return broadcast(new Message('current_weather', $weatherInfo));
    }
}
