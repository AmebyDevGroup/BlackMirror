<?php

namespace App\Broadcasting;

use App\Jobs;
use App\MirrorConfig;
use stdClass;
use Ratchet\ConnectionInterface;
use BeyondCode\LaravelWebSockets\WebSockets\Channels\Channel;

class MirrorChannel extends Channel
{
    // /**
    //  * Create a new channel instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     //
    // }

    // /**
    //  * Authenticate the user's access to the channel.
    //  *
    //  * @param  \App\User  $user
    //  * @return array|bool
    //  */
    // public function join(User $user)
    // {
    //     //
    // }

    /*
     * @link https://pusher.com/docs/pusher_protocol#presence-channel-events
     */
    public function subscribe(ConnectionInterface $connection, stdClass $payload)
    {
        $this->saveConnection($connection);
        $message = [];
        $config = MirrorConfig::all();
        foreach ($config as $config_object) {
            $val = false;
            if ($config_object->active) {
                $val = true;
            }
            $message[$config_object->name] = $val;
        }
        $connection->send(json_encode([
            'event' => 'App\Events\Message',
            'channel' => $this->channelName,
            'data' => json_encode([
                'type' => 'config',
                'data' => $message
            ])
        ]));
        foreach ($message as $key => $enabled) {
            if ($enabled) {
                switch ($key) {
                    case "air":
                        dispatch(new Jobs\SendAirQualityJob());
                        break;
                    case "calendar":
                        dispatch(new Jobs\SendCalendarJob());
                        break;
                    case "news":
                        dispatch(new Jobs\SendNewsJob());
                        break;
                    case "tasks":
                        dispatch(new Jobs\SendTasksJob());
                        break;
                    case "weather":
                        dispatch(new Jobs\SendWeatherJob());
                        break;
                    case "covid":
                        dispatch(new Jobs\SendCovidJob());
                        break;
                }
            }
        }
    }
}
