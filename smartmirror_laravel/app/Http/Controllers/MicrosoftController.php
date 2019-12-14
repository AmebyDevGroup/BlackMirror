<?php

namespace App\Http\Controllers;

use App\Events\Message;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Microsoft\Graph\Graph;
use Microsoft\Graph\Beta\Model;
use App\TokenStore\TokenCache;
use Carbon\Carbon;

class MicrosoftController extends Controller
{
    private function initConnection()
    {
        $tokenCache = new TokenCache();
        $accessToken = $tokenCache->getAccessToken();
        $graph = new Graph();
        $graph->setApiVersion('beta');
        $graph->setAccessToken($accessToken);
        return $graph;
    }

    public function taskFolders()
    {
        $graph = $this->initConnection();
        $queryParams = array(
//          '$select' => 'subject,importance,body,dueDateTime,createdDateTime',
//            '$orderby' => 'importance DESC, createdDateTime DESC',
            '$top' => 100,
//            '$filter' => "status ne 'completed'"
        );
        $getEventsUrl = '/me/outlook/taskFolders?'.http_build_query($queryParams);
        try {
            $folders = $graph->createRequest('GET', $getEventsUrl)
                ->setReturnType(Model\OutlookTaskFolder::class)
                ->execute();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        $formatedFolders = [];
        foreach($folders as $folder) {
            $this_folder = [
                'id' => $folder->getId(),
                'title' => $folder->getName()
            ];
            $formatedFolders[] = $this_folder;
        }
        return $formatedFolders;
    }

    public function tasks()
    {
        $graph = $this->initConnection();
        try {
            $calendars = $graph->createRequest('GET', '/me/calendars')
                ->setReturnType(Model\Calendar::class)
                ->execute();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
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
        broadcast(new Message('calendar', $formatedEvents));
        $viewData = $this->loadMicrosoftViewData();
        $viewData['events'] = $formatedEvents;
        return view('panel.calendar', $viewData);
    }
}
