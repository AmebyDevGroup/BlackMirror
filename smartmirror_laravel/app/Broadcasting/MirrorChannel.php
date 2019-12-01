<?php

namespace App\Broadcasting;

use App\Events\Message;
use App\User;
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

        $connection->send(json_encode([
            'event' => 'App\Events\Message',
            'channel' => $this->channelName,
            'data' => json_encode([
                'type' => 'config',
                'data' => 'Config Message'
            ])
        ]));
    }
}
