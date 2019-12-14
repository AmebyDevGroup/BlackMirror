<?php

namespace App\Jobs;

use App\Events\Message;
use App\MirrorConfig;
use App\TokenStore\TokenCache;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Microsoft\Graph\Beta\Model;
use Microsoft\Graph\Graph;

class SendCalendarJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $tasks;
    private $provider;
    private $directory;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $config = MirrorConfig::where('name', 'calendar')->first();
        $this->provider = $config->data['provider'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            switch ($this->provider) {
                case 'microsoft':
                    $this->tasks = $this->getMicrosoftCalendar();
                    break;
                default:
                    break;
            }
            broadcast(new Message('calendar', $this->tasks));
        } catch (\Exception $e) {
            return broadcast(new Message('calendar', [
            "status" => 'failed',
            "message" => $e->getMessage()
            ]));
        }

    }

    protected function getMicrosoftCalendar()
    {
        $graph = $this->initMicrosoftConnection();
        $calendars = $graph->createRequest('GET', '/me/calendars')
            ->setReturnType(Model\Calendar::class)
            ->execute();
        $all_events = [];
        foreach($calendars as $calendar) {
            $getEventsUrl = "/me/calendars/{$calendar->getId()}/calendarView?startDateTime=2019-12-14T10:00:00.0000000&endDateTime=2019-12-31T23:59:00.0000000";
            $events = $graph->createRequest('GET', $getEventsUrl)
                ->setReturnType(Model\Event::class)
                ->execute();
            $all_events = array_merge($all_events,$events);
        }
        $formatedEvents = [];
        foreach($all_events as $event) {
            $this_event = [
                'title' => $event->getSubject(),
                'allDay' => $event->getIsAllDay(),
                'full_start_date' => Carbon::parse($event->getStart()->getDateTime())->format('Y-m-d H:i:s'),
                'start' => Carbon::now()->diffInDays(Carbon::parse($event->getStart()->getDateTime())->format('Y-m-d'), false),
                'hour' => $event->getIsAllDay()? false : Carbon::parse($event->getStart()->getDateTime())->format('H:i')
            ];
            $formatedEvents[] = $this_event;
        }
        $formatedEvents = collect($formatedEvents)->sortBy('full_start_date')->values();
        $endDate = $formatedEvents->get(3)['start'];
        $formatedEvents = $formatedEvents->where('start', '<=', $endDate);
        return $formatedEvents;
    }

    private function initMicrosoftConnection()
    {
        $tokenCache = new TokenCache();
        $accessToken = $tokenCache->getAccessToken();
        $graph = new Graph();
        $graph->setApiVersion('beta');
        $graph->setAccessToken($accessToken);
        return $graph;
    }
}
