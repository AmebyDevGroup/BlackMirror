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
        $queryParams = array(
//          '$select' => 'subject,importance,body,dueDateTime,createdDateTime',
            '$orderby' => 'importance DESC, createdDateTime DESC',
            '$top' => 20,
            '$filter' => "status ne 'completed'"
        );
        $getEventsUrl = '/me/outlook/taskFolders/'.config('mirror.tasks.directory').'/tasks?'.http_build_query($queryParams);
        try {
            $tasks = $graph->createRequest('GET', $getEventsUrl)
                ->setReturnType(Model\OutlookTask::class)
                ->execute();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        $formatedTasks = [];
        foreach($tasks as $task) {
            $this_task = [
                'owner' => $task->getOwner(),
                'title' => $task->getSubject(),
                'description' => $task->getBody()->getContent(),
                'priority' => $task->getImportance()->value(),
                'deadline_at' => is_array($deadline_at = $task->getDueDateTime()->getProperties())? Carbon::parse($deadline_at['dateTime'])->format('Y-m-d H:i'):null,
                'created_at' => Carbon::parse($task->getCreatedDateTime())->format('Y-m-d H:i'),
                'updated_at' => Carbon::parse($task->getLastModifiedDateTime())->format('Y-m-d H:i'),
            ];
            $formatedTasks[] = $this_task;
        }
        broadcast(new Message('tasks', $formatedTasks));

        $viewData = $this->loadMicrosoftViewData();
        $viewData['events'] = $formatedTasks;
        return view('panel.calendar', $viewData);
    }
}
