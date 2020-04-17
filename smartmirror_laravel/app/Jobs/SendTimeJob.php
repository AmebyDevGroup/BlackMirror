<?php

namespace App\Jobs;

use App\Events\Message;
use App\MirrorConfig;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendTimeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $config;
    protected $feature_config;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($feature_config)
    {
        $this->feature_config = $feature_config;
        $this->config = $feature_config->data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        dump($this->feature_config->user_id);
        $timeInfo = [
            'timestamp' => Carbon::now()->setTimezone($this->config['timezone'])->timestamp,
            'timezone' => $this->config['timezone'],
            'time_format' => $this->config['time-format']
        ];
        broadcast(new Message('time', $timeInfo));
    }
}
