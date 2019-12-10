<?php

namespace App\Jobs;

use App\Events\Message;
use App\TokenStore\TokenCache;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Microsoft\Graph\Beta\Model;
use Microsoft\Graph\Graph;

class SendTasksJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $tasks;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            switch (config('mirror.tasks.provider')) {
                case 'microsoft':
                    $this->tasks = $this->getMicrosoftTasks();
                    break;
                default:
                    break;
            }
            broadcast(new Message('tasks', $this->tasks));
        } catch (\Exception $e) {
            return broadcast(new Message('tasks', [
            "status" => 'failed',
            "message" => $e->getMessage()
            ]));
        }

    }

    protected function getMicrosoftTasks()
    {
        $graph = $this->initMicrosoftConnection();
        $queryParams = array(
            '$orderby' => 'importance DESC, createdDateTime DESC',
            '$top' => 20,
            '$filter' => "status ne 'completed'"
        );
        $getEventsUrl = '/me/outlook/taskFolders/'.config('mirror.tasks.directory').'/tasks?'.http_build_query($queryParams);
        $tasks = $graph->createRequest('GET', $getEventsUrl)
            ->setReturnType(Model\OutlookTask::class)
            ->execute();
        $formattedTasks = [];
        foreach($tasks as $task) {
            $this_task = [
                'owner' => $task->getOwner(),
                'title' => $task->getSubject(),
                'description' => $task->getBody()->getContent(),
                'priority' => $task->getImportance()->value(),
                'deadline_at' => is_array($deadline_at = $task->getDueDateTime()->getProperties())?
                                    Carbon::parse($deadline_at['dateTime'])->format('Y-m-d H:i'):null,
                'created_at' => Carbon::parse($task->getCreatedDateTime())->format('Y-m-d H:i'),
                'updated_at' => Carbon::parse($task->getLastModifiedDateTime())->format('Y-m-d H:i'),
            ];
            $formattedTasks[] = $this_task;
        }
        return $formattedTasks;
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
