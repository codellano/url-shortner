<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\Link;
use App\Models\Analytic;

class ProcessAnalytic implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $link;
    protected $ip;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Link $link, $ip)
    {
        $this->link = $link;
        $this->ip = $ip;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $analytic = new Analytic;
        $analytic->ip = $this->ip;
        $analytic->link_id = $this->link->id;
        $analytic->save();
    }
}
