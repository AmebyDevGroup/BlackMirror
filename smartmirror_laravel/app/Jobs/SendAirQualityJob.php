<?php

namespace App\Jobs;

use App\Events\Message;
use App\MirrorConfig;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendAirQualityJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // http://api.gios.gov.pl/pjp-api/rest/station/sensors/{stationId}
    protected $getStationUrl;
    // http://api.gios.gov.pl/pjp-api/rest/data/getData/{sensorId}
    protected $getSensorUrl;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $config = MirrorConfig::where('name', 'air')->first();
        $this->getStationUrl = "http://api.gios.gov.pl/pjp-api/rest/station/sensors/". $config->data['station']??'';
        $this->getSensorUrl = "http://api.gios.gov.pl/pjp-api/rest/data/getData/";
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $client = new Client();
            $response = $client->request('GET', $this->getStationUrl);
            $airInfo = [];
            foreach (json_decode($response->getBody()->getContents()) as $station) {
                $client = new Client();
                $sensor = $client->request('GET', $this->getSensorUrl.$station->id);
                $airInfo[] = [
                    'name' => ucfirst($station->param->paramName),
                    'code' => $station->param->paramCode,
                    'value' => json_decode($sensor->getBody()->getContents())->values[0]??false
                ];
            }
            return broadcast(new Message('air', $airInfo));
        } catch (\Exception $e) {
            return broadcast(new Message('air', [
                "status" => 'failed',
                "message" => $e->getMessage()
            ]));
        }
    }
}
